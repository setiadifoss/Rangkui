<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMstItemType extends Migration
{
    public function up()
    {
        // Membuat tabel mst_item_type
        $this->forge->addField([
            'item_type_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'item_type_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
                'null'       => true,
            ],
            'item_type_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'input_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'last_update' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey('item_type_id', true);

        // Membuat tabel
        $this->forge->createTable('mst_item_type', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('mst_item_type');
    }
}
