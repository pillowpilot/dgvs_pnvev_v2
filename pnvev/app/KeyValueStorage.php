<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyValueStorage extends Model
{
    protected $table = 'pnvev_key_value';
    protected $primaryKey = 'key';
    protected $fillable = ['key', 'value'];
}
