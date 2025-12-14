<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Exception;

class InstallController extends BaseController
{
    use ResponseTrait;
    public function install()
    {
        // $this->session->set('dbConfig', null);
        return view('wizard/install_wizard');
    }

    function fresh()
    {
        if ($this->request->getMethod() == "GET") {
            $this->session->set('type', 'fresh');

            $data = [];
            // $data = $this->session?->dbConfig ?? [];

            return view('wizard/step_fresh', $data);
        } else if ($this->request->getMethod() == "POST") {

            $data = $this->request->getPost();
            $data['status'] = $this->_checkConnection($data);
            $this->session->set('dbConfig', $data);
            return $this->respond($data);
        }
    }

    function upgrade()
    {
        if ($this->request->getMethod() == "GET") {
            $this->session->set('type', 'upgrade');

            $data = [];
            // $data = $this->session?->dbConfig ?? [];

            return view('wizard/step_upgrade');
        } else if ($this->request->getMethod() == "POST") {

            $data = $this->request->getPost();
            $data['connection'] = $this->_checkConnection($data);
            $this->session->set('dbConfig', $data);
            return $this->respond($data);
        }
    }

    function _checkConnection($config)
    {
        extract($config);

        $connected = "failed";
        try {
            $db = \Config\Database::connect([
                'DSN'      => '',
                'hostname' => $host,
                'username' => $username,
                'password' => $password,
                'database' => 'mysql',
                'DBDriver' => 'MySQLi', // Sesuaikan driver database yang digunakan
                'DBPrefix' => '',
                'pConnect' => false,
                'DBDebug'  => (ENVIRONMENT !== 'production'),
                'charset'  => 'utf8',
                'DBCollat' => 'utf8_general_ci',
                'swapPre'  => '',
                'encrypt'  => false,
                'compress' => false,
                'strictOn' => false,
                'failover' => [],
                'port'     => (int)$port,
            ]);

            if ($db->simpleQuery('select * from user')) {
                $connected = "success";
            }
        } catch (\Throwable $th) {
            $connected = "failed";
        }


        $message = "Database Connection {$connected}";


        return $message;
    }

    function type()
    {
        return $this->respond([
            'type' => $this->session->type,
        ]);
    }

    function process()
    {
        $installType = $this->session->type;

        $cachePath = WRITEPATH . 'cache';

        if (!is_dir($cachePath)) {
            mkdir($cachePath, 0755, true);
        }

        switch ($installType) {
            case 'fresh':
                return $this->_installFresh();
                break;
            case 'upgrade':
                return $this->_installUpgrade();
                break;
        }
    }

    private function _installFresh()
    {
        $config = $this->session->dbConfig;


        extract($config);

        $configPath = APPPATH . "Config";

        // Cek apakah semua detail koneksi sudah ada di session
        if (empty($host) || empty($database) || empty($username) || empty($port)) {
            return "Database configuration error";
        }

        // Buat koneksi database manual menggunakan detail dari session
        $db = \Config\Database::connect([
            'DSN'      => '',
            'hostname' => $host,
            'username' => $username,
            'password' => $password,
            'database' => 'mysql',
            'DBDriver' => 'MySQLi', // Sesuaikan driver database yang digunakan
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => (int)$port,
        ]);

        $db->query("CREATE DATABASE IF NOT EXISTS {$database};");
        // Path file backup SQL
        $filePath = ROOTPATH . 'admin/brantas.sql'; //

        $settings = include(ROOTPATH . "admin/setting.php");
        // Baca isi file SQL
        $sqlContent = file_get_contents($filePath);

        if ($sqlContent === false) {
            return "File SQL tidak ditemukan atau tidak bisa dibaca.";
        }

        try {

            $db = \Config\Database::connect([
                'DSN'      => '',
                'hostname' => $host,
                'username' => $username,
                'password' => $password,
                'database' => $database,
                'DBDriver' => 'MySQLi', // Sesuaikan driver database yang digunakan
                'DBPrefix' => '',
                'pConnect' => false,
                'DBDebug'  => (ENVIRONMENT !== 'production'),
                'charset'  => 'utf8',
                'DBCollat' => 'utf8_general_ci',
                'swapPre'  => '',
                'encrypt'  => false,
                'compress' => false,
                'strictOn' => false,
                'failover' => [],
                'port'     => (int)$port,
            ]);

            $queries = explode(';', $sqlContent); // Memecah setiap query berdasarkan tanda ';'
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    $db->query($query);  // Jalankan query

                }
            }

