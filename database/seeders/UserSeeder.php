<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
        	'email' => 'thecong@gmail.com',
        	'name' => 'cong',
        	'phone' => '0987992154',
        	'password' => bcrypt('123456'),
        	'role' => 9
        ];
        DB::table('tbl_admin')->insert($data);
    }
}
