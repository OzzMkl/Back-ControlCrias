<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    //
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    protected $fillable = [
        'nombre','apaterno','amaterno','email',
        'contrasena','id_rol'
    ];
}
