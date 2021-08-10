<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserUserInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 300; $i++) {
            DB::table('user_user_interest')->insert([
                'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
                'user_interest_id' => UserInterest::select('id')->orderByRaw("RAND()")->first()->id,
            ]);
        }
    }
}
