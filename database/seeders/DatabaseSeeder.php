<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'full_name' => 'Admin name',
            'email'     => 'admin@example.com',
            'password'  => '123456789',
            'role'      => 'admin',
            'status'    => 'active',
            'author_id' => null,    
        ]);
    }
}
