<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Welcome Message
    $message = [
        'user_id' => 2,
        'from_user_id' => 1,
        'text' => 'Welcome to Worklance',
        'created_at' => now()
    ];
    DB::table('messages')->insert($message);

    }
}
