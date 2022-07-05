<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\models\empleado;
use App\models\rol;

class EmpleadoController extends Controller
{
    public function registraEmpleado(Request $request){
        //recogemos los datos del post
        $json = $request->input('json',null);
        $params = json_decode($json);//este es un objeto
        //convertimos el json en un array
        $params_array = json_decode($json,true);

        //validamos los datos
        $validate = Validator::make($params_array, [
            'nombre'        =>  'required|alpha',
            'apaterno'      =>  'required|alpha',
            'amaterno'      =>  'required|alpha',
            'email'         =>  'required|email|unique:empleado',//validamos que este sea unico
            'contrasena'    =>  'required',
            'id_rol'        =>  'required',
        ]);

        if($validate->fails()){
            //si entra aqui la validacion ha fallado
            $data = array(
                'status'    =>  'error',
                'code'      =>  404,
                'message'   =>  'El usuario no se creo, datos invalidos',
                'errors'    => $validate->errors()
            );
        } else{
            //cifrar contrasena
            $pwd = hash('sha256',$params->contrasena);

            //creamos el usuario a guardar asignando los valores recibidos
            $empleado = new Empleado();
            $empleado->nombre = $params_array['nombre'];
            $empleado->apaterno = $params_array['apaterno'];
            if(isset($params_array['amaterno'])){
                $empleado->amaterno = $params_array['amaterno'];
            }
            $empleado->email = $params_array['email'];
            $empleado->contrasena = $pwd;
            $empleado->id_rol = $params_array['id_rol'];

            //guardamos el usuario
            $empleado->save();

            //generamos aviso de guardado exitoso
            $data = array(
                'status'    =>  'success',
                'code'      =>  200,
                'message'   =>  'usuario creado correctamente'
            );

        }
        return response()->json([$data, $data['code']]);
    }

    public function login( Request $request){
        $jwtAuth = new \JwtAuth();

        $json = $request->input('json',null);
        $params = json_decode($json);//este es un objeto
        //convertimos el json en un array
        $params_array = json_decode($json,true);

        //validamos los datos
        $validate = Validator::make($params_array, [
            'email'         =>  'required|email',
            'contrasena'    =>  'required',
        ]);

        if($validate->fails()){
            //si entra aqui la validacion ha fallado
            $data = array(
                'status'    =>  'error',
                'code'      =>  404,
                'message'   =>  'Algo salio mal',
                'errors'    => $validate->errors()
            );
        } else{
            //ciframos la contrasena
            $pwd = hash('sha256',$params->contrasena);

            //devolvemops el token
            $signup = $jwtAuth->signup($params->email,$pwd);
            //pero si recibimos el token devolvemos los datos decodificados
            if(!empty($params->getToken)){
                $signup = $jwtAuth->signup($params->email,$pwd, true);
            }
        }


        //return $jwtAuth->signup($email,$pwd);
        return response()->json($signup, 200);

    }
    
    public function update( Request $request){
        $token = $request -> header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if( $checkToken){
            echo "correcto";
        } else{
            echo "salio masl";
        }
        die();
    }

    public function getRoles(){
        $roles = rol::all();
        return response()->json([
            'code'          =>  200,
            'status'        =>  'success',
            'roles'   =>  $roles
        ]);
    }
}
