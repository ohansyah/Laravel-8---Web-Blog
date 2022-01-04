<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\Post;

class posts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,100) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->postTitle(),
                'image' => $faker->imageUrl($width = 250, $height = 250),
                'category' => $faker->word,
                'body' => $faker->text,
                'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta')
            ]);
        }
    }
}
