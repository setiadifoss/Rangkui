<?php

namespace Config;

use App\Modules\System\Models\LogModel;
use MongoDB\Client;
use CodeIgniter\Config\BaseService;
use Exception;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */

class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function mongo($shared = true)
    {
        if ($shared) {
            return static::getSharedInstance('mongo');
        }

        // Koneksi ke MongoDB, sesuaikan konfigurasi
        try {
            // Mengambil konfigurasi dari environment
            $hostName = $_ENV['MONGO_HOST'] ?? "mongodb://localhost:27017";
            $dbName = $_ENV['MONGO_DB'] ?? "slims";

            // Membuat koneksi client MongoDB
            $client = new Client($hostName);
            // Pilih database sesuai konfigurasi
            return $client->selectDatabase($dbName);
        } catch (Exception $e) { // Tangkap error dari MongoDB
            // Jika terjadi error, tampilkan pesan log
            log_message('error', 'Failed to connect to MongoDB: ' . $e->getMessage());

            // Redirect ke halaman lain jika diperlukan
            return false;
        }
    }

    public static function writeLog($logType, $logUser, $logLocation, $logMessage)
    {

        $log = new LogModel();

        $data = [
            'log_type'     => $logType,
            'id'           => $logUser,
            'log_location' => $logLocation,
            'log_msg'      => $logMessage,
            'log_date'     => date("Y-m-d H:i:s")
        ];

        $log->insert($data);
    }
}
