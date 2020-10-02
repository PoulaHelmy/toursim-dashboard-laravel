<?php

use App\Models\Category;
use App\Models\Photo;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
        foreach ($ids as $id) {
            $category = Category::create([
                'en' => [
                    'name' => $faker->name,
                    'slug' => $faker->name,
                    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                ],
                'ar' => [
                    'name' => $faker->name,
                    'slug' => $faker->name,
                    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                ],
            ]);
            Seo::create([
                'seoable_id' => $category->id,
                'seoable_type' => 'App\Models\Category',
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
                'photoable_id' => $category->id,
                'photoable_type' => 'App\Models\Category',
            ]);
        }

    }//END OF RUN
}//END OF CLASS


