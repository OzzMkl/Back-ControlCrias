<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = [
        'nombre','direccion','telefono','email'
    ];
}
