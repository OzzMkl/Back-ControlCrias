<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class corral extends Model
{
    protected $table = 'corral';
    protected $primaryKey = 'id_corral';
    protected $fillable = [
        'nombre','ubicacion','capacidad'
    ];
}
