<?php

use App\System;
use App\User;
use Illuminate\Database\Seeder;

class UserMockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mario',
            'lastname' => 'de Moraes',
            'email' => 'mariombn@gmail.com',
            'password' => Hash::make('e9f93365bb'),
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('senha123'),
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('senha123'),
        ]);
    }
}
