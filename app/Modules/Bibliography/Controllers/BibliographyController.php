<?php

namespace App\Modules\Bibliography\Controllers;

// use App\Modules\BibliographyController\Models\BibliographyControllerModel;
use App\Controllers\BaseController;
use App\Modules\Bibliography\Models\BibliographyModel;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use LDAP\Result;

use function PHPUnit\Framework\isEmpty;

class BibliographyController extends BaseController
{
    private $datetime;
    private $bibliopage = "biblio/";
    private $toolspage = "tools/";

    public function __construct()
    {
        $this->datetime = date('YmdHis');
    }
    public function index()
    {

        $biblio = new BibliographyModel();
        $view   = $this->bibliopage . "v_index";
        $title  = "Bibliography";
        $js     = ['assets/custom/js/modules/bibliography/bibliography'];
        $content['data'] = $biblio->orderBy('biblio_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }


    public function add()
    {
        $biblio = new BibliographyModel();
        $view   = $this->bibliopage . "v_add";
        $title  = "Bibliography";
        $js     = ['assets/custom/js/modules/bibliography/bibliography'];
        $css                  = ['assets/custom/css/modules/bibliography/bibliography'];
        $content['mst_data'] = $biblio->getMstBio();
        _render($view, $title, $content, $js, $css);
    }
    public function save()
    {
        $postData = $this->request->getPost();
        // upload image
        $image       = '';
        $user        = $this->session->name;
        $filename    = (string) $_FILES['image']['name'];
        $configImage = $this->_configBerkas($filename, $user);
        $imageFile   = $this->request->getFile('image');
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            if (!is_dir($configImage['upload_path'])) {
                mkdir($configImage['upload_path'], 0755, true);
            }
            $image = $configImage['file_name'];
            $imageFile->move($configImage['upload_path'], $image);
        } else {
            if (!empty($_FILES['image']['name'])) {
                slim_alert('error', 'Failed to save image, please re-upload.');
            }
        }

        // biblio table
        $data = [
            'title'            => $postData['title'] ?? null,
            'gmd_id'           => $postData['gmd'] ?? null,
            'item_type_id'     => $postData['item_type'] ?? null,
            'student_id'       => $postData['student_id'] ?? null,
            'cp_email'         => $postData['cp_email'] ?? null,
            'edition'          => $postData['edition'] ?? null,
            'departement'      => $postData['departement'] ?? null,
            'code_ministry'    => $postData['ministry'] ?? null,
            'publisher_id'     => $postData['publisher'] ?? null,
            'publish_year'     => $postData['year'] ?? null,
            'collation'        => $postData['collation'] ?? null,
            'call_number'      => $postData['callNumber'] ?? null,
            'language_id'      => $postData['language'] ?? null,
            'copyright_id'     => $postData['copyright'] ?? null,
            'license_id'       => $postData['license'] ?? 0,
            'publish_place_id' => $postData['place'] ?? null,
            'classification'   => $postData['class'] ?? null,
            'notes'            => $postData['notes'] ?? null,
            'spec_detail_info' => $postData['specDetailInfo'] ?? null,
            'image'            => $image,
            'url_crossref'     => $postData['urlcrossref'] ?? null,
            'opac_hide'        => 0,
            'promoted'         => 0,
            'frequency_id'     => 0,
            'input_date'       => date('Y-m-d H:i:s'),
            'last_update'      => date('Y-m-d H:i:s'),
            'uid'              => $this->session->user_id
        ];

        $biblio = new BibliographyModel();
        $lastId = $biblio->insertBiblio($data);
        if ($lastId == 0) {
            slim_alert('error', 'Failed to save document.');
            return redirect()->to('/bibliography/');
        }

        $result       = $biblio->insertBilioSub($lastId, $postData, FALSE);
        if ($result) {
            slim_alert('success', 'Successfully Added Document.');
        } else {
            // slim_alert('error', 'Failed to Add Document.');
        }
        return redirect()->to('/bibliography/');
    }
    function uploadattachment($user,  $url, $biblio_id, $fl,  $aksesFiles = [], $aksesMembers = null, $title = [], $desk_file = null)
    {
        $filenm = '';
        $files  = $this->request->getFiles()['attc_file'];
        foreach ($files as $i => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $config   = $this->_configBerkas($file->getName(), $user . $biblio_id, 'attahcment',  $i);
                $filenm   = $config['file_name'];
                $filepath = $config['upload_path'];
                $file->move($filepath, $filenm);
                $data = [
                    "file_title"  => isset($title[$i]) ? $title[$i] : '-',
                    "file_desc"   => isset($desk_file[$i]) ? $desk_file[$i] : '-',
                    "file_name"   => $filenm,
                    "file_dir"    => $filepath,
                    "file_url"    => '',
                    "uploader_id" => $this->session->user_id,
                    "input_date"  => date('Y-m-d H:i:s'),
                    "last_update" => date('Y-m-d H:i:s'),
                ];
                $biblio      = new BibliographyModel();
                $lastIdFile  = $biblio->insertFiles($data);
                $data_biblio = [
                    'biblio_id'    => $biblio_id,
                    'file_id'      => $lastIdFile,
                    'access_type'  => isset($aksesFiles[$i]) ? $aksesFiles[$i] : 'private',
                    'access_limit' => isset($aksesMembers[$i]) ? $aksesMembers[$i] : 0,
                ];

                $biblio->insertBiblioFiles($data_biblio);
            } else {
                $error = $file->getErrorString();
            }
        }
    }
    public function edit()
    {
        $biblio              = new BibliographyModel();
        $view                = $this->bibliopage . "v_edit";
        $title               = "Bibliography";
        $content['user_id']  = $this->session->user_id;
        $content['mst_data'] = $biblio->getMstBio();
        $content['data']     = $biblio->getData(slim_decrypt($this->input->getGet('bbi')));
        $js                  = ['assets/custom/js/modules/bibliography/bibliography'];
        $css                 = ['assets/custom/css/modules/bibliography/bibliography'];

        _render($view, $title, $content, $js, $css);
    }
    public function update()
    {
        // dd($this->session->user_id, 1);  
        $postData = $this->request->getPost();
        $data = [
            'title'            => $postData['title'] ?? null,
            'gmd_id'           => $postData['gmd'] ?? null,
            'item_type_id'     => $postData['item_type'] ?? null,
            'student_id'       => $postData['student_id'] ?? null,
            'cp_email'         => $postData['cp_email'] ?? null,
            'edition'          => $postData['edition'] ?? null,
            'departement'      => $postData['departement'] ?? null,
            'code_ministry'    => $postData['ministry'] ?? null,
            'publisher_id'     => $postData['publisher'] ?? null,
            'publish_year'     => $postData['year'] ?? null,
            'collation'        => $postData['collation'] ?? null,
            'call_number'      => $postData['callNumber'] ?? null,
            'language_id'      => $postData['language'] ?? null,
            'copyright_id'     => $postData['copyright'] ?? null,
            'license_id'       => $postData['license'] ?? 0,
            'publish_place_id' => $postData['place'] ?? null,
            'classification'   => $postData['class'] ?? null,
            'notes'            => $postData['notes'] ?? null,
            'spec_detail_info' => $postData['specDetailInfo'] ?? null,
            'url_crossref'     => $postData['urlcrossref'] ?? null,
            'opac_hide'        => 0,
            'promoted'         => 0,
            'frequency_id'     => 0,
            'input_date'       => date('Y-m-d H:i:s'),
            'last_update'      => date('Y-m-d H:i:s')
        ];
        $biblio_id   = $postData['biblio_id'];
        $biblio      = new BibliographyModel();
        $list_biblio = $biblio->find($biblio_id);
        if (!empty($list_biblio)) {
            $rules = [
                'image' => [
                    'label' => 'Image File',
                    'rules' => 'if_exist|is_image[image]'
                        . '|is_image[image]'
                        . '|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
                        . '|max_size[image,500]'
                        . '|max_dims[image,4000,4000]',
                ],
            ];
            $rulesPdf = [
                'file' => [
                    'label' => 'PDF File',
                    'rules' => 'if_exist|mime_in[file,application/pdf]'
                        . '|max_size[file,500]'
                        . '|ext_in[file,pdf]',
                ],
            ];

            if (!$this->validate($rules) || !$this->validate($rulesPdf)) {

                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            } else {
                $image        = '';
                $attach       = '';
                $user         = $this->session->user_id;
                $filename     = (string) $_FILES['image']['name'];
                $configImage  = $this->_configBerkas($filename, $user);
                $imageFile    = $this->request->getFile('image');
                // upload attachment
                $titles       = $postData['title_file'];
                $urls         = $postData['url_file'];
                $descriptions = $postData['desk_file'];
                $aksesFiles   = $postData['akses_file'];
                $aksesMembers = $postData['akses_member'];

                if ($imageFile->isValid() && !$imageFile->hasMoved()) {


                    if (!is_dir($configImage['upload_path'])) {

                        mkdir($configImage['upload_path'], 0755, true);
                    }

                    $image = $configImage['file_name'];
                    $imageFile->move($configImage['upload_path'], $image);
                } else {

                    $image = null;
                }

                if (!empty($image)) {
                    $data['image'] = $image;
                }

                $biblio->set($data);
                $biblio->where('biblio_id', $biblio_id);
                $biblio->update();

                $biblio->insertBilioSub($biblio_id, $postData, TRUE);
                $this->uploadattachment($user, $urls, $biblio_id, $_FILES['attc_file'], $aksesFiles, $aksesMembers, $titles, $descriptions);

                // Handle updates to existing attachments
                if (isset($postData['edit_file_id']) && is_array($postData['edit_file_id'])) {
                    foreach ($postData['edit_file_id'] as $index => $fileId) {
                        $fileData = [
                            'file_title' => $postData['edit_title_file'][$index] ?? '',
                            'file_desc' => $postData['edit_desk_file'][$index] ?? '',
                            'file_url' => $postData['edit_url_file'][$index] ?? '',
                            'last_update' => date('Y-m-d H:i:s')
                        ];

                        $biblioFileData = [
                            'access_type' => $postData['edit_akses_file'][$index] ?? 'private',
                            'access_limit' => $postData['edit_akses_member'][$index] ?? 0
                        ];
                        log_message('debug', 'Updating biblio_attachment for biblio_id: ' . $biblio_id . ', file_id: ' . $fileId . ', access_type: ' . $biblioFileData['access_type'] . ', access_limit: ' . $biblioFileData['access_limit']);
                        
                        // Check if the record exists before updating
                        $existingRecord = $this->db->table('biblio_attachment')
                            ->where('biblio_id', $biblio_id)
                            ->where('file_id', $fileId)
                            ->get()
                            ->getRowArray();
                        if ($existingRecord) {
                            log_message('debug', 'Record found in biblio_attachment for biblio_id: ' . $biblio_id . ', file_id: ' . $fileId);
                        } else {
                            log_message('error', 'No record found in biblio_attachment for biblio_id: ' . $biblio_id . ', file_id: ' . $fileId);
                            // Fallback: Insert a new record if it doesn't exist
                            $this->db->table('biblio_attachment')->insert([
                                'biblio_id' => $biblio_id,
                                'file_id' => $fileId,
                                'access_type' => $biblioFileData['access_type'],
                                'access_limit' => $biblioFileData['access_limit']
                            ]);
                            log_message('debug', 'Inserted new record in biblio_attachment for biblio_id: ' . $biblio_id . ', file_id: ' . $fileId);
                        }

                        // Handle file upload if a new file is provided for this attachment
                        if (isset($_FILES['edit_attc_file']['name'][$index]) && !empty($_FILES['edit_attc_file']['name'][$index])) {
                            $file = $this->request->getFile("edit_attc_file.$index");
                            if ($file && $file->isValid() && !$file->hasMoved()) {
                                $config = $this->_configBerkas($file->getName(), $user . $biblio_id, 'attachment', 0);
                                $fileName = $config['file_name'];
                                $filePath = $config['upload_path'];
                                $file->move($filePath, $fileName);
                                $fileData['file_name'] = $fileName;
                                $fileData['file_dir'] = $filePath;
                                $fileData['mime_type'] = $file->getMimeType();
                            }
                        }

                        // Update the file and biblio attachment records
                        $fileUpdateResult = $this->db->table('files')->where('file_id', $fileId)->update($fileData);
                        $biblioFileUpdateResult = $this->db->table('biblio_attachment')
                            ->where('biblio_id', $biblio_id)
                            ->where('file_id', $fileId)
                            ->update($biblioFileData);
                        if ($biblioFileUpdateResult) {
                            log_message('debug', 'Update successful for biblio_attachment - biblio_id: ' . $biblio_id . ', file_id: ' . $fileId);
                        } else {
                            log_message('error', 'Update failed for biblio_attachment - biblio_id: ' . $biblio_id . ', file_id: ' . $fileId . ', affected rows: ' . $this->db->affectedRows());
                        }
                        log_message('debug', 'Update results - File update: ' . ($fileUpdateResult ? 'Success' : 'Failed') . ', Biblio attachment update: ' . ($biblioFileUpdateResult ? 'Success' : 'Failed'));
                    }
                }
            }

            $hasil = $biblio->updateBiblio($postData['biblio_id'], $data);

            if ($hasil) {
                slim_alert('success', 'Successfully Added Document.');
            } else {
                slim_alert('error', 'Failed to Add Document.');
            }
        }
        return redirect()->to('/bibliography/');
    }

