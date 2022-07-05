<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cria extends Model
{
    protected $table = 'cria';
    protected $primaryKey = 'id_cria';
    protected $fillable = [
        'nombre','descripcion','id_proveedor','peso',
        'costo','id_sensor','id_corral','fecha','id_status'
    ];
}
