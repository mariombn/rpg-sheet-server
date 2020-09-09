<?php

use Illuminate\Database\Seeder;
use App\System;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systemEntity = System::create([
            'id'   => 1,
            'name' => 'Vampire'
        ]);
    }
}
