<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInterestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_interest_types')->insert([
            'title' => 'unknown',
        ]);
        DB::table('user_interest_types')->insert([
            'title' => 'music',
        ]);
        DB::table('user_interest_types')->insert([
            'title' => 'art',
        ]);
        DB::table('user_interest_types')->insert([
            'title' => 'film',
        ]);
        DB::table('user_interest_types')->insert([
            'title' => 'money',
        ]);
    }
}
