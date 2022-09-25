<?php

use Illuminate\Database\Seeder;

class AgeGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_age_groups')->insert([
            ['name' => '<2',       'order' => 1, 'family' => 1],
            ['name' => '2 a 4',    'order' => 2, 'family' => 1],
            ['name' => '5 a 19',   'order' => 3, 'family' => 1],
            ['name' => '20 a 39',  'order' => 4, 'family' => 1],
            ['name' => '40 a 59',  'order' => 5, 'family' => 1],
            ['name' => '60 y mas', 'order' => 6, 'family' => 1],
            ['name' => 'SD',       'order' => 7, 'family' => 1],
        ]);
    }
}
