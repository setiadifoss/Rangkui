<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstSupervisor extends Migration
{
    public function up()
    {
        // Membuat tabel mst_supervisor
        $this->forge->addField([
            'supervisor_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'supervisor_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'supervisor_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'supervisor_year' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'supervisor_type' => [
                'type'       => 'ENUM',
                'constraint' => ['p', 'o', 'c'],
                'null'       => true,
            ],
            'supervisor_list' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
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
        $this->forge->addKey('supervisor_id', true);

        // Membuat tabel
        $this->forge->createTable('mst_supervisor', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_supervisor');
    }
}
