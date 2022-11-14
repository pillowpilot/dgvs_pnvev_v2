<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosLeishmaniasisMucosa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `dgvsops`.`v_pnvev_casos_leishmaniasis_mucosa` AS
            select
                8 AS `EnfermedadId`,
                (select name from dgvsops.pnvev_disease_v2s where id = 8) AS `TipoEnfermedad`,
                `ff`.`Sexo` AS `Sexo`,
                `ff`.`Edad` AS `Edad`,
                (case
                    when (`ff`.`GrupoEtareo` = '999 SD') then 'SD'
                    when (`ff`.`GrupoEtareo` = -(1)) then 'SD'
                    when isnull(`ff`.`GrupoEtareo`) then 'SD'
                    else `ff`.`GrupoEtareo`
                end) AS `GrupoEtareo`,
                `par`.`name` AS `RegionAdministrativa`,
                `par`.`id` AS `RegionAdministrativaId`,
                str_to_date(`ff`.`FechaNotificacion`,
                '%d/%m/%Y') AS `Fecha`,
                `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
                year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
            from
                (`dgvsops`.`frm_fleishmaniasis` `ff`
            join `dgvsops`.`pnvev_administrative_regions` `par` on
                ((convert(`par`.`forms_name`
                    using utf8mb4) = convert(`ff`.`Departamento_descContagio`
                    using utf8mb4))))
            where
                ((`ff`.`TipoFicha` = 'MUCOSA')
                    and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
                    and (`ff`.`TipoEntrada` = 'Caso Nuevo') 
                    and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2021));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `v_pnvev_casos_leishmaniasis_mucosa`");
    }
}