    public function atthacmentDelete($biblio_id = null, $fileId = null)
    {
        $fileId    = is_null($fileId) ? $this->request->getPost('f_id') : $fileId;
        $biblio_id = is_null($biblio_id) ? $this->request->getPost('b_id') : $biblio_id;

        $loadModel = new BibliographyModel();
        $hasil = $loadModel->attDelete($biblio_id, $fileId);
        $return = 1;
        if ($hasil === false) {
            slim_alert('error', 'Data failed to delete');
            $return = 0;
        }
        echo json_encode($return);
    }

    public function getAttachment()
    {
        $fileId = $this->request->getPost('file_id');
        $biblioId = $this->request->getPost('biblio_id');
        
        $loadModel = new BibliographyModel();
        $attachment = [];
        
        // Check if the method exists in the model
        if (method_exists($loadModel, 'getAttachmentData')) {
            $attachment = $loadModel->getAttachmentData($biblioId, $fileId);
        } else {
            // Fallback query if method does not exist
            $sql = "SELECT f.*, ba.access_type, ba.access_limit 
                    FROM files f 
                    JOIN biblio_attachment ba ON f.file_id = ba.file_id 
                    WHERE ba.biblio_id = ? AND f.file_id = ?";
            $query = $this->db->query($sql, [$biblioId, $fileId]);
            $attachment = $query->getRowArray();
            log_message('error', 'getAttachmentData method not found in BibliographyModel. Using fallback query.');
        }
        
        if ($attachment) {
            $response = [
                'status' => 'success',
                'data' => $attachment
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Attachment not found for biblio_id: ' . $biblioId . ' and file_id: ' . $fileId
            ];
            log_message('error', 'Attachment not found for biblio_id: ' . $biblioId . ' and file_id: ' . $fileId);
        }
        
        return json_encode($response);
    }

