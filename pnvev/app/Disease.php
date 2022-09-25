<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'pnvev_diseases';

    public function ageGroups()
    {
        return $this->belongsToMany('App\AgeGroup', 'pnvev_disease_age_groups', 'disease_id', 'age_group_id');
    }
}
