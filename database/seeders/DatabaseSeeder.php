<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
       \App\Models\User::create([
           'name' => 'Admin',
           'email' => 'admin@demo.com',
           'email_verified_at' => now(),
           'password' => Hash::make('123456'), // password
           'remember_token' => Str::random(10),
           'is_active' => 1,
           'is_delete' => 0,
           'group_role' => 1,
       ]);
//        \App\Models\User::factory(10)->create();
        \App\Models\Products::factory(10)->create();

    }
}
