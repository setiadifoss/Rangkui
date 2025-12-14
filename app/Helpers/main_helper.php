<?php
if (!function_exists('formatString')) {
    function formatString($input, $is_uppercase = null)
    {
        if (!is_null($is_uppercase)) {
            $output = strtoupper($input);
        } else {
            $input = str_replace('_', ' ', $input);
            $output = ucwords($input);
        }
        return $output;
    }
}

function slim_alert($status = 'success', $message = 'Berhasil!', $text = null)
{
    $session = session();
    $alert   = ['status' => $status, 'msg' => $message, 'text' => $text];
    $session->setFlashdata('alert', $alert);
    return true;
}

/**
 * @param $date
 * @param $format
 * @return mixed
 */
function TanggalIndo($date, $format = '')
{
    $BulanIndo = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $split = explode('-', $date);
    if ($format == 'd M Y') {
        return $split[0] . ' ' . $BulanIndo[(int) $split[1]] . ' ' . $split[2];
    } else {
        return $split[2] . ' ' . $BulanIndo[(int) $split[1]] . ' ' . $split[0];
    }
}

/**
 * @param $date
 * @return mixed
 */
function datetimeIdn($date)
{
    $BulanIndo = ["", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
    $split     = explode(' ', $date);
    $spli      = explode('-', $split[0]);

    return $spli[2] . ' ' . $BulanIndo[(int) $spli[1]] . ' ' . $spli[0];
}

function generateRandomID()
{
    $characters = '0123456789'; // Hanya karakter angka
    $randomID = '';

    // Buat 16 karakter acak (20 - 3 untuk 3 tanda "-")
    for ($i = 0; $i < 16; $i++) {
        $randomID .= $characters[rand(0, strlen($characters) - 1)];

        // Tambahkan pemisah "-" setiap 4 karakter
        if (($i + 1) % 4 === 0 && $i < 15) {
            $randomID .= '-';
        }
    }

    return $randomID;
}

if (!function_exists('cekerror')) {
    function cekerror($db)
    {
        // $error = $db->getError();
        // log_message('error', $db); // Log error ke file log
        $test = $db->errors();
        return reset($test); // Mengembalikan pesan error pertama
    }
}

if (!function_exists('delImage')) {
    function delImage($targetPath, $imageName)
    {
        $file_path =  FCPATH . 'uploads\\' . $targetPath . '\\' . $imageName;
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return "-1.";
        }
    }
}

if (!function_exists('getAuthorityName')) {
    function getAuthorityName($authority_type)
    {
        switch ($authority_type) {
            case 'o':
                $result = 'Organizational Body';
                break;
            case 'c':
                $result = 'Conference';
                break;
            default:
                $result = 'Personal Name';
        }
        return $result;
    }
}

if (!function_exists('getDatas')) {
    /**
     * Fungsi untuk mengambil data dari tabel dengan kustomisasi format output.
     *
     * @param string $table Nama tabel.
     * @param string $col Kolom yang diambil.
     * @param string|null $whr Kondisi where (opsional).
     * @param string $val Nilai dari where (opsional).
     * @param string|null $operator Operator untuk where (misalnya: 'IN', '='). Default: null.
     * @param string|null $ord Kolom untuk pengurutan (opsional).
     * @param string $sort Urutan pengurutan (ASC/DESC). Default: 'ASC'.
     * @param string|null $pd Debug (print query). Default: null.
     * @param string|null $lq Debug (log query). Default: null.
     * @param string $output Jenis output yang diinginkan: 'array' atau 'row'. Default: 'array'.
     *
     * @return array|object|null Hasil query dalam bentuk array, object, atau null jika tidak ada data.
     */
    function getDatas($table, $col, $whr = null, $val = "", $operator = null, $ord = null, $sort = ' ASC ', $pd = null, $lq = null, $output = 'array')
    {

        $where = !is_null($whr) ? " WHERE {$whr} " : '';
        $db    = \Config\Database::connect();
        $sql   = "SELECT {$col} FROM {$table} {$where}";

        if (!is_null($operator)) {
            $tblwhr = $sql . ' ' . $operator . ' ' . $val . ' ' . (!is_null($ord) ? $ord . $sort : ' ');
        } else {
            $tblwhr = $sql . $val . (!is_null($ord) ? $ord . $sort : ' ');
        }

        if (!is_null($pd)) {
            pd($tblwhr, 1);
        }

        $query = $db->query($tblwhr);

        if ($query === false || $query->getNumRows() === 0) {
            return null;
        }

        if ($output === 'row') {
            $hasil = $query->getRow()->$col;
        } else {
            $hasil = $query->getResult();
        }
        if (!is_null($lq)) {
            lq();
        }
        return $hasil;
    }
}
