<?php

use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    public function run()
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
        foreach ($ids as $id) {
            \App\Models\Hotel::create([
                'name' => $faker->name,
                'website_link' => $faker->url,
                'stars' => rand(1, 5)
            ]);
        }

    }//END OF RUN
}//END OF CLASS
