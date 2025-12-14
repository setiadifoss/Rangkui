<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Modules\Bibliography\Models\BibliographyModel;
use SimpleXMLElement;
use DOMDocument;

class OaiPmhController extends BaseController
{
    public function index()
    {
        $verb = $this->request->getVar('verb');
        $metadataPrefix = $this->request->getVar('metadataPrefix');

        switch ($verb) {
            case 'Identify':
                return $this->identify();
            case 'ListRecords':
                return $this->listRecords($verb, $metadataPrefix);
            case 'GetRecord':
                return $this->getRecord();
            default:
                return $this->badRequest("Unknown OAI-PMH verb: $verb");
        }
    }

    private function identify()
    {
        $db = \Config\Database::connect();

        $sql = "select email from user where username = :username:";
        $user_email = $db->query($sql,['username' => 'admin'])->getRow()->email;

        $email = "halo@setiadifoss.org";

        if(!empty($user_email)) {
            $email = $user_email;
        }

        $response = new SimpleXMLElement('<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/"/>');
        $response->addChild('responseDate', date('Y-m-d\TH:i:s\Z'));
        
        $request = $response->addChild('request', base_url('oai')); 
        $request->addAttribute('verb', 'Identify');

        $identify = $response->addChild('Identify');
        $identify->addChild('repositoryName', 'Contoh Repository Setiadi');
        $identify->addChild('baseURL', base_url('oai'));
        $identify->addChild('protocolVersion', '2.0');
        $identify->addChild('adminEmail', $email);


        $identify->addChild('earliestDatestamp', '2023-01-01T00:00:00Z');
        $identify->addChild('deletedRecord', 'no');
        $identify->addChild('granularity', 'YYYY-MM-DDThh:mm:ssZ');

        return $this->respond($response->asXML(), 200, 'application/xml');
    }

    public function listRecords($verb, $metadataPrefix)
    {

        $biblio = new BibliographyModel();
        $records = $biblio->orderBy('biblio_id', 'ASC')->get()->getResult();

        $xmlDoc = new \DOMDocument('1.0', 'UTF-8');
        $xmlDoc->formatOutput = true;

        $oaiPmh = $xmlDoc->createElementNS('http://www.openarchives.org/OAI/2.0/', 'OAI-PMH');
        $oaiPmh->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $oaiPmh->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $oaiPmh->setAttribute('xmlns:xmp', 'XMPieWSAPI');

        $responseDate = $xmlDoc->createElement('responseDate', date("Y-m-d\TH:i:s\Z"));
        $oaiPmh->appendChild($responseDate);

        $req = $xmlDoc->createElement('request', base_url('oai'));
        $req->setAttribute('verb', $verb);
        $req->setAttribute('metadataPrefix', $metadataPrefix);
        $oaiPmh->appendChild($req);

        $soapBody = $xmlDoc->createElement('ListRecords');
        $oaiPmh->appendChild($soapBody);

        foreach ($records as $record) {
            
            $recordElement = $xmlDoc->createElement('record');
            $soapBody->appendChild($recordElement);

            $headerElement = $xmlDoc->createElement('header');
            $recordElement->appendChild($headerElement);

            $identifier = $xmlDoc->createElement('identifier', "oai:" . base_url() . ":slims-{$record->biblio_id}");
            $headerElement->appendChild($identifier);

            $datestamp = $xmlDoc->createElement('datestamp',  $record->input_date);
            $headerElement->appendChild($datestamp);

            $setSpec = $xmlDoc->createElement('setSpec', $record->publish_year);
            $headerElement->appendChild($setSpec);

            $metadata = $xmlDoc->createElement('metadata');
            $recordElement->appendChild($metadata);

            $oai_dc = $xmlDoc->createElementNS('http://www.openarchives.org/OAI/2.0/oai_dc/', 'oai_dc:dc');
            $oai_dc->setAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
            $oai_dc->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
            $oai_dc->setAttribute('xsi:schemaLocation', 'http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd');
            $metadata->appendChild($oai_dc);

            $title                 = $xmlDoc->createElement('dc:title', $record->title);
            $date                  = $xmlDoc->createElement('dc:date', $record->publish_year);
            $language              = $xmlDoc->createElement('dc:language', $record->language_id);
            $identifier            = $xmlDoc->createElement('dc:identifier', base_url('beranda/detail/' . slim_encrypt($record->biblio_id)));
            
            // $notes = $record->notes;
            $notes = htmlspecialchars($record->notes);
            $description           = $xmlDoc->createElement('dc:description',  $notes);
            $identifier_image      = $xmlDoc->createElement('dc:identifier', base_url("public/uploads/images/docs/") . $record->image);
            $description_collation = $xmlDoc->createElement('dc:description',  $record->collation);
            $call_number           = $xmlDoc->createElement('dc:subject',  $record->call_number);

            $topics =  getDatas(
                'mst_topic',
                'topic',
                " topic_id",
                "(SELECT topic_id FROM biblio_topic where biblio_id = {$record->biblio_id} )",
                "IN"
            );

            $format                = $xmlDoc->createElement('dc:format', getDatas(
                'mst_gmd',
                'gmd_name',
                'gmd_id',
                $record->gmd_id,
                "=",
                output: 'row'
            ));

            $publisher             = $xmlDoc->createElement('dc:publisher', getDatas(
                'mst_publisher',
                'publisher_name',
                'publisher_id ',
                $record->publisher_id,
                "=",
                output: 'row'
            ));

            $publisher_place             = $xmlDoc->createElement('dc:location', getDatas(
                'mst_place',
                'place_name',
                'place_id ',
                $record->publish_place_id,
                "=",
                output: 'row'
            ));

            $autors =  getDatas(
                table: 'mst_author',
                col: 'author_name',
                whr: 'author_id',
                val: " (SELECT author_id FROM biblio_author where biblio_id = {$record->biblio_id}) ",
                operator: 'IN',
            );

            $oai_dc->appendChild($title);
            if (!empty($autors)) {
                foreach ($autors as $key => $value) {
                    $subjectElement = $xmlDoc->createElement('dc:creator', htmlspecialchars($value->author_name));
                    $oai_dc->appendChild($subjectElement);
                }
            } else {
                $subject = $xmlDoc->createElement('dc:creator', '-');
                $oai_dc->appendChild($subject);
            }
            if (!empty($topics)) {
                foreach ($topics as $key => $value) {
                    $subjectElement = $xmlDoc->createElement('dc:subject', htmlspecialchars($value->topic));
                    $oai_dc->appendChild($subjectElement);
                }
            } else {
                $subject = $xmlDoc->createElement('dc:subject', '-');
                $oai_dc->appendChild($subject);
            }
            $oai_dc->appendChild($publisher);
            $oai_dc->appendChild($date);
            $oai_dc->appendChild($language);
            $oai_dc->appendChild($format);
            $oai_dc->appendChild($identifier);
            $oai_dc->appendChild($description);
            $oai_dc->appendChild($publisher_place);
            $oai_dc->appendChild($identifier_image);
            $oai_dc->appendChild($description_collation);
            $oai_dc->appendChild($call_number);
        }

        $xmlDoc->appendChild($oaiPmh);

        return $this->respondXML($xmlDoc);
    }

