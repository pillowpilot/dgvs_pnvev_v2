<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_users')->insert([
            ['name' => 'Administrator', 'email' => 'admin', 'password' => Hash::make('admin')]
        ]);
    }
}
