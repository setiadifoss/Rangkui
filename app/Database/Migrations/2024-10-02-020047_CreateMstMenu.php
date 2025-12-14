<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstMenu extends Migration
{
    public function up()
    {
        // Membuat tabel mst_menu
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'unsigned'   => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['menu', 'submenu', 'title'],
                'null'       => false,
            ],
            'level' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'desc' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey('id', true);

        // Menambahkan index untuk parent_id
        $this->forge->addKey('parent_id');

        // Membuat tabel
        $this->forge->createTable('mst_menu', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_menu');
    }
}
