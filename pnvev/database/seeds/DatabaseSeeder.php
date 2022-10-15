<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(GenderTableSeeder::class);
        $this->call(AgeGroupTableSeeder::class);
        $this->call(DiseaseFamilyTableSeeder::class);
        $this->call(DiseaseTableSeeder::class); // Depends on DiseaseFamilyTableSeeder
        $this->call(DiseaseAgeGroupSeeder::class);
        $this->call(AdministrativeRegionSeeder::class);
        $this->call(DiseaseV2Seeder::class);

        Model::reguard();
    }
}
