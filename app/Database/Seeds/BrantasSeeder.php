<?php



namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrantasSeeder extends Seeder
{

    public function run()
    {
        $this->call('MstMenuSeeder');
        $this->call('MstItemTypeSeeder');
        $this->call('MstIconSeeder');
    }
}
