<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getAmin = Role::where('role_status', 9)->first();
        $getAuthor = Role::where('role_status', 2)->first();
        $getUser = Role::where('role_status', 1)->first();
       $data1 = User::create([
        	'email' => 'thecong1999@gmail.com',
        	'name' => 'cong',
        	'phone' => '0987992154',
        	'password' => bcrypt('123456')
        ]);
        $data2 = User::create([
            'email' => 'thecong96@gmail.com',
            'name' => 'cong1',
            'phone' => '0987992154',
            'password' => bcrypt('123456')
        ]);
        $data3 = User::create([
            'email' => 'thecong@gmail.com',
            'name' => 'cong2',
            'phone' => '0987992154',
            'password' => bcrypt('123456')
        ]);

        $data1->role()->attach($getAmin);
        $data2->role()->attach($getAuthor);
        $data3->role()->attach($getUser);
    }
}
