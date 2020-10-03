<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
//        $this->call(LaratrustSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(HotelsSeeder::class);
//        $this->call(DestinationsSeeder::class);
//        $this->call(CategoriesSeeder::class);
//        $this->call(PlansSeeder::class);
//        $this->call(ExcursionsSeeder::class);
        $this->call(PackagesSeeder::class);
    }//end of run
}//end of class
