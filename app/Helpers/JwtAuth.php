<?php

namespace App\Helpers;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\models\empleado;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'llave_secreta-774455';
    }
    public function signup($email, $contrasena, $getToken = null){
        //buscamos si existe el usuario con sus credenciales

        $empleado = Empleado::where([
            'email'         =>  $email,
            'contrasena'    =>  $contrasena
        ])->first();

        //comprobar si son correctos (objeto)
        $signup = false;
        if(is_object($empleado)){
            $signup = true;
        }
        //generar token con los datos del usuario identificado
        if($signup){
            //agregamos los elementos con los que se formara el token
            $token = array(
                'id_empleado'   =>  $empleado->id_empleado,
                'email'         =>  $empleado->email,
                'nombre'        =>  $empleado->nombre,
                'apaterno'      =>  $empleado->apaterno,
                'amaterno'      =>  $empleado->amaterno,
                'iat'           =>  time(),
                'exp'           =>  time()+(60*60*6)//tiempo del token de 6hrs
            );

            //generamos el token con la libreria de jwt
            $jwt = JWT::encode($token,$this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            if(is_null($getToken)){
                $data = $jwt;
            } else{
                $data = $decoded;
            }

        } else{
            $data = array(
                'status'    => 'error',
                'message'   => 'Login incorrecto'
            );
        }

            return $data;

    }
    public function checkToken($jwt, $getIdentity = false){
        $auth = false;
        try{
            $jwt = str_replace('"','',$jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } catch(\UnexpectedValueException $e){
            $auth = false;
        } catch(\DomainException $e){
            $auth = false;
        }

        if(!empty($decoded) && is_object($decoded)  && isset($decoded->id_empleado)){
            $auth = true;
        } else{
            $auth = false;
        }

        if($getIdentity){
            return $decoded;
        }
        return $auth;
    }
}