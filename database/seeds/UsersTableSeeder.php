<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [User::STATE_ACTIVE, User::STATE_NON_ACTIVE];
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 15; $i++) {
            User::create([
                'email' => $faker->email,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'group_id' => rand(1, 3),
                'state' => $states[array_rand($states)]
            ]);
        }
    }
}
