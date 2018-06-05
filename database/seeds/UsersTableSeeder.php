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
        $usersNames = [
            'Arden Vanloan',
            'Chance Odem',
            'Janise Hoefer',
            'Laura Spargo',
            'Flavia Mahi',
            'Marcellus Mcfee',
            'Lashon Cruz',
            'Aja Christner',
            'Jamar Cardenas',
            'Milly Belvin',
            'Jone Leonard',
            'Travis Torgerson',
            'Esther Baer',
            'Belinda Hulet',
            'Harriett Davenport',
            'Alise Mickley',
            'Tisha Santibanez',
            'In Yin',
            'Tonie Compos',
            'Lacy Rehder'
        ];

        foreach ($usersNames as $userName) {
            $explodedUserName = explode(' ', $userName);
            User::create([
                'email' => str_random(10).'@gmail.com',
                'first_name' => $explodedUserName[0],
                'last_name' => $explodedUserName[1],
                'group_id' => rand(1, 3),
                'state' => $states[array_rand($states)]
            ]);
        }
    }
}