            $s = $db->table('setting');
            $sql = "INSERT INTO setting (setting_id, setting_name, setting_value)";
            $sql .= " Values ";
            foreach ($settings['settings'] as $key => $setting) {
                $data = [
                    'setting_id' => $setting['id'],
                    'setting_name' => $setting['key'],
                    'setting_value' => $setting['value'],
                ];

                // Insert data ke dalam tabel
                $s->insert($data);
            }

            $u = $db->table('user');
            foreach ($settings['users'] as $key => $user) {
                $u->insert($user);
            }

            $this->_updateEnv();
            /**
             * Comment when testing
             */

            // $this->_deleteFolder(ROOTPATH . 'admin');

            // $oldFilePath = $configPath . '/Routes.local.php';
            // $newFilePath = $configPath . '/Routes.php';
            // rename($oldFilePath, $newFilePath);
        } catch (\Exception $e) {
            return "Error pada : " . $e->getMessage();  // Jika terjadi error, hentikan dan tampilkan pesan error
        }

        $status = "success";
        $message = "Installation Complete";
        /**
         * Comment when testing
         */

        // register_shutdown_function(function () {
        //     $filePath = APPPATH . 'Controllers/InstallController.php';

        //     if (file_exists($filePath)) {
        //         unlink($filePath);
        //     }
        // });

        $resp = [
            'status' => $status,
            'message' => $message
        ];

        return $this->respond($resp);
    }

    private function _installUpgrade()
    {

        $config = $this->session->dbConfig;
        extract($config);

        // Cek apakah semua detail koneksi sudah ada di session
        if (empty($host) || empty($database) || empty($username) || empty($port)) {
            return "Database configuration error";
        }

        $this->_updateEnv();

        // Path file backup SQL
        $filePath = ROOTPATH . 'admin/upgrade.sql'; //

        // Baca isi file SQL
        $sqlContent = file_get_contents($filePath);

        if ($sqlContent === false) {
            return "File SQL tidak ditemukan atau tidak bisa dibaca.";
        }


        try {
            $output = [];
            $statusCode = 0;

            $db = \Config\Database::connect([
                'DSN'      => '',
                'hostname' => $host,
                'username' => $username,
                'password' => $password,
                'database' => $database,
                'DBDriver' => 'MySQLi', // Sesuaikan driver database yang digunakan
                'DBPrefix' => '',
                'pConnect' => false,
                'DBDebug'  => (ENVIRONMENT !== 'production'),
                'charset'  => 'utf8',
                'DBCollat' => 'utf8_general_ci',
                'swapPre'  => '',
                'encrypt'  => false,
                'compress' => false,
                'strictOn' => false,
                'failover' => [],
                'port'     => (int)$port,
            ]);


            $queries = explode(';', $sqlContent); // Memecah setiap query berdasarkan tanda ';'
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    $db->query($query);  // Jalankan query

                }
            }

            $sql = "ALTER TABLE group_access DROP PRIMARY KEY;";
            $db->query($sql);

            $sql = "UPDATE
                        group_access ga
                    JOIN mst_module mm2 ON
                        mm2.module_id = ga.module_id
                    JOIN mst_menu mm ON
                        mm.title = mm2.module_name 
                    SET
                        ga.module_id = mm.id
                    WHERE LEVEL = 1 and mm.id NOT IN(
                        SELECT module_id
                        FROM group_access
                        where
                            group_id = 1
                    );";

            $sql = "insert into
                        group_access (group_id, module_id, r, w)
                    select 1, id, 1, 1
                    FROM mst_menu
                    where
                        id NOT IN(
                            SELECT module_id
                            FROM group_access
                            where
                                group_id = 1
                        );";
            $db->query($sql);

            $sql = "ALTER TABLE group_access ADD PRIMARY KEY (`group_id`, `module_id`);";
            $db->query($sql);

            /**
             * Comment when testing
             */

            // register_shutdown_function(function () {
            //     $filePath = APPPATH . 'Controllers/InstallController.php';

            //     if (file_exists($filePath)) {
            //         unlink($filePath);
            //     }
            // });

            // $this->_deleteFolder(ROOTPATH . 'admin');

            $configPath = APPPATH . "Config";
            $oldFilePath = $configPath . '/Routes.local.php';
            $newFilePath = $configPath . '/Routes.php';
            rename($oldFilePath, $newFilePath);
        } catch (Exception $e) {
            return $this->respond([
                'status' => 'error',
                'Message' => $e->getMessage()
            ]);
        }

        return $this->respond([
            'status' => 'success',
            'Message' => 'Upgrade Berhasil',
        ]);
    }

    function _deleteFolder($folderPath)
    {
        if (is_dir($folderPath)) {
            // Hapus semua file dan subfolder di dalam folder
            $files = array_diff(scandir($folderPath), ['.', '..']);
            foreach ($files as $file) {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
                if (is_dir($filePath)) {
                    // Panggil recursive function jika ini subfolder
                    $this->_deleteFolder($filePath);
                } else {
                    // Hapus file
                    unlink($filePath);
                }
            }
            // Hapus folder
            return rmdir($folderPath);
        }
        return false;
    }

    function _updateEnv()
    {
        $config = $this->session->dbConfig;
        extract($config);

        if (empty($host) || empty($database) || empty($username) || empty($port)) {
            return "Database configuration error";
        }

        // Path ke file .env dan .env.example
        $envFilePath = ROOTPATH . '.env';
        $envLocalFilePath = ROOTPATH . '.env.example';

        // Merename file .env.example menjadi .env
        if (file_exists($envLocalFilePath)) {

            $envContent = file_get_contents($envLocalFilePath);

            // Mengganti nilai dalam file .env
            $patternHostname  = "/^database\.default\.hostname\s*=\s*([^\r\n]*)/m";
            $patternDatabase  = "/^database\.default\.database\s*=\s*([^\r\n]*)/m";
            $patternUsername  = "/^database\.default\.username\s*=\s*([^\r\n]*)/m";
            $patternPassword  = "/^database\.default\.password\s*=\s*([^\r\n]*)/m";
            $patternPort      = "/^database\.default\.port\s*=\s*([^\r\n]*)/m";

            // Jika hostname ada dalam file, lakukan penggantian
            if (preg_match($patternHostname, $envContent)) {
                // Update nilai hostname yang ada
                $envContent = preg_replace($patternHostname, 'database.default.hostname=' . $host, $envContent);
            }

            // Jika database ada dalam file, lakukan penggantian
            if (preg_match($patternDatabase, $envContent)) {
                // Update nilai database yang ada
                $envContent = preg_replace($patternDatabase, 'database.default.database=' . $database, $envContent);
            }

            if (preg_match($patternUsername, $envContent)) {
                $envContent = preg_replace($patternUsername, 'database.default.username=' . $username, $envContent);
            } else {
                // Jika username tidak ditemukan, tambahkan setelah database.default.database
                if (preg_match($patternDatabase, $envContent, $matches)) {
                    // Temukan posisi database.default.database
                    $pos = strpos($envContent, $matches[0]);
                    // Tambahkan username setelahnya
                    $insertPos = $pos + strlen($matches[0]);
                    $envContent = substr_replace($envContent, "\ndatabase.default.username=" . $username, $insertPos, 0);
                }
            }

            // Jika password ada dalam file, lakukan penggantian
            if (preg_match($patternPassword, $envContent)) {
                // Update nilai password yang ada
                $envContent = preg_replace($patternPassword, 'database.default.password=' . $password, $envContent);
            }

            // Jika port ada dalam file, lakukan penggantian
            if (preg_match($patternPort, $envContent)) {
                // Update nilai port yang ada
                $envContent = preg_replace($patternPort, 'database.default.port=' . $port, $envContent);
            }
            // Menyimpan kembali isi yang sudah diperbarui ke file .env
            file_put_contents($envLocalFilePath, $envContent);

            rename($envLocalFilePath, $envFilePath);
        }
    }
}
