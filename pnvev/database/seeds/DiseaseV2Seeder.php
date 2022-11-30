<?php

use Illuminate\Database\Seeder;

class DiseaseV2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'Hantavirus', 'parent_id' => NULL, 'level' => 0, 'order' => 1, 'case_description' => 'Casos Confirmados'],
            ['name' => 'Malaria', 'parent_id' => NULL, 'level' => 0, 'order' => 2, 'case_description' => 'Casos Importados'],
            ['name' => 'Leptopirosis', 'parent_id' => NULL, 'level' => 0, 'order' => 3, 'case_description' => 'Casos Confirmados'],
            ['name' => 'Leishmaniasis', 'parent_id' => NULL, 'level' => 0, 'order' => 4, 'case_description' => 'Casos Confirmados'],
            ['name' => 'Chagas', 'parent_id' => NULL, 'level' => 0, 'order' => 5, 'case_description' => 'Casos Confirmados'],
        ]);
        
        $leishmaniasis = DB::table('pnvev_disease_v2s')->where('name', 'Leishmaniasis')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'L. Tegumentaria', 'parent_id' => $leishmaniasis->id, 'level' => 1, 'order' => 1, 'case_description' => 'Casos Confirmados'],
            ['name' => 'L. Visceral', 'parent_id' => $leishmaniasis->id, 'level' => 1, 'order' => 2, 'case_description' => 'Casos Confirmados'],
        ]);

        $l_tegumentaria = DB::table('pnvev_disease_v2s')->where('name', 'L. Tegumentaria')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'L. Mucosa', 'parent_id' => $l_tegumentaria->id, 'level' => 2, 'order' => 1, 'case_description' => 'Casos Confirmados'],
            ['name' => 'L. Cutanea', 'parent_id' => $l_tegumentaria->id, 'level' => 2, 'order' => 2, 'case_description' => 'Casos Confirmados'],
        ]);

        $chagas = DB::table('pnvev_disease_v2s')->where('name', 'Chagas')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'C. Agudo', 'parent_id' => $chagas->id, 'level' => 1, 'order' => 1, 'case_description' => 'Casos Confirmados'],
            ['name' => 'C. Cronico', 'parent_id' => $chagas->id, 'level' => 1, 'order' => 2, 'case_description' => 'Casos Confirmados'],
        ]);

        $c_cronico = DB::table('pnvev_disease_v2s')->where('name', 'C. Agudo')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'C. Connatal', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 1, 'case_description' => 'Casos Confirmados'],
            ['name' => 'C. Vectorial', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 2, 'case_description' => 'Casos Confirmados'],
            ['name' => 'C. Transfusional', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 3, 'case_description' => 'Casos Confirmados'],
            ['name' => 'C. Oral', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 4, 'case_description' => 'Casos Confirmados'],
        ]);
    }
}
