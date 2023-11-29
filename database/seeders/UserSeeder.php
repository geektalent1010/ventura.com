<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::factory()->create(
            [
                'username' => 'admin',
                'email' => 'admin@test.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'remember_token' => $faker->unique()->word,
                'is_admin' => 1,
            ]
        );

        Profile::factory()->create(
            [
                'user_id' => 1,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'birthday' => $faker->date,
                'city' => 21039,
                'state' => 1641,
                'country' => 99,
            ]
        );

    }
}
