<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosLeishmaniasisViceral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE
        ALGORITHM = UNDEFINED VIEW `dgvsops`.`v_pnvev_casos_leishmaniasis_visceral` AS
        select
            7 AS `EnfermedadId`,
            (
            select
                `dgvsops`.`pnvev_disease_v2s`.`name`
            from
                `dgvsops`.`pnvev_disease_v2s`
            where
                (`dgvsops`.`pnvev_disease_v2s`.`id` = 7)) AS `TipoEnfermedad`,
            `ff`.`Sexo` AS `Sexo`,
            `ff`.`Edad` AS `Edad`,
            `ff`.`GrupoEtareo` AS `GrupoEtareo`,
            'DEPRECATED' AS `RegionAdministrativa`,
            'DEPRECATED' AS `RegionAdministrativaId`,
            str_to_date(`ff`.`FechaNotificacion`,
            '%d/%m/%Y') AS `Fecha`,
            `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
            year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
        from
            `dgvsops`.`frm_fleishmaniasis` `ff`
        where
            ((`ff`.`TipoFicha` = 'VICERALH')
                and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
                    and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2020));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS `v_pnvev_casos_leishmaniasis_visceral`');
    }
}
