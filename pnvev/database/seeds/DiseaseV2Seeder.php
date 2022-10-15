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
            ['name' => 'Hantavirus', 'parent_id' => NULL, 'level' => 0, 'order' => 1],
            ['name' => 'Malaria', 'parent_id' => NULL, 'level' => 0, 'order' => 2],
            ['name' => 'Leptopirosis', 'parent_id' => NULL, 'level' => 0, 'order' => 3],
            ['name' => 'Leishmaniasis', 'parent_id' => NULL, 'level' => 0, 'order' => 4],
            ['name' => 'Chagas', 'parent_id' => NULL, 'level' => 0, 'order' => 5],
        ]);
        
        $leishmaniasis = DB::table('pnvev_disease_v2s')->where('name', 'Leishmaniasis')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'L. Tegumentaria', 'parent_id' => $leishmaniasis->id, 'level' => 1, 'order' => 1],
            ['name' => 'L. Visceral', 'parent_id' => $leishmaniasis->id, 'level' => 1, 'order' => 2],
        ]);

        $l_tegumentaria = DB::table('pnvev_disease_v2s')->where('name', 'L. Tegumentaria')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'L. Mucosa', 'parent_id' => $l_tegumentaria->id, 'level' => 2, 'order' => 1],
            ['name' => 'L. Cutanea', 'parent_id' => $l_tegumentaria->id, 'level' => 2, 'order' => 2],
        ]);

        $chagas = DB::table('pnvev_disease_v2s')->where('name', 'Chagas')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'C. Agudo', 'parent_id' => $chagas->id, 'level' => 1, 'order' => 1],
            ['name' => 'C. Cronico', 'parent_id' => $chagas->id, 'level' => 1, 'order' => 2],
        ]);

        $c_cronico = DB::table('pnvev_disease_v2s')->where('name', 'C. Agudo')->first();
        DB::table('pnvev_disease_v2s')->insert([
            ['name' => 'C. Connatal', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 1],
            ['name' => 'C. Vectorial', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 2],
            ['name' => 'C. Transfusional', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 3],
            ['name' => 'C. Oral', 'parent_id' => $c_cronico->id, 'level' => 2, 'order' => 4],
        ]);
    }
}
