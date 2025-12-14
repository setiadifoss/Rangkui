<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiblioContributor extends Migration
{
    public function up()
    {
        // Membuat tabel biblio_contributor
        $this->forge->addField([
            'biblio_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'contributor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'level' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey(['biblio_id', 'contributor_id'], true);

        // Membuat tabel
        $this->forge->createTable('biblio_contributor', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('biblio_contributor');
    }
}
