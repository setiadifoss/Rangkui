<?php

namespace App\Modules\System\Controllers;

use App\Controllers\BaseController;
use App\Modules\System\Models\BackupModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\Exceptions\FileNotFoundException;
use Config\Services;

class BackupController extends BaseController
{
    public $viewPath = "Backup/";
    public function index()
    {
        $log_message = "{$this->session->name} access backup ";
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Backup', $log_message);

        $view = $this->viewPath . "v_index";
        $title = "Database Backup";

        $bm = new BackupModel();

        $list_backup = $bm->getBackup();


        $content = [
            'list_backup' => $list_backup,
        ];

        $js = [];
        _render($view, $title, $content, $js);
    }

    public function add()
    {
        $log_message = "{$this->session->name} trying backup ";
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Backup', $log_message);

        sleep(2);

        // Services::writeLog()
        $output = '';
        // turn on implicit flush
        ob_implicit_flush();
        // checking if the binary can be executed
        $mysql_dump_path = shell_exec('where mysqldump');

        $time2append = date("Ymd_His");

        $backupPath = WRITEPATH . 'backup';
        $fullPath = $backupPath . DS . "backup_{$time2append}.sql";

        $exist_dir = false;
        $writable_dir = false;
        // Cek apakah folder 'backup' ada
        if (!is_dir($backupPath)) {
            // Jika tidak ada, buat folder dengan izin akses bisa ditulis
            if (mkdir($backupPath, 0777, true)) {
                $exist_dir = true;
                $writable_dir = true;
            }
        } else {
            // Jika ada, cek apakah bisa ditulis
            if (!is_writable($backupPath)) {
                // Jika tidak bisa ditulis, ubah izin aksesnya
                if (chmod($backupPath, 0777)) {
                    $exist_dir = true;
                    $writable_dir = true;
                }
            } else {
                $writable_dir = true;
                $exist_dir = true;
            }
        }

        if ($exist_dir === true &&  $writable_dir === true) {
            $db_host = $this->db->hostname;
            $db_name = $this->db->database;
            $db_user = $this->db->username;
            $db_password = $this->db->password;

            $mysql_dump_path = trim($mysql_dump_path);
            $command = "{$mysql_dump_path} -B {$db_name} ";
            $command .= "--no-create-db --quick --user={$db_user} ";
            $command .= "--password={$db_password} ";
            $command .= "--host={$db_host} ";
            $command .= " > {$fullPath} ";

            exec($command, $output, $status);

            if ($status == COMMAND_SUCCESS || $status == 1) {

                $user_id = $this->session->user_id;
                $backup_time = date("Y-m-d H:i:s");

                $data = [
                    'user_id' => $user_id,
                    'backup_time' => $backup_time,
                    'backup_file' => $this->db->escapeString($fullPath),
                ];

                $output = "Backup SUCCESSFUL, backup files saved to {$backupPath} !";

                if (!preg_match('@^WIN.*@i', PHP_OS)) {
                    // get current directory path
                    $curr_dir = getcwd();
                    // change current PHP working dir
                    @chdir($backupPath);
                    // compress the backup using tar gz

                    $command = "";
                    $command .= "tar cvzf backup_{$time2append}.sql.tar.gz";
                    $command .= " backup_{$time2append}.sql";

                    exec($command, $outputs, $status);
                    if ($status == COMMAND_SUCCESS) {
                        // delete the original file
                        @unlink($data['backup_file']);
                        $output .= "File is compressed using tar gz archive format";

                        $fullPath = $backupPath . DS . "backup_{$time2append}.sql.tar.gz";

                        $data['backup_file'] = $this->db->escapeString($fullPath);
                    }
                    // return to previous PHP working dir
                    @chdir($curr_dir);
                }

                $b = new BackupModel();

                $this->db->transBegin();

                $b->insert($data);


                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    slim_alert('error', $this->db->error());
                    $log_message = "{$this->session->name} backup failed : {$this->db->error}";
                } else {
                    $this->db->transCommit();
                    slim_alert('success', "Backup database success, {$this->db->escapeString($output)}");
                    $log_message = "{$this->session->name} backup success}";
                }
            } else if ($status == COMMAND_FAILED) {
                $log_message = 'Backup FAILED! Wrong user or password to connect to database server!';
                slim_alert('error', $log_message);
            }
        } else {
            $log_message = "Backup FAILED! The Backup directory is not exists or not writeable";
            $log_message .= "Contact System Administrator for the right path of backup directory";

            slim_alert('error', $log_message);
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Backup', $log_message);
        return redirect()->to('sistem/backups');
    }

    function download($id)
    {

        $backup = new BackupModel();

        $backupFile = $backup->find($id);

        if ($backupFile === null) {
            throw PageNotFoundException::forPageNotFound();
        } else {

            $filePath = $backupFile->backup_file;

            if (file_exists($filePath)) {

                $log_message = "Download backup file";
                Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Backup', $log_message);

                return $this->response->download($filePath, null);
            } else {

                $log_message = "Download backup file failed";
                Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Backup', $log_message);

                slim_alert('error', "File not found : {$filePath}");
                return redirect()->to('sistem/backups');
            }
        }
    }
}
