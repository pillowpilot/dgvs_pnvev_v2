<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosTable extENDs Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `dgvsops`.`v_pnvev_casos` AS
            select * from dgvsops.v_pnvev_casos_leishmaniasis_tegumentaria vpclt 
            union
            select * from dgvsops.v_pnvev_casos_leishmaniasis_visceral vpclv
            union
            select * from dgvsops.v_pnvev_casos_chagas_agudo vpcca 
            union
            select * from dgvsops.v_pnvev_casos_chagas_cronico vpccc");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS `v_pnvev_casos`');
    }
}
