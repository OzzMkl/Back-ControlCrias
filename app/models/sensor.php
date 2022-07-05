<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sensor extends Model
{
    protected $table = 'sensor';
    protected $primaryKey = 'id_sensor';
    protected $fillable = [
        'statusSensor','freCardiaca','preSanguinea',
        'freRespiratoria','temperatura'
    ];
}
