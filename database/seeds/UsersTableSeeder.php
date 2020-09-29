<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        $user = \App\Models\User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@app.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);
        $user->attachRole('super_admin');
        $admin_poula = \App\Models\User::create([
            'name' => 'Poula',
            'email' => 'poula.admin@journal.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);
        $admin_poula->attachRole('super_admin');
        $ids = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120];

        foreach ($ids as $id) {
            $userName = $faker->userName;
            $uniqueSuffix = 'task';
            $domain = 'journal.com';
            $userr = \App\Models\User::create([
                'id' => $id,
                'name' => $userName,
                'email' => "$userName.$uniqueSuffix@$domain",
                'password' => \Illuminate\Support\Facades\Hash::make('123456789')
            ]);
            $userr->attachRole('user');
        }//end of ForLoop
    }//end of run
}//end of class
