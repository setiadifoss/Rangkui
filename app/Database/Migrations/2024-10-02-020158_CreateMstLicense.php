<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstLicense extends Migration
{
    public function up()
    {
        // Membuat tabel mst_license
        $this->forge->addField([
            'license_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'license_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'input_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'last_update' => [
                'type' => 'DATE',
                'null' => false,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey('license_id', true);

        // Membuat tabel
        $this->forge->createTable('mst_license', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_license');
    }
}
