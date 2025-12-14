<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstCodeMinistry extends Migration
{
    public function up()
    {
        // Membuat tabel mst_code_ministry
        $this->forge->addField([
            'code_ministry' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'name_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'degree' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'university' => [
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
        $this->forge->addKey('code_ministry', true);

        // Membuat tabel
        $this->forge->createTable('mst_code_ministry', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_code_ministry');
    }
}
