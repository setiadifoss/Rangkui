<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiblioSupervisor extends Migration
{
    public function up()
    {
        // Membuat tabel biblio_supervisor
        $this->forge->addField([
            'biblio_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'supervisor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'level' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
                'null'       => false,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey(['biblio_id', 'supervisor_id'], true);

        // Membuat tabel
        $this->forge->createTable('biblio_supervisor', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('biblio_supervisor');
    }
}
