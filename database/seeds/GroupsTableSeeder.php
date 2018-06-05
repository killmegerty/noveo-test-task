<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupsNames = ['Users', 'Managers', 'Developers'];


        foreach ($groupsNames as $groupName) {
            Group::create([
                'name' => $groupName
            ]);
        }
    }
}
