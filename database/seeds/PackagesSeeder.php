<?php

use App\Models\Categoriable;
use App\Models\Day;
use App\Models\Gallary;
use App\Models\Including;
use App\Models\Package;
use App\Models\PackageHotel;
use App\Models\Photo;
use App\Models\Pricelist;
use App\Models\Season;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    use \App\Http\Controllers\Dashboard\Traits\CategoriesTrait;

    public function run()
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
        foreach ($ids as $id) {
            $package = Package::create([
                'start' => $faker->randomDigitNotNull,
                'duration' => $faker->randomDigitNotNull,
                'discount' => $faker->randomDigitNotNull,
                'places' => $faker->randomDigitNotNull,
                'status' => rand(0, 1),
                'featured' => rand(0, 1),
                'destination_id' => rand(1, 20),
                'en' => [
                    'name' => $faker->name,
                    'slug' => $faker->name,
                    'run' => $faker->word,
                    'type' => $faker->word,
                    'short_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    "overview" => $faker->text($maxNbChars = 200),
                ],
                'ar' => [
                    'name' => $faker->name,
                    'slug' => $faker->name,
                    'run' => $faker->word,
                    'type' => $faker->word,
                    'short_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    "overview" => $faker->text($maxNbChars = 200),
                ],
            ]);
            Seo::create([
                'seoable_id' => $package->id,
                'seoable_type' => 'App\Models\Package',
                'en' => [
                    'page_title' => $faker->word,
                    'meta_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'og_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'og_title' => $faker->text($maxNbChars = 20),
                    'meta_keywords' => 'Velit laboriosam of,dfssdf,sdffdsf,dsfsdfsd,fsdfsd',
                    'og_image' => 'faker_og_image_en.jpeg'
                ],
                'ar' => [
                    'page_title' => $faker->word,
                    'meta_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'og_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'og_title' => $faker->text($maxNbChars = 20),
                    'meta_keywords' => 'Velit laboriosam of,dfssdf,sdffdsf,dsfsdfsd,fsdfsd',
                    'og_image' => 'faker_og_image_ar.jpeg'
                ],
            ]);
            Photo::create([
                'banner_alt' => $faker->word,
                'banner_url' => 'faker_banner.webp',
                'thumb_url' => 'faker_thumb.jpeg',
                'thumb_alt' => $faker->word,
                'photoable_id' => $package->id,
                'photoable_type' => 'App\Models\Package',
            ]);
            Including::create([
                'ar' => [
                    'name' => 'Dolorum id id illum,sasa,sasaa,ssasa,dsadasd',
                ],
                'en' => [
                    'name' => 'Dolorum id id illum,sasa,sasaa,ssasa,dsadasd'
                ]
                ,
                'type' => '1',
                'includable_id' => $package->id,
                'includable_type' => 'App\Models\Package',
            ]);
            Including::create([
                'ar' => [
                    'name' => 'Sed sequi ut ratione,asdads,adsasd,dasdasd,sdadfadsf'
                ],
                'en' => [
                    'name' => 'Sed sequi ut ratione,asdads,adsasd,dasdasd,sdadfadsf'
                ], 'type' => '0',
                'includable_id' => $package->id,
                'includable_type' => 'App\Models\Package',
            ]);
            for ($i = 1; $i < 8; $i++) {
                Gallary::create([
                    'url' => 'faker_slider_image.jpeg',
                    'alt' => 'FAKER NEW SLIDER IMAGES',
                    'gallarable_id' => $package->id,
                    'gallarable_type' => 'App\Models\Package'
                ]);
                Categoriable::create([
                    'category_id' => rand(1, 20),
                    'categoriable_id' => $package->id,
                    'categoriable_type' => 'App\Models\Package'
                ]);
            }

            $categories = [1, 2, 3, 4, 5, 6, 7, 8];
            $this->store_categoriable($categories, $package->id, 'App\Models\Package');
            $seasons = [
                1 => [
                    'start' => '2020-03-04',
                    'end' => '2020-03-04',
                    'price_list' => [
                        '0' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 2,
                        ], '1' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 3,
                        ], '2' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 4,
                        ], '3' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 1,
                        ],
                    ]
                ],
                2 => [
                    'start' => '2020-03-04',
                    'end' => '2020-03-04',
                    'price_list' => [
                        '0' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 2,
                        ], '1' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 3,
                        ], '2' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 4,
                        ], '3' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 1,
                        ],
                    ]
                ],
                3 => [
                    'start' => '2020-03-04',
                    'end' => '2020-03-04',
                    'price_list' => [
                        '0' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 2,
                        ], '1' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 3,
                        ], '2' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 4,
                        ], '3' => [
                            'price' => $faker->randomDigitNotNull,
                            'plan_id' => 1,
                        ],
                    ]
                ],
            ];
            $days = [
                1 => [
                    'en' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ],
                    'ar' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ]
                ],
                2 => [
                    'en' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ],
                    'ar' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ]
                ],
                3 => [
                    'en' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ],
                    'ar' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ]
                ],
                4 => [
                    'en' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ],
                    'ar' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ]
                ],
                5 => [
                    'en' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ],
                    'ar' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ]
                ],
                6 => [
                    'en' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ],
                    'ar' => [
                        'title' => $faker->word,
                        'summery' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ]
                ],
            ];
            $hotels = [
                0 => [
                    'hotels' => [1, 2, 3, 4, 5, 6],
                    'plan_id' => '1'
                ],
                2 => [
                    'hotels' => [1, 2, 3, 4, 5, 6],
                    'plan_id' => '2'
                ],
                3 => [
                    'hotels' => [1, 2, 3, 4, 5, 6],
                    'plan_id' => '3'
                ],
                4 => [
                    'hotels' => [1, 2, 3, 4, 5, 6],
                    'plan_id' => '4'
                ],
            ];
            /*--------------------Seasons CREATING-----------------*/


            foreach ($seasons as $season) {
                $seasonData = Season::create([
                    'start' => $season['start'],
                    'end' => $season['end'],
                    'package_id' => $package->id
                ]);
                foreach ($season['price_list'] as $priceList) {
                    Pricelist::create([
                        'price' => $priceList['price'],
                        'plan_id' => $priceList['plan_id'],
                        'season_id' => $seasonData->id
                    ]);
                }

            }

            /*-------------------- END Seasons CREATING -------------*/

            /*--------------------DAYS CREATING-----------------*/
            foreach ($days as $day) {
                Day::create([
                    'package_id' => $package->id,
                    'ar' => [
                        'title' => $day['ar']['title'],
                        'summery' => $day['ar']['summery']
                    ],
                    'en' => [
                        'title' => $day['en']['title'],
                        'summery' => $day['en']['summery']
                    ]
                ]);
            }
            /*-------------------- END DAYS CREATING -------------*/

            /*--------------------HOTELS CREATING-----------------*/
            foreach ($hotels as $hotel) {
                foreach ($hotel['hotels'] as $hotelID) {
                    PackageHotel::create([
                        'package_id' => $package->id,
                        'plan_id' => $hotel['plan_id'],
                        'hotel_id' => $hotelID
                    ]);
                }
            }
            /*-------------------- END HOTELS CREATING -------------*/
        }

    }//END OF RUN
}//END OF CLASS
