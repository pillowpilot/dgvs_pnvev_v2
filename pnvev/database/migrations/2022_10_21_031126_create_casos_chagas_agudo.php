<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosChagasAgudo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `dgvsops`.`v_pnvev_casos_chagas_agudo` AS
            select
                10 AS `EnfermedadId`,
                (select name from dgvsops.pnvev_disease_v2s where id = 10) AS `TipoEnfermedad`,
                `ff`.`Sexo` AS `Sexo`,
                `ff`.`Edad` AS `Edad`,
                (case
                    when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
                    else `ff`.`GrupoEtareo`
                end) AS `GrupoEtareo`,
                `par`.`name` AS `RegionAdministrativa`,
                `par`.`id` AS `RegionAdministrativaId`,
                str_to_date(`ff`.`FechaNotificacion`,
                '%d/%m/%Y') AS `Fecha`,
                `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
                year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
            from
                (`dgvsops`.`frm_fchagas` `ff`
            join `dgvsops`.`pnvev_administrative_regions` `par` on
                ((convert(`par`.`forms_name`
                    using utf8mb4) = convert(`ff`.`Departamento_desc`
                    using utf8mb4))))
            where
                ((`ff`.`CaracterizacionCaso` = 'AGUDO')
                    and (`ff`.`ClasificacionFinal` = 'CONFIRMADO'));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS `v_pnvev_casos_chagas_agudo`');
    }
}
