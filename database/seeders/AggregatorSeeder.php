<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AggregatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aggregators')->insert([
            'name' => 'income'
        ]);
        DB::table('aggregators')->insert([
            'name' => 'fixed'
        ]);
        DB::table('aggregators')->insert([
            'name' => 'food'
        ]);
    }
}
