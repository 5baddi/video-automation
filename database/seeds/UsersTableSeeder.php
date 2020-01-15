<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default user
        DB::table('users')->insert([
            'name' => 'BADDI',
            'email' => 'baddi@v12software.com',
            'password' => bcrypt('Va@v12software'),
        ]);
    }
}
