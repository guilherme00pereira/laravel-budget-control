<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cost_centers')->insert([
            'name' => 'Guilherme'
        ]);
        DB::table('cost_centers')->insert([
            'name' => 'Luciana'
        ]);
    }
}
