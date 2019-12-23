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
            'name' => 'Beheerder',
            'email' => 'eenmail@hotmail.com',
            'password' => bcrypt('Roadleaf!@#123'),
        ]);
    }
}
