<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::query()->truncate();
        $results = [];
        $faker = Factory::create();
        for ($i = 0; $i <= 100; $i++) {
            $title = $faker->jobTitle;
            $results[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'status' => array_rand([0,1]),
                'content' => $faker->text,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // eloquent
        Post::query()
            ->insert($results);

        // query builder
//        DB::table('posts')->insert($results);
    }
}
