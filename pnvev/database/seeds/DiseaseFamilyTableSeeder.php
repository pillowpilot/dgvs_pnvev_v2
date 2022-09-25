<?php

use Illuminate\Database\Seeder;

class DiseaseFamilyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_disease_families')->insert([
            ['name' => 'Leishmaniasis'],
            ['name' => 'Chagas']
        ]);
    }
}
