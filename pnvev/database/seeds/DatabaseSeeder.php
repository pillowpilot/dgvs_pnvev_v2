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

        $this->call('UsersSeeder');
        $this->call('GenderTableSeeder');
        $this->call('AgeGroupTableSeeder');
        $this->call('AdministrativeRegionSeeder');
        $this->call('DiseaseV2Seeder');
        $this->call('KeyValueTableSeeder');

        Model::reguard();
    }
}
