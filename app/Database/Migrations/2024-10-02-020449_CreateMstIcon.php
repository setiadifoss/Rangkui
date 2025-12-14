<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstIcon extends Migration
{
    public function up()
    {
        // Membuat tabel mst_icon
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'class_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'icon_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey('id', true);

        // Membuat tabel
        $this->forge->dropTable('mst_icon', true);
        $this->forge->createTable('mst_icon', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_icon');
    }
}
