<?php

namespace App\Modules\System\Controllers;

use Config\Services;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Modules\System\Models\KontenModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KontenController extends BaseController
{
    use ResponseTrait;

    public $viewPath = "Konten/";
    public function index()
    {
        $view = $this->viewPath . "v_index";
        $title = "Content";

        $konten = new KontenModel();
        $list_konten = $konten->findAll();

        $content = [
            'list_konten' => $list_konten,
        ];

        $js = [
            'assets/custom/js/modules/system/konten',
        ];

        _render($view, $title, $content, $js);
    }

    public function add()
    {
        $view = $this->viewPath . "v_add";
        $title = "Add New Content";
        $content = [];
        $js = [
            'assets/custom/js/modules/system/tambah-konten',
        ];
        _render($view, $title, $content, $js);
    }

    function save()
    {
        $konten = new KontenModel();

        extract($this->input->getPost());
        $now = date("Y-m-d H:i:s");
        $data = [
            'content_title' => trim($content_title),
            'content_path' => trim($content_path),
            'content_desc' => trim($content_desc),
            'input_date' => $now,
            'last_update' => $now,
        ];

        $this->db->transBegin();
        $konten->save($data);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Save new content success failed');
            $log_message = "{$this->session->name} failed add new content";
        } else {
            $this->db->transCommit();
            $log_message = "{$this->session->name} success add new content";
            slim_alert('success', "Save new content success");
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Content', $log_message);

        return redirect()->to('sistem/konten');
    }

    function edit($id)
    {
        $konten = new KontenModel();

        $list_content = $konten->find($id);

        if ($list_content === null) {
            throw PageNotFoundException::forPageNotFound();
        } else {

            $view = $this->viewPath . "v_edit";
            $title = "Edit Data Konten";
            $content = [
                'list_content' => $list_content,
            ];

            $js = [
                'assets/custom/js/modules/system/edit-konten',
            ];
            _render($view, $title, $content, $js);
        }
    }

    function update()
    {
        extract($this->input->getPost());

        $konten = new KontenModel();

        $id = trim($w_id);
        $list_content = $konten->find($id);

        if (!empty($list_content)) {
            $this->db->transBegin();

            $konten->set([
                'content_title' => $content_title,
                'content_path' => $content_path,
                'content_desc' => $content_desc,
                'last_update' => date("Y-m-d H:i:s"),
            ]);
            $konten->where('content_id', $id);
            $konten->update();

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                slim_alert('error', "Update content {$content_title} failed");
            } else {
                $this->db->transCommit();
                slim_alert('success', "Update content {$content_title} success");
            }
        } else {
            slim_alert('error', 'Update content failed');
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Content', $log_message);

        return redirect()->to("sistem/konten");
    }

    function delete()
    {
        $log_message = "Data failed to delete";

        if ($this->input->isAJAX()) {
            $this->db->transBegin();

            $id  = $this->input->getPost('id');
            $konten = new KontenModel();

            $list_content = $konten->find($id);

            if (!empty($list_content)) {
                $konten->delete($id);

                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    $log_message = "Delete content {$list_content->content_title} failed";
                    slim_alert('error', $log_message);

                    $resp = [
                        'status' => 500,
                        'message' => 'Error'
                    ];
                } else {
                    $this->db->transCommit();
                    $log_message = "Delete content {$list_content->content_title} success";
                    slim_alert('success', $log_message);

                    $resp = [
                        'status' => 200,
                        'message' => 'Success'
                    ];
                }
            } else {
                slim_alert('error', $log_message);
                $resp = [
                    'status' => 410,
                    'message' => 'The requested resource is gone and won’t be coming back'
                ];
            }
        } else {
            $resp = [
                'status' => 405,
                'message' => 'Method Not Allowed'
            ];
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Content', $log_message);
        return $this->respond($resp);
    }
}
