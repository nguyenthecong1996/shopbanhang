<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TblUserSeeder extends Seeder
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
        	'password' => bcrypt('123456'),
        	'role' => 1
        ];
        DB::table('tbl_users')->insert($data);
    }
}
