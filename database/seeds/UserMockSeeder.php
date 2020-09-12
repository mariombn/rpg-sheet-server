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
            'name' => 'Tonhão',
            'lastname' => 'da Silva',
            'email' => 'tonhao@gmail.com',
            'password' => Hash::make('senha123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cristovão',
            'lastname' => 'Colombo',
            'email' => 'cris@gmail.com',
            'password' => Hash::make('senha123'),
        ]);
    }
}
