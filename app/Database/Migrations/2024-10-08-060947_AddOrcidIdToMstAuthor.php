<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrcidIdToMstAuthor extends Migration
{
    public function up()
    {
        // Cek jika kolom 'orcid_id' belum ada di tabel 'mst_author'
        if (!$this->db->fieldExists('orcid_id', 'mst_author')) {
            // Tambahkan kolom 'orcid_id' ke tabel 'mst_author'
            $this->forge->addColumn('mst_author', [
                'orcid_id' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => true,
                    'after'      => 'auth_list'
                ],
            ]);
        }
    }

    public function down()
    {
        // Hapus kolom 'orcid_id' jika ada
        if ($this->db->fieldExists('orcid_id', 'mst_author')) {
            $this->forge->dropColumn('mst_author', 'orcid_id');
        }
    }
}
