<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToSearchBiblioTable extends Migration
{
    public function up()
    {

        $fields = [
            'examiner' => [
                'type'      => 'TEXT',
                'collation' => 'utf8_unicode_ci',
                'null'      => true,
            ],
            'supervisor' => [
                'type'      => 'TEXT',
                'collation' => 'utf8_unicode_ci',
                'null'      => true,
            ],
            'contributor' => [
                'type'      => 'TEXT',
                'collation' => 'utf8_unicode_ci',
                'null'      => true,
            ],
            
        ];

        $columns = [];
        // Memeriksa setiap kolom
        foreach ($fields as $column => $attr) {
            $query = $this->db->query("SHOW COLUMNS FROM search_biblio LIKE '$column'");

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
            $this->forge->addColumn('search_biblio', $fields);
        }
    }

    public function down()
    {
        // Hapus kolom yang ditambahkan jika migrasi di-rollback
        $this->forge->dropColumn('search_biblio', ['examiner', 'supervisor', 'contributor']);
    }
}
