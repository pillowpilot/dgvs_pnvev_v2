-- pnvev_dashboard.v_pnvev_casos_leishmaniasis_cutanea source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_cutanea` AS
select
    9 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 9)) AS `TipoEnfermedad`,
    `ff`.`Sexo` AS `Sexo`,
    `ff`.`Edad` AS `Edad`,
    (case
        when (`ff`.`GrupoEtareo` = '-1') then '<2'
        when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
        when isnull(`ff`.`GrupoEtareo`) then 'SD'
        else `ff`.`GrupoEtareo`
    end) AS `GrupoEtareo`,
    str_to_date(`ff`.`FechaNotificacion`,
    '%d/%m/%Y') AS `Fecha`,
    `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`frm_fleishmaniasis` `ff`
where
    ((`ff`.`TipoFicha` = 'CUTANEA')
        and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
            and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2021));


-- pnvev_dashboard.v_pnvev_casos_leishmaniasis_mucosa source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_mucosa` AS
select
    8 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 8)) AS `TipoEnfermedad`,
    `ff`.`Sexo` AS `Sexo`,
    `ff`.`Edad` AS `Edad`,
    (case
        when (`ff`.`GrupoEtareo` = '-1') then '<2'
        when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
        when isnull(`ff`.`GrupoEtareo`) then 'SD'
        else `ff`.`GrupoEtareo`
    end) AS `GrupoEtareo`,
    str_to_date(`ff`.`FechaNotificacion`,
    '%d/%m/%Y') AS `Fecha`,
    `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`frm_fleishmaniasis` `ff`
where
    ((`ff`.`TipoFicha` = 'MUCOSA')
        and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
            and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2021));


-- pnvev_dashboard.v_pnvev_casos_leishmaniasis_tegumentaria source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_tegumentaria` AS
select
    `v_pnvev_casos_leishmaniasis_cutanea`.`EnfermedadId` AS `EnfermedadId`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`Sexo` AS `Sexo`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`Edad` AS `Edad`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`GrupoEtareo` AS `GrupoEtareo`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`Fecha` AS `Fecha`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `v_pnvev_casos_leishmaniasis_cutanea`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_cutanea`
union
select
    `v_pnvev_casos_leishmaniasis_mucosa`.`EnfermedadId` AS `EnfermedadId`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`Sexo` AS `Sexo`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`Edad` AS `Edad`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`GrupoEtareo` AS `GrupoEtareo`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`Fecha` AS `Fecha`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `v_pnvev_casos_leishmaniasis_mucosa`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_mucosa`;


-- pnvev_dashboard.v_pnvev_casos_leishmaniasis_visceral source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_visceral` AS
select
    7 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 7)) AS `TipoEnfermedad`,
    `ff`.`Sexo` AS `Sexo`,
    `ff`.`Edad` AS `Edad`,
    (case
        when (`ff`.`GrupoEtareo` = '-1') then '<2'
        when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
        when isnull(`ff`.`GrupoEtareo`) then 'SD'
        else `ff`.`GrupoEtareo`
    end) AS `GrupoEtareo`,
    str_to_date(`ff`.`FechaNotificacion`,
    '%d/%m/%Y') AS `Fecha`,
    `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`frm_fleishmaniasis` `ff`
where
    ((`ff`.`TipoFicha` = 'VICERALH')
        and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
            and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2020));


-- pnvev_dashboard.v_pnvev_casos_fiebre_amarilla source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_fiebre_amarilla` AS
select
    16 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 16)) AS `TipoEnfermedad`,
    'SD' AS `Sexo`,
    `pf`.`Edad` AS `Edad`,
    (case
        when (replace(`pf`.`GrupoEtareo`, ' años', '') = '-1') then '< 1'
        when (replace(`pf`.`GrupoEtareo`, ' años', '') not in ('< 1', '1 a 4', '5 a 14', '15 a 19', '20 a 39', '40 a 49', '50 a 59', '60 y mas')) then 'SD'
        when isnull(`pf`.`GrupoEtareo`) then 'SD'
        else replace(`pf`.`GrupoEtareo`, ' años', '')
    end) AS `GrupoEtareo`,
    str_to_date(`pf`.`PrimeraConsulta`,
    '%d/%m/%Y') AS `Fecha`,
    `pf`.`PrimeraConsultaSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`pf`.`PrimeraConsulta`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`pacientes_ficha` `pf`
where
    (`pf`.`id_secciones_ficha` = 12);


-- pnvev_dashboard.v_pnvev_casos_chagas_cronico source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_chagas_cronico` AS
select
    11 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 11)) AS `TipoEnfermedad`,
    `ff`.`Sexo` AS `Sexo`,
    `ff`.`Edad` AS `Edad`,
    (case
        when (`ff`.`GrupoEtareo` = '-1') then '<2'
        when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
        when isnull(`ff`.`GrupoEtareo`) then 'SD'
        else `ff`.`GrupoEtareo`
    end) AS `GrupoEtareo`,
    str_to_date(`ff`.`FechaNotificacion`,
    '%d/%m/%Y') AS `Fecha`,
    `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`frm_fchagas` `ff`
where
    ((`ff`.`CaracterizacionCaso` = 'CRONICO')
        and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
            and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2022));


-- pnvev_dashboard.v_pnvev_casos_chagas_agudo source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_chagas_agudo` AS
select
    10 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 10)) AS `TipoEnfermedad`,
    `ff`.`Sexo` AS `Sexo`,
    `ff`.`Edad` AS `Edad`,
    (case
        when (`ff`.`GrupoEtareo` = '-1') then '<2'
        when (`ff`.`GrupoEtareo` not in ('<2', '2 a 4', '5 a 19', '20 a 39', '40 a 59', '60 y mas')) then 'SD'
        when isnull(`ff`.`GrupoEtareo`) then 'SD'
        else `ff`.`GrupoEtareo`
    end) AS `GrupoEtareo`,
    str_to_date(`ff`.`FechaNotificacion`,
    '%d/%m/%Y') AS `Fecha`,
    `ff`.`FechaNotificacionSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`frm_fchagas` `ff`
where
    ((`ff`.`CaracterizacionCaso` = 'AGUDO')
        and (`ff`.`ClasificacionFinal` = 'CONFIRMADO')
            and (year(str_to_date(`ff`.`FechaNotificacion`, '%d/%m/%Y')) >= 2022));

-- pnvev_dashboard.v_pnvev_casos_malaria source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos_malaria` AS
select
    2 AS `EnfermedadId`,
    (
    select
        `pnvev_dashboard`.`pnvev_disease_v2s`.`name`
    from
        `pnvev_dashboard`.`pnvev_disease_v2s`
    where
        (`pnvev_dashboard`.`pnvev_disease_v2s`.`id` = 2)) AS `TipoEnfermedad`,
    'SD' AS `Sexo`,
    `pf`.`Edad` AS `Edad`,
    (case
        when (replace(`pf`.`GrupoEtareo`, ' años', '') = '-1') then '< 1'
        when (replace(`pf`.`GrupoEtareo`, ' años', '') not in ('< 1', '1 a 4', '5 a 14', '15 a 19', '20 a 39', '40 a 49', '50 a 59', '60 y mas')) then 'SD'
        when isnull(`pf`.`GrupoEtareo`) then 'SD'
        else replace(`pf`.`GrupoEtareo`, ' años', '')
    end) AS `GrupoEtareo`,
    str_to_date(`pf`.`PrimeraConsulta`,
    '%d/%m/%Y') AS `Fecha`,
    `pf`.`PrimeraConsultaSE` AS `SemanaEpidemiologica`,
    year(str_to_date(`pf`.`PrimeraConsulta`, '%d/%m/%Y')) AS `Year`
