<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstExaminer extends Migration
{
    public function up()
    {
        // Membuat tabel mst_examiner
        $this->forge->addField([
            'examiner_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'examiner_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'examiner_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'examiner_type' => [
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
        $this->forge->addKey('examiner_id', true);

        // Membuat tabel
        $this->forge->createTable('mst_examiner', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_examiner');
    }
}
