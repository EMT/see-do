<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name_first' => 'Test',
            'name_last' => 'User',
            'email' => 'test@madebyfieldwork.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
