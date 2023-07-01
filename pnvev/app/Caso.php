<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $table = 'pnvev_casos';

    protected $fillable = ['TipoEnfermedad', 'TipoCaso', 'ClasificacionFinal', 'Sexo', 'Edad', 'GrupoEtareo', 'FechaCarga', 'SemanaEpidemiologica', 'Year'];
}
