<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
           'name' => 'Vinicius',
            'email' => 'vinicius@email.com',
            'passoword' => bcrypt('123456'),
        ]);
        
        User::create([
            'name' => 'Carlos Campanile',
            'email' => 'vincyparker@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
