<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstCopyright extends Migration
{
    public function up()
    {
        // Membuat tabel mst_copyright
        $this->forge->addField([
            'copyright_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'copyright_name' => [
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
        $this->forge->addKey('copyright_id', true);

        // Membuat tabel
        $this->forge->createTable('mst_copyright', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_copyright');
    }
}
