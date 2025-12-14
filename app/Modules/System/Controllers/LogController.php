<?php

namespace App\Modules\System\Controllers;

use App\Controllers\BaseController;
use App\Modules\System\Models\LogModel;

class LogController extends BaseController
{
    public $viewPath = "Log/";
    public function index()
    {
        $view = $this->viewPath . "v_index";
        $title = "System Logs";

        $logs = new LogModel();
        $list_logs = $logs->orderBy('log_date', 'desc')
            ->get()
            ->getResult();

        $content = [
            'list_logs' => $list_logs,
        ];
        $js = [];
        _render($view, $title, $content, $js);
    }

    function delete()
    {
        $logs = new LogModel();

        $this->db->transBegin();

        $logs->truncate();

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', "Failed remove system log");
        } else {
            $this->db->transCommit();
            slim_alert('success', "Success remove system log");
        }
    }

    function save()
    {

        $logs = new LogModel();

        $list_logs = $logs->select('log_date, log_location, log_msg')
            ->orderBy('log_date', 'desc')
            ->get()
            ->getResult();

        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="system_logs_' . date('Ymd_His') . '.log"');
        echo 'system logs record' . "\n";

        foreach ($list_logs as $key => $val) {
            echo '[' . $val->log_date . ']---' . $val->log_location . '---' . $val->log_msg . "\n";
        }

        exit();
    }
}
