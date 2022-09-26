<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseFamily extends Model
{
    protected $table = 'pnvev_disease_families';

    public function diseases()
    {
        return $this->hasMany('App\Disease', 'family');
    }
}
