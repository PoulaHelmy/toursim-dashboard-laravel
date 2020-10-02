<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(HotelsSeeder::class);
//        $this->call(DestinationsSeeder::class);
//        $this->call(CategoriesSeeder::class);
//        $this->call(ExcursionsSeeder::class);
    }//end of run
}//end of class
