<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();

        Role::create(['role_status' => 1]);
        Role::create(['role_status' => 2]);
        Role::create(['role_status' => 9]);
    }
}
