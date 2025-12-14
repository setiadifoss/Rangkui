<?php

namespace App\Modules\System\Controllers;

use Exception;
use MongoDB\Client;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use Composer\Semver\VersionParser;
use App\Controllers\BaseController;
use App\Modules\System\Models\IndexBiblioModel;

class IndexBiblioController extends BaseController
{
    use ResponseTrait;

    private $max_indexed = 1000000;
    private $index_type = 'search_biblio';

    public $viewPath = "IndexBiblio/";
    public $mongo;

    public function __construct() {}

    public function index()
    {
        $biblio_total = $this->db->table('biblio')
            ->get()
            ->getNumRows();

        $index_type = $_ENV['INDEX_TYPE'];
        if ($index_type == "mysql") {
            $search_biblio  = new IndexBiblioModel();
            $idx_total = $search_biblio->countAllResults();
        } else {

            //check avaibility mongodb
            $output = "";
            exec("php -i | grep -i mongodb", $output);

            $filteredArray = array_filter($output, function ($item) {
                return strpos($item, 'MONGO_URL') === false;
            });

            $idx_total = 0;
            if ($filteredArray !== "" || $filteredArray == true) {
                $packageMongo = \Composer\InstalledVersions::getPrettyVersion('mongodb/mongodb');

                if (!is_null($packageMongo)) {
                    // Pilih database dan koleksi
                    $this->mongo = Services::mongo();

                    $collection = $this->mongo->biblio;

                    try {
                        $idx_total = $collection->countDocuments();
                    } catch (Exception $e) {
                        slim_alert('error', 'Failed connect to mongodb');
                        return redirect()->to('/home');
                    }
                }
            }
        }

        $unidx_total = $biblio_total - $idx_total;

        $view = $this->viewPath . "v_index";
        $title = formatString(lang("Messages.index_biblio"));
        $content = [
            'unidx_total' => $unidx_total,
            'biblio_total' => $biblio_total,
            'idx_total' => $idx_total,
        ];
        $js = [];
        _render($view, $title, $content, $js);
    }

    function add()
    {
        $view = $this->viewPath . "v_add";
        $title = formatString(lang("Messages.index_biblio"));
        $content = [];
        $js = [
            'assets/custom/js/modules/system/indexbliblio'
        ];
        _render($view, $title, $content, $js);
    }

    function delete()
    {
        $index_type = env('INDEX_TYPE', 'mysql');

        $log_message = "Delete index biblio";
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'IndexBiblio', $log_message);

