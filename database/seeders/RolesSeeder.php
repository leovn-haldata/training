<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::insert([
                [
                    'id' => 1,
                    'title' => 'Admin',
                ],
                [
                    'id' => 2,
                    'title' => 'Editor',
                ],
                [
                    'id' => 3,
                    'title' => 'Reviewer',
                ],
        ]);
    }
}
