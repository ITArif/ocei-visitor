<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VisitorAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visitor_admins')->insert([
            'name'=>'Arif islam',
            'email'=>'admin@gmail.com',
            'mobile'=>'01723093965',
            'password'=>Hash::make('123456'),
            'status'=>1,
            'role'=>'admin'
        ]);
    }
}
