<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiblioCount extends Migration
{
    public function up()
    {
        // Membuat tabel biblio_count
        $this->forge->addField([
            'biblio_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'file_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'timestamp',
                'constraint' => '',
                'default'    => 'CURRENT_TIMESTAMP',
                'null'       => false,
            ],
        ]);

        // Membuat tabel
        $this->forge->createTable('biblio_count', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('biblio_count');
    }
}
