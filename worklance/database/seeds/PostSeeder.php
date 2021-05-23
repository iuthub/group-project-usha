<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Post::create([
            'name' => 'Welcome to Worklance',
            'about' => 'You can post and find jobs of your taste here!',
            'description' => 'Lets get it started',
            'user_id' => '1',
            'created_at' => now()->addDay(),
            'price' => '300'
        ]);
        $skills = [
            [
                'name' => 'Lets',
                'post_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Get',
                'post_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'this',
                'post_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'started',
                'post_id' => 1,
                'created_at' => now()
            ],
            ];
            DB::table('post_skills')->insert($skills);

        Post::create([
            'name' => 'Need do finish IP Projet',
            'about' => 'Need to read all requirements and follow them step by step!',
            'description' => 'This project needs to be finished by 23 May 2022',
            'user_id' => '1',
            'created_at' => now(),
            'price' => '1000'
        ]);
        $skills = [
            [
                'name' => 'JavaScript',
                'post_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'Laravel',
                'post_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'JQuery',
                'post_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'Css',
                'post_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'SQL',
                'post_id' => 2,
                'created_at' => now()
            ],
            ];
            DB::table('post_skills')->insert($skills);
        Post::create([
            'name' => 'Ecommerce Website',
            'about' => 'Need a website for selling books online!',
            'description' => 'Need to connect to PayMe and Click for booking online',
            'user_id' => '1',
            'created_at' => now(),
            'price' => '1000'
        ]);
        $skills = [
            [
                'name' => 'JavaScript',
                'post_id' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'NodeJS',
                'post_id' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'VueJS',
                'post_id' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'Css',
                'post_id' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'MongoDB',
                'post_id' => 3,
                'created_at' => now()
            ],
            ];
            DB::table('post_skills')->insert($skills);
    }
}
