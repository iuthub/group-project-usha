<?php

use App\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
                'name' => 'Php'
            ],
            [
                'name' => 'JavaScript'
            ],
            [
                'name' => 'Java'
            ],
            [
                'name' => 'Python'
            ],
            [
                'name' => 'Go'
            ],
            [
                'name' => 'Linux'
            ],
            [
                'name' => 'C++'
            ],
            [
                'name' => 'C'
            ],
            [
                'name' => 'Assembly'
            ],
            [
                'name' => 'System Administration'
            ],
            [
                'name' => 'CSS'
            ],
            [
                'name' => 'HTML'
            ],
            [
                'name' => 'React'
            ],
            [
                'name' => 'Vue'
            ],
            [
                'name' => 'Laravel'
            ],
        ];
        DB::table('skills')->insert($skills);
    }
}
