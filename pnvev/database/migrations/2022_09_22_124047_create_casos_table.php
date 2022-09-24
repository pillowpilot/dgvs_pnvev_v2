<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW `v_pnvev_casos` AS 
            SELECT
	            CASE 
                    WHEN ff.TipoFicha = 'VICERALH' THEN 'LEISHMANIASIS VISCERAL'
                    WHEN ff.TipoFicha = 'CUTANEA' THEN 'LEISHMANIASIS CUTANEA'
                    WHEN ff.TipoFicha = 'MUCOSA' THEN 'LEISHMANIASIS MUCOSA'
                END AS TipoEnfermedad,
                ff.TipoEntrada AS TipoCaso,
                ff.ClasificacionFinal, ff.Sexo, ff.Edad, 
                CASE 
                    WHEN ff.GrupoEtareo = -1 THEN 'SD'
                    WHEN ff.GrupoEtareo = '999 SD' THEN 'SD'
                    WHEN ff.GrupoEtareo IS NULL THEN 'SD'
                    ELSE ff.GrupoEtareo
                END AS GrupoEtareo, 
                e.`date` AS FechaCarga, e.epiweek AS SemanaEpidemiologica, YEAR(e.`date`) AS Year
            FROM frm_fleishmaniasis ff
            INNER JOIN epiweek e
            ON date(ff.FechaCarga) = e.`date`");
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
