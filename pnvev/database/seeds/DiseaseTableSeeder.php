<?php

use Illuminate\Database\Seeder;

class DiseaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_diseases')->insert([
            ['name' => 'Leishmaniasis Mucosa', 'family' => 1, 'age_group_family' => 1],
            ['name' => 'Leishmaniasis Cutanea', 'family' => 1, 'age_group_family' => 1],
            ['name' => 'Leishmaniasis Viseral', 'family' => 1, 'age_group_family' => 1],
            ['name' => 'Chagas Agudo', 'family' => 2, 'age_group_family' => 1],
            ['name' => 'Chagas Cronico', 'family' => 2, 'age_group_family' => 1],
            ['name' => 'Chagas Congenito', 'family' => 2, 'age_group_family' => 1]
        ]);
        DB::table('pnvev_diseases')->insert([
            ['name' => 'Hantavirus', 'age_group_family' => 1],
            ['name' => 'Malaria', 'age_group_family' => 1],
            ['name' => 'Leptopirosis', 'age_group_family' => 1],
        ]);
    }
}
