<?php

use Illuminate\Database\Seeder;

class AdministrativeRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnvev_administrative_regions')->insert([
            ['name' => 'Alto Paraguay', 'forms_name' => 'ALTO PARAGUAY', 'map_code' => 'py-'],
            ['name' => 'Alto Parana', 'forms_name' => 'ALTO PARANA', 'map_code' => 'py-'],
            ['name' => 'Amambay', 'forms_name' => 'AMAMBAY', 'map_code' => 'py-'],
            ['name' => 'Asunción', 'forms_name' => 'ASUNCION', 'map_code' => 'py-'],
            ['name' => 'Boqueron', 'forms_name' => 'BOQUERON', 'map_code' => 'py-'],
            ['name' => 'Caaguazu', 'forms_name' => 'CAAGUAZU', 'map_code' => 'py-'],
            ['name' => 'Caazapa', 'forms_name' => 'CAAZAPA', 'map_code' => 'py-'],
            ['name' => 'Canindeyu', 'forms_name' => 'CANINDEYU', 'map_code' => 'py-'],
            ['name' => 'Central', 'forms_name' => 'CENTRAL', 'map_code' => 'py-'],
            ['name' => 'Concepcion', 'forms_name' => 'CONCEPCION', 'map_code' => 'py-'],
            ['name' => 'Cordillera', 'forms_name' => 'CORDILLERA', 'map_code' => 'py-'],
            ['name' => 'Extranjero', 'forms_name' => 'EXTRANJERO', 'map_code' => null],
            ['name' => 'Guaira', 'forms_name' => 'GUAIRA', 'map_code' => 'py-'],
            ['name' => 'Itapua', 'forms_name' => 'ITAPUA', 'map_code' => 'py-'],
            ['name' => 'Misiones', 'forms_name' => 'MISIONES', 'map_code' => 'py-'],
            ['name' => 'Ñeembucu', 'forms_name' => 'ÑEEMBUCU', 'map_code' => 'py-'],
            ['name' => 'Paraguari', 'forms_name' => 'PARAGUARI', 'map_code' => 'py-'],
            ['name' => 'Presidente Hayes', 'forms_name' => 'PTE. HAYES', 'map_code' => 'py-'],
            ['name' => 'San Pedro', 'forms_name' => 'SAN PEDRO', 'map_code' => 'py-'],
            ['name' => 'Sin Datos', 'forms_name' => 'SIN DATOS', 'map_code' => null],
        ]);
    }
}