    public function updateAttachment()
    {
        $postData = $this->request->getPost();
        $fileId = $postData['file_id'];
        $biblioId = $postData['biblio_id'];
        
        $data = [
            'file_title' => $postData['edit_title_file'] ?? '',
            'file_desc' => $postData['edit_desk_file'] ?? '',
            'file_url' => $postData['edit_url_file'] ?? '',
            'last_update' => date('Y-m-d H:i:s')
        ];
        
        $biblioData = [
            'access_type' => $postData['edit_akses_file'] ?? 'private',
            'access_limit' => $postData['edit_akses_member'] ?? 0
        ];
        
        // Handle file upload if a new file is provided
        $user = $this->session->user_id;
        $file = $this->request->getFile('edit_attc_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $config = $this->_configBerkas($file->getName(), $user . $biblioId, 'attachment', 0);
            $fileName = $config['file_name'];
            $filePath = $config['upload_path'];
            $file->move($filePath, $fileName);
            $data['file_name'] = $fileName;
            $data['file_dir'] = $filePath;
            $data['mime_type'] = $file->getMimeType();
        }
        
        $loadModel = new BibliographyModel();
        $updatedFile = false;
        $updatedBiblioFile = false;
        
        // Check if methods exist in the model, use direct database update if not
        if (method_exists($loadModel, 'updateFile')) {
            $updatedFile = $loadModel->updateFile($fileId, $data);
        } else {
            $updatedFile = $this->db->table('files')->where('file_id', $fileId)->update($data);
            log_message('error', 'updateFile method not found in BibliographyModel. Using direct database update.');
        }
        
        if (method_exists($loadModel, 'updateBiblioFile')) {
            $updatedBiblioFile = $loadModel->updateBiblioFile($biblioId, $fileId, $biblioData);
        } else {
            $updatedBiblioFile = $this->db->table('biblio_attachment')
                ->where('biblio_id', $biblioId)
                ->where('file_id', $fileId)
                ->update($biblioData);
            log_message('error', 'updateBiblioFile method not found in BibliographyModel. Using direct database update.');
        }
        
        if ($updatedFile || $updatedBiblioFile) {
            $response = [
                'status' => 'success',
                'message' => 'Attachment updated successfully',
                'file_updated' => $updatedFile,
                'biblio_file_updated' => $updatedBiblioFile
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to update attachment. File update: ' . ($updatedFile ? 'Success' : 'Failed') . ', Biblio file update: ' . ($updatedBiblioFile ? 'Success' : 'Failed'),
                'file_updated' => $updatedFile,
                'biblio_file_updated' => $updatedBiblioFile
            ];
            log_message('error', 'Failed to update attachment for biblio_id: ' . $biblioId . ' and file_id: ' . $fileId);
        }
        
        return json_encode($response);
    }


