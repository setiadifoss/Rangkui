<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MstItemTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'item_type_code' => 'BS',
                'item_type_name' => 'Bachelor\'s Thesis',
                'input_date' => '2020-05-10',
                'last_update' => '2020-05-10',
            ],
            [
                'item_type_code' => 'THS',
                'item_type_name' => 'Master\'s Thesis',
                'input_date' => '2020-05-10',
                'last_update' => '2020-05-10',
            ],
            [
                'item_type_code' => 'DSR',
                'item_type_name' => 'Dissertation',
                'input_date' => '2020-05-15',
                'last_update' => '2020-05-15',
            ],
            [
                'item_type_code' => 'OTH',
                'item_type_name' => 'Other',
                'input_date' => '2020-06-10',
                'last_update' => '2020-06-10',
            ],
        ];

        // Menggunakan insertBatch untuk memasukkan data sekaligus
        $this->db->table('mst_item_type')->insertBatch($data);
    }
}
