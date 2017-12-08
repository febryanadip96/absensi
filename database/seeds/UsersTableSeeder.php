<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Presensi Online',
            'username' => 'admin',
            'email' => 'febryandru@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 1,
        ]);
    }
}