    private function _configBerkas($file, $user, $ket = null, $i = null)
    {
        $index = 0;
        if (!is_null($i)) {
            if ($i > 0) {
                $index = $i;
            }
        }

        $config = [];
        $ext    = pathinfo($file, PATHINFO_EXTENSION);
        if (!is_null($ket)) {
            $path = 'uploads/repository';
            if (!is_dir('./' . $path)) {
                mkdir('./' . $path, 0777, TRUE);
            }
            // atthacment
            $save = 'B_' . $user . '_' . $ket . '-' . $this->datetime . '-' . $index . '.' . $ext;

            $config['allowed_types'] = 'pdf';
            $config['max_size']      = '51200';
            $config['upload_path']   = './' . $path;
        } else {
            $path = 'uploads/images/docs';
            if (!is_dir('./' . $path)) {
                mkdir('./' . $path, 0777, TRUE);
            }
            // imange doc
            $save = 'cover_' . $user . '-' . $this->datetime . '-' . $index . '.' . $ext;

            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = '500';
            $config['upload_path']   = './' . $path;
        }
        $config['file_name'] = $save;

        return $config;
    }


    public function delete()
    {
        $biblio_id = $this->request->getPost('id');
        $biblio = new BibliographyModel();
        $list_biblio = $biblio->find($biblio_id);
        $response = ['status' => 'error', 'message' => 'Record not found'];

        if (!empty($list_biblio)) {
            try {
                // Attempt to delete associated image
                if (!empty($list_biblio['image'])) {
                    $hapusImage = delImage('images\docs', $list_biblio['image']);
                    if ($hapusImage == 0 || $hapusImage == '-1') {
                        log_message('error', 'File Not Exist for biblio_id: ' . $biblio_id);
                    }
                }

                // Delete associated attachments
                $sql = "SELECT file_id FROM biblio_attachment WHERE biblio_id = ?";
                $hasil = $this->db->query($sql, [$biblio_id]);

                if ($hasil->getNumRows() > 0) {
                    foreach ($hasil->getResult() as $val) {
                        $this->atthacmentDelete($biblio_id, $val->file_id);
                    }
                }

                // Delete related records from associated tables
                $tables = [
                    'biblio_author',
                    'biblio_contributor',
                    'biblio_supervisor',
                    'biblio_examiner',
                    'biblio_topic'
                ];

                foreach ($tables as $table) {
                    $this->db->table($table)->where(['biblio_id' => $biblio_id])->delete();
                }

                // Delete the main biblio record
                $deleted = $this->db->table('biblio')->where(['biblio_id' => $biblio_id])->delete();

                if ($deleted) {
                    $response = ['status' => 'success', 'message' => 'Record deleted successfully', 'id' => $biblio_id];
                } else {
                    $response = ['status' => 'error', 'message' => 'Failed to delete main record'];
                }
            } catch (\Exception $e) {
                log_message('error', 'Error deleting biblio_id: ' . $biblio_id . ' - ' . $e->getMessage());
                $response = ['status' => 'error', 'message' => 'An error occurred while deleting the record'];
            }
        }

        return json_encode($response);
    }

