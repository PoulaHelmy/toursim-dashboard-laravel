<?php

use App\Models\Categoriable;
use App\Models\Gallary;
use App\Models\Including;
use App\Models\Photo;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class ExcursionsSeeder extends Seeder
{
    public function run()
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
        foreach ($ids as $id) {
            $excursion = \App\Models\Excursion::create([
                'start' => $faker->randomDigitNotNull,
                'duration' => $faker->randomDigitNotNull,
                'discount' => $faker->randomDigitNotNull,
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
                'seoable_id' => $excursion->id,
                'seoable_type' => 'App\Models\Excursion',
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
                'photoable_id' => $excursion->id,
                'photoable_type' => 'App\Models\Excursion',
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
                'includable_id' => $excursion->id,
                'includable_type' => 'App\Models\Excursion',
            ]);
            Including::create([
                'ar' => [
                    'name' => 'Sed sequi ut ratione,asdads,adsasd,dasdasd,sdadfadsf'
                ],
                'en' => [
                    'name' => 'Sed sequi ut ratione,asdads,adsasd,dasdasd,sdadfadsf'
                ], 'type' => '0',
                'includable_id' => $excursion->id,
                'includable_type' => 'App\Models\Excursion',
            ]);
            for ($i = 1; $i < 8; $i++) {
                Gallary::create([
                    'url' => 'faker_slider_image.jpeg',
                    'alt' => 'FAKER NEW SLIDER IMAGES',
                    'gallarable_id' => $excursion->id,
                    'gallarable_type' => 'App\Models\Excursion'
                ]);
                Categoriable::create([
                    'category_id' => rand(1, 20),
                    'categoriable_id' => $excursion->id,
                    'categoriable_type' => 'App\Models\Excursion'
                ]);
            }
        }

    }//END OF RUN
}//END OF CLASS
