<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseV2 extends Model
{
    protected $table = 'pnvev_disease_v2s';

    public function parent()
    {
        return $this->belongsTo('App\DiseaseV2', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\DiseaseV2', 'parent_id');
    }

    public function leafs()
    {
        return $this->children()->get();
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id')->orderBy('order');
    }

    public function cases()
    {
        return $this->hasMany('App\Caso', 'EnfermedadId');
    }
}
