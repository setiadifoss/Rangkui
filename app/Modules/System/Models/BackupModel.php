<?php


namespace App\Modules\System\Models;

use CodeIgniter\Model;

class BackupModel extends Model
{
    protected $table              = 'backup_log';
    protected $primaryKey         = 'backup_log_id';
    protected $returnType         = 'object';
    protected $protectFields      = false;
    protected $useTimestamps      = false;

    function getBackup()
    {
        $list = $this->select('backup_log_id, backup_time, backup_file, realname')
            ->join('user as u', 'u.user_id = backup_log.user_id', 'LEFT')
            ->get()
            ->getResult();

        return $list;
    }
}
