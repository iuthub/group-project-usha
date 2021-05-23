<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Worklance',
            'about' => 'Senior Software Engineer',
            'email' => 'user@gmail.com',
            'profileType' => 'freelancer',
            'password' => Hash::make('password'),
            'created_at' => now()
        ]);

        Role::create([
            'name' => 'admin',
            'user_id' => 1,
            'created_at' => now()
        ]);

        User::create([
            'name' => 'David',
            'about' => 'System Administrator',
            'email' => 'david@gmail.com',
            'profileType' => 'freelancer',
            'password' => Hash::make('password'),
            'created_at' => now()
        ]);

        User::create([
            'name' => 'Wayne',
            'about' => 'Devops Engineer',
            'email' => 'wayne@gmail.com',
            'profileType' => 'freelancer',
            'password' => Hash::make('password'),
            'created_at' => now()
        ]);

        $userSkills = [
            [
                'name' => 'Php',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'JavaScript',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Laravel',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'C++',
                'user_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'GoLang',
                'user_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'Python',
                'user_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'C',
                'user_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'Assembly',
                'user_id' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'Python',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Linux',
                'user_id' => 1,
                'created_at' => now()
            ]
            ];

            DB::table('user_skills')->insert($userSkills);
    }
}
