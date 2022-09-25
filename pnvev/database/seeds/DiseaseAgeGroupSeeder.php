<?php

use Illuminate\Database\Seeder;

class DiseaseAgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_disease_age_groups')->insert([
            ['disease_id' => 1, 'age_group_id' => 1],
            ['disease_id' => 1, 'age_group_id' => 2],
            ['disease_id' => 1, 'age_group_id' => 3],
            ['disease_id' => 1, 'age_group_id' => 4],
            ['disease_id' => 1, 'age_group_id' => 5],
            ['disease_id' => 1, 'age_group_id' => 6],
            ['disease_id' => 1, 'age_group_id' => 7],
        ]);
    }
}
