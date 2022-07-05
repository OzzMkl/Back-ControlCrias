<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    //
    protected $table = 'rol';
    protected $primaryKey = 'id_rol';
    protected $fillable = [
        'nombre'
    ];
}
