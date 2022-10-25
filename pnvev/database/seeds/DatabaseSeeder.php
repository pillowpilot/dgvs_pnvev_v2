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

        $this->call(UsersSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(AgeGroupTableSeeder::class);
        $this->call(AdministrativeRegionSeeder::class);
        $this->call(DiseaseV2Seeder::class);
        $this->call(KeyValueTableSeeder::class);

        Model::reguard();
    }
}