    function respondXML($doc)
    {
        return $this->response
            ->setHeader('Content-Type', 'application/xml')
            ->setBody($doc->saveXML());
    }

    private function getRecord()
    {
        $identifier = $this->request->getVar('identifier');
        $metadataPrefix = $this->request->getVar('metadataPrefix');

        if ($metadataPrefix != 'oai_dc') {
            return $this->badRequest('Unsupported metadataPrefix: ' . $metadataPrefix);
        }

        $record = [
            'id' => 1,
            'title' => 'Buku Panduan Setiadi',
            'creator' => 'Penulis 1',
            'date' => '2024-01-01',
        ];

        $response = new SimpleXMLElement('<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/"/>');
        $response->addChild('responseDate', date('Y-m-d\TH:i:s\Z'));
        $getRecord = $response->addChild('GetRecord');

        $recordElement = $getRecord->addChild('record');
        $header = $recordElement->addChild('header');
        $header->addChild('identifier', "oai:setiadi.org:buku/{$record['id']}");
        $header->addChild('datestamp', $record['date']);

        $metadata = $recordElement->addChild('metadata');
        $oai_dc = $metadata->addChild('oai_dc:dc', '', 'http://www.openarchives.org/OAI/2.0/oai_dc/');
        $oai_dc->addAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');

        $oai_dc->addChild('dc:title', $record['title']);
        $oai_dc->addChild('dc:creator', $record['creator']);
        $oai_dc->addChild('dc:date', $record['date']);

        return $this->respond($response->asXML(), 200, 'application/xml');
    }

    private function badRequest($message)
    {
        $response = new SimpleXMLElement('<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/"/>');
        $response->addChild('responseDate', date('Y-m-d\TH:i:s\Z'));
        $error = $response->addChild('error', $message);
        $error->addAttribute('code', 'badVerb');

        return $this->respond($response->asXML(), 400, 'application/xml');
    }

    private function respond($xml, $statusCode, $contentType)
    {
        return $this->response
            ->setStatusCode($statusCode)
            ->setContentType($contentType)
            ->setBody($xml);
    }
}