    public function addOptions()
    {

        $db    = \Config\Database::connect();
        $now   = date('Y-m-d');
        $name  = $this->request->getPost('name');
        $tbl   = $this->request->getPost('tbl');
        $optFor = ucwords(strtolower(str_replace('_', ' ', $tbl)));
        $rules = [
            'name' => 'required|alpha_space',
        ];


        if (!$this->validate($rules)) {
            $status   = 'warning';
            $message  = "Nama tidak boleh kosong atau tidak valid.";
            $title    = $optFor;
            $data     = '';
        } else {
            if ($tbl == 'language' || $tbl == 'item_type' || $tbl == 'gmd') {
                $idnya = $this->request->getPost('idnya');

                $query = $db->table("mst_{$tbl}")
                    ->where("{$tbl}_id", $idnya)
                    ->orWhere("{$tbl}_name", $name);

                if ($tbl == 'item_type' || $tbl == 'gmd') {
                    $query->orWhere("{$tbl}_code", $name);
                }

                $existingLanguage = $query->get()->getRow();

                if (!$existingLanguage) {
                    $data = [
                        "{$tbl}_name" => $name,
                        'input_date'  => $now,
                    ];
                    if ($tbl == 'item_type' || $tbl == 'gmd') {
                        $data["{$tbl}_code"]   = $idnya;
                    } else {
                        $data["{$tbl}_id"]   = $idnya;
                    }

                    $db->table("mst_{$tbl}")->insert($data);
                    $lastId  = ($tbl == 'language') ? $idnya : $db->insertID();
                    $name    = ucwords(strtolower($name));
                    $status  = "success";
                    $message = "Berhasil tambah data {$name}.";
                    $title   = $optFor;
                    $data    = [
                        'id'  => $lastId,
                        'val' => $name
                    ];
                } else {
                    $message    = 'Language ';
                    if ($existingLanguage->language_id == $idnya) {
                        $message    = $message . $existingLanguage->language_id;
                    } elseif ($existingLanguage->language_name == $name) {
                        $message    =  $message . $existingLanguage->language_name;
                    }
                    $status   = 'warning';
                    $message  = $message . " sudah ada.";
                    $title    = $optFor;
                    $data     = '';
                }
            } else {
                $this->db->table("mst_{$tbl}")->insert([
                    "{$tbl}_name" => $name,
                    'input_date'  => $now,
                ]);

                $lastId  = $db->insertID();
                $name    = ucwords(strtolower($name));
                $status  = "success";
                $message = "Berhasil tambah data {$name}.";
                $title   = $optFor;
                $data    = [
                    'id'  => $lastId,
                    'val' => $name
                ];
            }
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $data,
            "title"   => $title
        ];

        return $this->response->setJSON($response);
    }
    public function addMinistry()
    {
        $db         = \Config\Database::connect();
        $now        = date('Y-m-d');
        $idnya      = $this->request->getPost('codenya');
        $nama_prodi = $this->request->getPost('nama_prodi');
        $degree     = $this->request->getPost('degree');
        $university = $this->request->getPost('university');
        $tbl        = $this->request->getPost('tbl');
        $optFor     = ucwords(strtolower(str_replace('_', ' ', $tbl)));

        $query = $db->table("mst_code_ministry")
            ->where("code_ministry", $idnya)
            ->Where("name_prodi", $nama_prodi);
        $existingLanguage = $query->get()->getRow();

        if (!$existingLanguage) {
            $data = [
                "code_ministry" => $idnya,
                "name_prodi"    => $nama_prodi,
                "degree"        => $degree,
                "university"    => $university,
                'input_date'    => $now,
            ];

            $db->table("mst_code_ministry")->insert($data);
            $lastId  =  $db->insertID();
            $name    = ucwords(strtolower($nama_prodi));
            $status  = "success";
            $message = "Berhasil tambah data id {$idnya} untuk Prodi {$nama_prodi}.";
            $title   = $optFor;
            $data    = [
                'id'  => $lastId,
                'val' => $idnya . ' - ' . $name
            ];
        } else {
            $status   = 'warning';
            $message  = "Data Sudah Ada.";
            $title    = $optFor;
            $data     = '';
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $data,
            "title"   => $title
        ];

        return $this->response->setJSON($response);
    }
}
