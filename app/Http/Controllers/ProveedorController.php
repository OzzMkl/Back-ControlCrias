<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\proveedor;

class ProveedorController extends Controller
{
    public function index(){
        $proveedores = proveedor::all();
        return response()->json([
            'code'          =>  200,
            'status'        =>  'success',
            'proveedores'   =>  $proveedores
        ]);
    }
}
