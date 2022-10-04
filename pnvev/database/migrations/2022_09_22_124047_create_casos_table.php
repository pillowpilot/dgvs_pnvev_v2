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
        DB::statement("CREATE OR REPLACE VIEW `v_pnvev_casos` AS 
            SELECT
	            CASE 
                    WHEN ff.TipoFicha = 'VICERALH' THEN 'LEISHMANIASIS VISCERAL'
                    WHEN ff.TipoFicha = 'CUTANEA' THEN 'LEISHMANIASIS CUTANEA'
                    WHEN ff.TipoFicha = 'MUCOSA' THEN 'LEISHMANIASIS MUCOSA'
                END AS TipoEnfermedad,
                CASE 
                    WHEN ff.TipoFicha = 'VICERALH' THEN 3
                    WHEN ff.TipoFicha = 'CUTANEA' THEN 2
                    WHEN ff.TipoFicha = 'MUCOSA' THEN 1
                END AS EnfermedadId,
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
            ON DATE(ff.FechaCarga) = e.`date`
            UNION
            SELECT 
                CASE 
                    WHEN ff.CaracterizacionCaso = 'CRONICO' THEN 'CHAGAS CRONICO'
                    WHEN ff.CaracterizacionCaso = 'AGUDO' THEN 'CHAGAS AGUDO'
                    WHEN ff.CaracterizacionCaso = 'SD' THEN 'CHAGAS SD'
                END AS TipoEnfermedad,
                CASE
                    WHEN ff.CaracterizacionCaso = 'CRONICO' THEN 5
                    WHEN ff.CaracterizacionCaso = 'AGUDO' THEN 4
                    ELSE NULL
                END AS `EnfermedadId`,
                NULL AS TipoCaso,
                ff.ClasificacionFinal, ff.Sexo, ff.Edad, 
                CASE 
                    WHEN ff.GrupoEtareo not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas') THEN 'SD'
                    ELSE ff.GrupoEtareo
                END AS GrupoEtareo,
                e.`date` AS FechaCarga, e.epiweek AS SemanaEpidemiologica, YEAR(e.`date`) AS Year
            FROM frm_fchagas ff
            INNER JOIN epiweek e
            ON DATE(ff.FechaCarga) = e.`date`");
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
