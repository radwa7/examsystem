<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password'  => Hash::make('123456789'),
            'role'      => 'super admin',
            'status'    => 'active',
            'author_id' => null,    
        ]);
    }
}
