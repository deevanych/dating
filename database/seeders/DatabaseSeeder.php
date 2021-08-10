<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInterest;
use App\Models\UserPhoto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const USERS_COUNT = 50;
    const USERS_PHOTOS_COUNT = 100;
    const USER_INTERESTS_COUNT = 500;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserInterestTypeSeeder::class);
        UserInterest::factory()->count(self::USER_INTERESTS_COUNT)->create();
        User::factory()->count(self::USERS_COUNT)->create();
        UserPhoto::factory()->count(self::USERS_PHOTOS_COUNT)->create();
        $this->call(UserUserInterestSeeder::class);
    }
}
