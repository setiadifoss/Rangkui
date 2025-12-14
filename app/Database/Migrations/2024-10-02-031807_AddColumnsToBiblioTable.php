<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToBiblioTable extends Migration
{
    public function up()
    {

        $fields = [
            'unique_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'license_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'code_ministry' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true,
            ],
            'item_type_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'student_id' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true,
            ],
            'cp_email' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
            ],
            'departement' => [
                'type' => 'varchar',
                'constraint' => 250,
                'null' => true,
            ],
            'copyright_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'url_crossref' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'null' => true,
            ],
        ];

        $columns = [];
        // Memeriksa setiap kolom
        foreach ($fields as $column => $attr) {
            $query = $this->db->query("SHOW COLUMNS FROM biblio LIKE '$column'");

            if ($query->getNumRows() > 0) {
                $columns[] = $column; // Tambahkan ke array jika kolom ada
            }
        }

        // Menghapus kolom yang sudah ada dari array $fields agar tidak ditambahkan ulang
        foreach ($columns as $existingColumn) {
            unset($fields[$existingColumn]);
        }

        // Menambahkan kolom yang belum ada
        if (!empty($fields)) {
            $this->forge->addColumn('biblio', $fields);
        }
    }

    public function down()
    {
        // Hapus kolom yang ditambahkan jika migrasi di-rollback
        $this->forge->dropColumn('biblio', ['unique_id', 'license_id', 'url_crossref']);
    }
}