from
    `dgvsops`.`pacientes_ficha` `pf`
where
    (`pf`.`id_secciones_ficha` = 1);

-- pnvev_dashboard.v_pnvev_casos source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `pnvev_dashboard`.`v_pnvev_casos` AS
select
    `vpclt`.`EnfermedadId` AS `EnfermedadId`,
    `vpclt`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `vpclt`.`Sexo` AS `Sexo`,
    `vpclt`.`Edad` AS `Edad`,
    `vpclt`.`GrupoEtareo` AS `GrupoEtareo`,
    `vpclt`.`Fecha` AS `Fecha`,
    `vpclt`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `vpclt`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_tegumentaria` `vpclt`
union
select
    `vpclv`.`EnfermedadId` AS `EnfermedadId`,
    `vpclv`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `vpclv`.`Sexo` AS `Sexo`,
    `vpclv`.`Edad` AS `Edad`,
    `vpclv`.`GrupoEtareo` AS `GrupoEtareo`,
    `vpclv`.`Fecha` AS `Fecha`,
    `vpclv`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `vpclv`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_leishmaniasis_visceral` `vpclv`
union
select
    `vpcca`.`EnfermedadId` AS `EnfermedadId`,
    `vpcca`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `vpcca`.`Sexo` AS `Sexo`,
    `vpcca`.`Edad` AS `Edad`,
    `vpcca`.`GrupoEtareo` AS `GrupoEtareo`,
    `vpcca`.`Fecha` AS `Fecha`,
    `vpcca`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `vpcca`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_chagas_agudo` `vpcca`
union
select
    `vpccc`.`EnfermedadId` AS `EnfermedadId`,
    `vpccc`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `vpccc`.`Sexo` AS `Sexo`,
    `vpccc`.`Edad` AS `Edad`,
    `vpccc`.`GrupoEtareo` AS `GrupoEtareo`,
    `vpccc`.`Fecha` AS `Fecha`,
    `vpccc`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `vpccc`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_chagas_cronico` `vpccc`
union
select
    `vpcfa`.`EnfermedadId` AS `EnfermedadId`,
    `vpcfa`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `vpcfa`.`Sexo` AS `Sexo`,
    `vpcfa`.`Edad` AS `Edad`,
    `vpcfa`.`GrupoEtareo` AS `GrupoEtareo`,
    `vpcfa`.`Fecha` AS `Fecha`,
    `vpcfa`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `vpcfa`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_fiebre_amarilla` `vpcfa`
union
select
    `vpcm`.`EnfermedadId` AS `EnfermedadId`,
    `vpcm`.`TipoEnfermedad` AS `TipoEnfermedad`,
    `vpcm`.`Sexo` AS `Sexo`,
    `vpcm`.`Edad` AS `Edad`,
    `vpcm`.`GrupoEtareo` AS `GrupoEtareo`,
    `vpcm`.`Fecha` AS `Fecha`,
    `vpcm`.`SemanaEpidemiologica` AS `SemanaEpidemiologica`,
    `vpcm`.`Year` AS `Year`
from
    `pnvev_dashboard`.`v_pnvev_casos_malaria` `vpcm`;
