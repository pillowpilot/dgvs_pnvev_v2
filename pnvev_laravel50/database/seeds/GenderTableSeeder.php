<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_genders')->insert([
            ['name' => 'Masculino', 'order' => 1],
            ['name' => 'Femenino',  'order' => 2],
            ['name' => 'SD',        'order' => 3],
        ]);
    }
}
