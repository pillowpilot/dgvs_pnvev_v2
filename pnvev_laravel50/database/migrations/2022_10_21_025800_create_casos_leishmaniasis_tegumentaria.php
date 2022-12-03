<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosLeishmaniasisTegumentaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `dgvsops`.`v_pnvev_casos_leishmaniasis_tegumentaria` AS
            select * from `dgvsops`.`v_pnvev_casos_leishmaniasis_cutanea`
            union
            select * from `dgvsops`.`v_pnvev_casos_leishmaniasis_mucosa`;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `v_pnvev_casos_leishmaniasis_tegumentaria`");
    }
}
