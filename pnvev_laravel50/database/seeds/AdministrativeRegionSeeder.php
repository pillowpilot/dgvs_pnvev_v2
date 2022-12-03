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
            ['name' => 'Alto Paraguay', 'forms_name' => 'ALTO PARAGUAY', 'map_code' => 'py-ag'],
            ['name' => 'Alto Parana', 'forms_name' => 'ALTO PARANA', 'map_code' => 'py-aa'],
            ['name' => 'Amambay', 'forms_name' => 'AMAMBAY', 'map_code' => 'py-am'],
            ['name' => 'Asunción', 'forms_name' => 'ASUNCION', 'map_code' => 'py-as'],
            ['name' => 'Boqueron', 'forms_name' => 'BOQUERON', 'map_code' => 'py-bq'],
            ['name' => 'Caaguazu', 'forms_name' => 'CAAGUAZU', 'map_code' => 'py-cg'],
            ['name' => 'Caazapa', 'forms_name' => 'CAAZAPA', 'map_code' => 'py-cz'],
            ['name' => 'Canindeyu', 'forms_name' => 'CANINDEYU', 'map_code' => 'py-cy'],
            ['name' => 'Central', 'forms_name' => 'CENTRAL', 'map_code' => 'py-ce'],
            ['name' => 'Concepcion', 'forms_name' => 'CONCEPCION', 'map_code' => 'py-cn'],
            ['name' => 'Cordillera', 'forms_name' => 'CORDILLERA', 'map_code' => 'py-cr'],
            ['name' => 'Extranjero', 'forms_name' => 'EXTRANJERO', 'map_code' => null],
            ['name' => 'Guaira', 'forms_name' => 'GUAIRA', 'map_code' => 'py-gu'],
            ['name' => 'Itapua', 'forms_name' => 'ITAPUA', 'map_code' => 'py-it'],
            ['name' => 'Misiones', 'forms_name' => 'MISIONES', 'map_code' => 'py-mi'],
            ['name' => 'Ñeembucu', 'forms_name' => 'ÑEEMBUCU', 'map_code' => 'py-ne'],
            ['name' => 'Paraguari', 'forms_name' => 'PARAGUARI', 'map_code' => 'py-pg'],
            ['name' => 'Presidente Hayes', 'forms_name' => 'PTE. HAYES', 'map_code' => 'py-ph'],
            ['name' => 'San Pedro', 'forms_name' => 'SAN PEDRO', 'map_code' => 'py-sp'],
            ['name' => 'Sin Datos', 'forms_name' => 'SIN DATOS', 'map_code' => null],
        ]);
    }
}
