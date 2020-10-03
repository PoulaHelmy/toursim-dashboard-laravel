<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    public function run()
    {
        Plan::create([
            'ar' => [
                'name' => 'الذهبية',
            ],
            'en' => [
                'name' => 'Golden'
            ]
        ]);
        Plan::create([
            'ar' => [
                'name' => 'الفضية'
            ],
            'en' => [
                'name' => 'Platinum',

            ]
        ]);
        Plan::create([
            'ar' => [
                'name' => 'البروزنية'
            ],
            'en' => [
                'name' => 'Bronze',
            ]
        ]);
        Plan::create([
            'ar' => [
                'name' => 'الاعتيادية',
            ],
            'en' => [
                'name' => 'Regular'
            ]
        ]);

    }//END OF RUN
}//END OF CLASS