        if ($index_type == "mysql") {
            $biblio = new IndexBiblioModel();

            $this->db->transBegin();
            $biblio->truncate();
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                slim_alert('error', "Failed Empty Index");
            } else {
                $this->db->transCommit();
                slim_alert('success', "Success Empty Index");
            }
        } else {
            $this->mongo = Services::mongo();
            // remove collection biblio
            $this->mongo->biblio->drop();
        }

        return redirect()->to('sistem/indeks-biblio');
    }

    function check()
    {
        if ($this->input->isAJAX()) {
            extract($this->input->getPost());

            $status = "error";

            switch ($type) {
                case 'nosql':
                    $message = '<ul  style="margin-left:-22px">';

                    $output = "";
                    exec("php -i | grep -i mongodb", $output);

                    $filteredArray = array_filter($output, function ($item) {
                        // Mengembalikan true jika tidak ada kata 'MONGO_URL' dalam elemen
                        return strpos($item, 'MONGO_URL') === false;
                    });

                    if ($filteredArray == "" || $filteredArray == false) {
                        $status = "error";
                        $message .= '<li>Activated mongodb extension first <i class="fa fa-exclamation-triangle text-danger"></i></li>';
                    } else {
                        $status = "success";
                        $filteredArray = array_intersect_key($filteredArray, array_flip([1, 2]));
                        foreach ($filteredArray as $key => $val) {
                            $message .= "<li>";
                            $message .= str_replace("=>", " : ", $val);
                            $message .= "</li>";
                        }

                        $packageMongo = \Composer\InstalledVersions::getPrettyVersion('mongodb/mongodb');

                        $message .= "<li>";
                        if (!is_null($packageMongo)) {
                            $message .= "MongoDB package : {$packageMongo}";
                        } else {
                            $status = "error";
                            $message .= "Please run composer require mongodb/mongodb:^1.15.0";
                        }

                        $message .= "</li>";
                    }


                    $message .= '</ul>';

                    $message = trim($message);
                    break;

                case 'mysql':
                    $db = \Config\Database::connect();
                    $connected = "failed";
                    if ($db->simpleQuery('select * from user')) {
                        $connected = "success";
                        $status = "success";
                    }

                    $message = "Database Connection : {$connected}";
                    break;

                default:
                    $message = "Request not found";
                    break;
            }


            $resp = [
                'status' => $status,
                'message' => $message,
            ];
            return $this->respond($resp);
        }
    }

    function save()
    {
        set_time_limit(0);

        extract($this->input->getPost());

        switch ($index_type) {
            case 'mysql':
                return $this->_idxMySQL($index_type);
                break;
            case 'nosql':
                return $this->_idxNoSQL($index_type);
                break;
        }
    }

    function reindex()
    {
        set_time_limit(0);

        $index_type = $_ENV['INDEX_TYPE'] ?? "mysql";

        switch ($index_type) {
            case 'mysql':
                return $this->_reidxMySQL($index_type);
                break;
            case 'nosql':
                return $this->_reidxNoSQL($index_type);
                break;
        }
    }

    private function _idxMySQL(string $index_type)
    {
        $biblio = new IndexBiblioModel();
        $biblio->index_type = $index_type;

        $list_biblio = $biblio->selectCount('*')->countAllResults();

        $message = "";
        if ($list_biblio > 0) {
            slim_alert('error', 'Failed', 'Please empty the Index first before re-creating the Index');
        } else {
            $biblio->createFullIndex();

            $finish_minutes = $biblio->indexingTime / 60;
            $finish_sec = $biblio->indexingTime / 60;

            $status = "";
            if (count($biblio->failed) > 0) {
                $status = "error";
                $message = "Error";
                $text = sprintf('<strong>%d</strong> index records failed to indexed. The IDs are: %s', count($biblio->failed), implode(', ', $biblio->failed));
            } else {
                $status = "success";
                $message = "Success";
                $text = sprintf('<strong>%d</strong> records (from total of <strong>%d</strong>) was indexing. Finished in %d second(s)', $biblio->indexed, $biblio->total_records, $finish_minutes, $finish_sec);
            }

            slim_alert($status, $message, $text);
        }

        $log_message = "add index {$index_type} biblio ";
        $log_message .= $message;
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'IndexBiblio', $log_message);

        return redirect()->to('sistem/indeks-biblio');
    }

    private function _idxNoSQL(string $index_type)
    {
        // Pilih database dan koleksi
        $this->mongo = Services::mongo();
        $collection = $this->mongo->biblio;
        $list_biblio = $collection->countDocuments();

        $message = "";

        if ($list_biblio > 0) {
            $message = 'Please empty the Index first before re-creating the Index';
            slim_alert('error', 'Failed', $message);
        } else {

            $biblio = new IndexBiblioModel();
            $biblio->index_type = $index_type;
            $biblio->createFullIndex();

            $finish_minutes = $biblio->indexingTime / 60;
            $finish_sec = $biblio->indexingTime / 60;

            $message = "";
            $status = "";
            if (count($biblio->failed) > 0) {
                $status = "error";
                $message = "Error";
                $text = sprintf('<strong>%d</strong> index records failed to indexed. The IDs are: %s', count($biblio->failed), implode(', ', $biblio->failed));
            } else {
                $status = "success";
                $message = "Success";
                $text = sprintf('<strong>%d</strong> records (from total of <strong>%d</strong>) was indexing. Finished in %d second(s)', $biblio->indexed, $biblio->total_records, $finish_minutes, $finish_sec);
            }

            slim_alert($status, $message, $text);
        }

        $log_message = "add index {$index_type} biblio ";
        $log_message .= $message;
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'IndexBiblio', $log_message);

        return redirect()->to('sistem/indeks-biblio');
    }


    private function _reidxMySQL(string $index_type)
    {
        $biblio = new IndexBiblioModel();
        $biblio->index_type = $index_type;

        $biblio->updateFullIndex();

        $finish_minutes = $biblio->indexingTime / 60;
        $finish_sec     = $biblio->indexingTime / 60;

        $message = "";
        $status  = "";
        if (count($biblio->failed) > 0) {
            $status    = "error";
            $message   = "Error";
            $failed_id = array_column($biblio->failed, 'id');
            $text      = sprintf('<strong>%d</strong> index records failed to indexed. The IDs are: %s', count($biblio->failed), implode(', ', $failed_id));
        } else {
            $status  = "success";
            $message = "Success";
            $text    = sprintf('<strong>%d</strong> records (from total of <strong>%d</strong>) re-indexed. Finished in %d second(s)', $biblio->indexed, $biblio->total_records, $finish_minutes, $finish_sec);
        }

        slim_alert($status, $message, $text);

        $log_message = "re-index {$index_type} biblio ";
        $log_message .= $message;
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'IndexBiblio', $log_message);

        return redirect()->to('sistem/indeks-biblio');
    }

    private function _reidxNoSQL(string $index_type)
    {
        $biblio = new IndexBiblioModel();
        $biblio->index_type = $index_type;

        $biblio->updateFullIndex();

        $finish_minutes = $biblio->indexingTime / 60;
        $finish_sec = $biblio->indexingTime / 60;

        $message = "";
        $status = "";
        if (count($biblio->failed) > 0) {
            $status = "error";
            $message = "Error";
            $text = sprintf('<strong>%d</strong> index records failed to indexed. The IDs are: %s', count($biblio->failed), implode(', ', $biblio->failed));
        } else {
            $status = "success";
            $message = "Success";
            $text = sprintf('<strong>%d</strong> records (from total of <strong>%d</strong>) re-indexed. Finished in %d second(s)', $biblio->indexed, $biblio->total_records, $finish_minutes, $finish_sec);
        }

        slim_alert($status, $message, $text);

        $log_message = "re-index {$index_type} biblio ";
        $log_message .= $message;
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'IndexBiblio', $log_message);

        return redirect()->to('sistem/indeks-biblio');
    }
}
