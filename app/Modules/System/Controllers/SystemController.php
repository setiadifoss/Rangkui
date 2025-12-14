<?php

namespace App\Modules\System\Controllers;

use Config\Services;
use CodeIgniter\HTTP\Request;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Modules\System\Models\SystemModel;

class SystemController extends BaseController
{
    use ResponseTrait;

    public $viewpath = "Sistem/";

    public function __construct()
    {
        helper('array');
    }

    public function pengaturan()
    {
        $view  = $this->viewpath . "v_pengaturan_system";
        $title = "System Configuration";

        $setting = new SystemModel();
        $list    = (object) $setting->findAll();

        $list_var = [];
        foreach ($list as $key => $val) {
            $list_var[$val['setting_name']] = $val['setting_value'];
        }

        $lang      = $this->db->table('mst_language');
        $list_lang = $lang->get()->getResult();

        $publicKey  = $_ENV['recaptcha.publicKey'];
        $privateKey = $_ENV['recaptcha.privateKey'];

        $content = [
            'list_var'   => $list_var,
            'list_lang'  => $list_lang,
            'publicKey'  => $publicKey,
            'privateKey' => $privateKey,
        ];


        $js = [
            'assets/custom/js/modules/system/pengaturan-sistem',
        ];

        _render($view, $title, $content, $js);
    }

    function updateKey()
    {
        extract($this->input->getPost());

        // Path ke file .env di root proyek
        $envPath = ROOTPATH . '.env';

        // Pastikan file .env ada
        if (!file_exists($envPath)) {
            return 'File .env not found!';
        }

        // Membaca file .env
        $envContent = file_get_contents($envPath);

        // Pola regex untuk recaptcha.publicKey dan recaptcha.privateKey
        $patternPublicKey  = "/^recaptcha\.publicKey\s*=\s*([^\r\n]*)/m";
        $patternPrivateKey = "/^recaptcha\.privateKey\s*=\s*([^\r\n]*)/m";

        // Jika key ada dalam file, lakukan penggantian
        if (preg_match($patternPublicKey, $envContent)) {
            // Update nilai publicKey yang ada
            $envContent = preg_replace($patternPublicKey, 'recaptcha.publicKey=' . $publickey, $envContent);
        } else {
            // Tambahkan publicKey baru di akhir file jika tidak ada
            $envContent .= "\nrecaptcha.publicKey=" . $publickey;
        }

        if (preg_match($patternPrivateKey, $envContent)) {
            // Update nilai privateKey yang ada
            $envContent = preg_replace($patternPrivateKey, 'recaptcha.privateKey=' . $privatekey, $envContent);
        } else {
            // Tambahkan privateKey baru di akhir file jika tidak ada
            $envContent .= "\nrecaptcha.privateKey=" . $privatekey;
        }

        // Menulis kembali ke file .env
        $result = file_put_contents($envPath, $envContent);

        $log_message = "Update key failed";
        if ($result !== false) {
            $log_message = "Update key success";
            $resp = [
                'status'  => 200,
                'message' => "succes",
            ];
        } else {
            $resp = [
                'status'  => 500,
                'message' => "error",
            ];
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'System Config', $log_message);

        return $this->respond($resp);
    }

    function update()
    {
        $post = $this->input->getPost();

        $this->db->transBegin();
        $setting = new SystemModel();
        foreach ($post as $key => $val) {

            $setting->where('setting_name', $key);
            $setting->set('setting_value', serialize($val));
            $setting->update();
        }

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $log_message = "Save setting failed";
            slim_alert('error', $log_message);
        } else {
            $this->db->transCommit();
            $log_message = "Save setting success";
            slim_alert('success', $log_message);
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'System Config', $log_message);

        return redirect()->to('sistem/pengaturan-sistem');
    }
}
