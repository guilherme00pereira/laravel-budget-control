<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_types')->insert([
           'name' => 'Variable'
        ]);
        DB::table('category_types')->insert([
            'name' => 'Fixed'
        ]);
        DB::table('category_types')->insert([
            'name' => 'Income'
        ]);
    }
}
