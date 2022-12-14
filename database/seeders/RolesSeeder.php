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
                    'id' => 0,
                    'title' => 'Admin',
                ],
                [
                    'id' => 1,
                    'title' => 'Editor',
                ],
                [
                    'id' => 2,
                    'title' => 'Reviewer',
                ],
        ]);
    }
}
