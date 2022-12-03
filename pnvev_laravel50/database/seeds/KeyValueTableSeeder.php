<?php

use Illuminate\Database\Seeder;

class KeyValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home_page_file = fopen('database/data/home_page.txt', 'r');
        $adm1_geojson_file = fopen('database/data/py_geojson_adm1.geojson', 'r');
        $adm2_geojson_file = fopen('database/data/py_geojson_adm2.geojson', 'r');

        DB::table('pnvev_key_value')->insert([
            ['key' => 'homePage', 'value' => fread($home_page_file, filesize('database/data/home_page.txt'))],
            ['key' => 'geojsonRegions', 'value' => fread($adm1_geojson_file, filesize('database/data/py_geojson_adm1.geojson'))],
            ['key' => 'geojsonDistricts', 'value' => fread($adm2_geojson_file, filesize('database/data/py_geojson_adm2.geojson'))],
        ]);

        fclose($home_page_file);
        fclose($adm1_geojson_file);
        fclose($adm2_geojson_file);
    }
}
