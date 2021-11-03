<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecurringTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recurring_types')->insert([
            'name' => 'daily'
        ]);
        DB::table('recurring_types')->insert([
            'name' => 'weekly'
        ]);
        DB::table('recurring_types')->insert([
            'name' => 'monthly'
        ]);
        DB::table('recurring_types')->insert([
            'name' => 'yearly'
        ]);
    }
}
