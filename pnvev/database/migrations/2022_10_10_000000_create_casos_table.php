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
            select
                (case
                    when (`ff`.`TipoFicha` = 'VICERALH') then 'LEISHMANIASIS VISCERAL'
                    when (`ff`.`TipoFicha` = 'CUTANEA') then 'LEISHMANIASIS CUTANEA'
                    when (`ff`.`TipoFicha` = 'MUCOSA') then 'LEISHMANIASIS MUCOSA'
                end) AS `TipoEnfermedad`,
                (case
                    when (`ff`.`TipoFicha` = 'VICERALH') then 3
                    when (`ff`.`TipoFicha` = 'CUTANEA') then 2
                    when (`ff`.`TipoFicha` = 'MUCOSA') then 1
                end) AS `EnfermedadId`,
                `ff`.`TipoEntrada` AS `TipoCaso`,
                `ff`.`ClasificacionFinal` AS `ClasificacionFinal`,
                `ff`.`Sexo` AS `Sexo`,
                `ff`.`Edad` AS `Edad`,
                (case
                    when (`ff`.`GrupoEtareo` = -(1)) then 'SD'
                    when (`ff`.`GrupoEtareo` = '999 SD') then 'SD'
                    when isnull(`ff`.`GrupoEtareo`) then 'SD'
                    else `ff`.`GrupoEtareo`
                end) AS `GrupoEtareo`,
                `par`.`name` AS `RegionAdministrativa`,
                `par`.`id` AS `RegionAdministrativaId`,
                `e`.`date` AS `FechaCarga`,
                `e`.`epiweek` AS `SemanaEpidemiologica`,
                year(`e`.`date`) AS `Year`
            from
                ((`dgvsops`.`frm_fleishmaniasis` `ff`
            join `dgvsops`.`epiweek` `e` on
                ((cast(`ff`.`FechaCarga` as date) = `e`.`date`)))
            join `dgvsops`.`pnvev_administrative_regions` `par` on
                ((convert(`par`.`forms_name`
                    using utf8mb4) = convert(`ff`.`Departamento_descContagio`
                    using utf8mb4))))
            union
            select
                (case
                    when (`ff`.`CaracterizacionCaso` = 'CRONICO') then 'CHAGAS CRONICO'
                    when (`ff`.`CaracterizacionCaso` = 'AGUDO') then 'CHAGAS AGUDO'
                    when (`ff`.`CaracterizacionCaso` = 'SD') then 'CHAGAS SD'
                end) AS `TipoEnfermedad`,
                (case
                    when (`ff`.`CaracterizacionCaso` = 'CRONICO') then 5
                    when (`ff`.`CaracterizacionCaso` = 'AGUDO') then 4
                    else NULL
                end) AS `EnfermedadId`,
                NULL AS `TipoCaso`,
                `ff`.`ClasificacionFinal` AS `ClasificacionFinal`,
                `ff`.`Sexo` AS `Sexo`,
                `ff`.`Edad` AS `Edad`,
                (case
                    when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
                    else `ff`.`GrupoEtareo`
                end) AS `GrupoEtareo`,
                `par`.`name` AS `RegionAdministrativa`,
                `par`.`id` AS `RegionAdministrativaId`,
                `e`.`date` AS `FechaCarga`,
                `e`.`epiweek` AS `SemanaEpidemiologica`,
                year(`e`.`date`) AS `Year`
            from
                ((`dgvsops`.`frm_fchagas` `ff`
            join `dgvsops`.`epiweek` `e` on
                ((cast(`ff`.`FechaCarga` as date) = `e`.`date`)))
            join `dgvsops`.`pnvev_administrative_regions` `par` on
                ((convert(`par`.`forms_name`
                    using utf8mb4) = convert(`ff`.`Departamento_descContagio`
                    using utf8mb4))))");
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
