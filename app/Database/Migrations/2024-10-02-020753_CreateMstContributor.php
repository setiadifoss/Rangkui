<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstContributor extends Migration
{
    public function up()
    {
        // Membuat tabel mst_contributor
        $this->forge->addField([
            'contributor_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'contributor_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'contributor_type' => [
                'type'       => 'ENUM',
                'constraint' => ['p', 'o', 'c'],
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
        $this->forge->addKey('contributor_id', true);

        // Membuat tabel
        $this->forge->createTable('mst_contributor', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_contributor');
    }
}
