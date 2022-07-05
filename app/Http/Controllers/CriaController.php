<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\models\cria;
use App\models\corral;
use App\models\sensor;

class CriaController extends Controller
{
    public function indexCorral(){
        $corrales = corral::all();
        return response()->json([
            'code'          =>  200,
            'status'        =>  'success',
            'corrales'   =>  $corrales
        ]);
    }
    public function indexCria(){
        $crias = DB::table('cria')
        ->join('proveedor','proveedor.id_proveedor','=','cria.id_proveedor')
        ->join('corral','corral.id_corral','=','cria.id_corral')
        ->join('status','status.id_status','=','cria.id_status')
        ->select('cria.*','proveedor.nombre as nombreProveedor','corral.nombre as nombreCorral','status.nombre as nombreStatus')
        ->get();

        return response()->json([
            'code'          =>  200,
            'status'        => 'success',
            'crias'   =>  $crias
        ]);
    }
    public function indexCriaSanas(){
        $crias = DB::table('cria')
        ->join('proveedor','proveedor.id_proveedor','=','cria.id_proveedor')
        ->join('corral','corral.id_corral','=','cria.id_corral')
        ->join('status','status.id_status','=','cria.id_status')
        ->select('cria.*','proveedor.nombre as nombreProveedor','corral.nombre as nombreCorral','status.nombre as nombreStatus')
        ->where('cria.id_status',1)
        ->get();

        return response()->json([
            'code'          =>  200,
            'status'        => 'success',
            'crias'   =>  $crias
        ]);
    }
    public function indexCriaEnfermas(){
        $crias = DB::table('cria')
        ->join('proveedor','proveedor.id_proveedor','=','cria.id_proveedor')
        ->join('corral','corral.id_corral','=','cria.id_corral')
        ->join('status','status.id_status','=','cria.id_status')
        ->select('cria.*','proveedor.nombre as nombreProveedor','corral.nombre as nombreCorral','status.nombre as nombreStatus')
        ->where('cria.id_status',2)
        ->get();

        return response()->json([
            'code'          =>  200,
            'status'        => 'success',
            'crias'   =>  $crias
        ]);
    }
    public function indexCriaFinadas(){
        $crias = DB::table('cria')
        ->join('proveedor','proveedor.id_proveedor','=','cria.id_proveedor')
        ->join('corral','corral.id_corral','=','cria.id_corral')
        ->join('status','status.id_status','=','cria.id_status')
        ->select('cria.*','proveedor.nombre as nombreProveedor','corral.nombre as nombreCorral','status.nombre as nombreStatus')
        ->where('cria.id_status',3)
        ->get();

        return response()->json([
            'code'          =>  200,
            'status'        => 'success',
            'crias'   =>  $crias
        ]);
    }
    public function buscaCriaID($id_cria){
        $cria = DB::table('cria')
            ->join('proveedor','proveedor.id_proveedor','=','cria.id_proveedor')
            ->join('corral','corral.id_corral','=','cria.id_corral')
            ->join('status','status.id_status','=','cria.id_status')
            ->select('cria.*','proveedor.nombre as nombreProveedor','corral.nombre as nombreCorral','status.nombre as nombreStatus')
            ->where('cria.id_cria',$id_cria)
            ->get();
            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'cria'      => $cria
            ]);
    }
    public function registraSensor($id_cria,Request $request){
        //recogemos los datos del post
        $json = $request->input('json',null);
        $params = json_decode($json);//este es un objeto
        //convertimos el json en un array
        $params_array = json_decode($json,true);

        //validamos los datos
        $validate = Validator::make($params_array, [
            //'statusSensor'        =>  'required',
            'freCardiaca'      =>  'required',
            'preSanguinea'      =>  'required',
            'freRespiratoria'      =>  'required',
            'temperatura'      =>  'required'
        ]);
        if($validate->fails()){
            //si entra aqui la validacion ha fallado
            $data = array(
                'status'    =>  'error',
                'code'      =>  404,
                'message'   =>  'El sensor no se creo, datos invalidos',
                'errors'    => $validate->errors()
            );
        } else{
            $sensor = new Sensor();
            //asignamos los valors
            //$sensor->statusSensor = $params_array['statusSensor'];
            $sensor->freCardiaca = $params_array['freCardiaca'];
            $sensor->preSanguinea = $params_array['preSanguinea'];
            $sensor->freRespiratoria = $params_array['freRespiratoria'];
            $sensor->temperatura = $params_array['temperatura'];

            //guardamos
            $sensor->save();

            //consultamos el ultimo ingresado
            $sensor = sensor::latest('id_sensor')->first();
            $newArray =["id_sensor" => $sensor->id_sensor];
            //actualizamos a cria con el sensor
            $cria = cria::where('id_cria',$id_cria)->update($newArray);

            //mandamos data del objeto guardado correctamente
            $data = array(
                'status'    =>  'success',
                'code'      =>  200,
                'message'   =>  'Sensor guardo correctamente',
                'sensor'    =>  $sensor
            );  
        }
        return response()->json([$data, $data['code']]);
    }
    public function registraCria(Request $request){
        //recogemos los datos del post
        $json = $request->input('json',null);
        $params = json_decode($json);//este es un objeto
        //convertimos el json en un array
        $params_array = json_decode($json,true);

        //validamos los datos
        $validate = Validator::make($params_array, [
            'nombre'        =>  'required|alpha',
            'descripcion'      =>  'required',
            'id_proveedor'      =>  'required',
            'peso'      =>  'required',
            'costo'      =>  'required',
            'colorMusculo'      =>  'required',
            'marmoleo'      =>  'required',
            'id_corral'      =>  'required'
        ]);
        if($validate->fails()){
            //si entra aqui la validacion ha fallado
            $data = array(
                'status'    =>  'error',
                'code'      =>  404,
                'message'   =>  'La cria no se creo, datos invalidos',
                'errors'    => $validate->errors()
            );
        } else{
            //creamos el objeto a guardar
            $cria = new Cria();
            //asignamos los valores
            $cria->nombre = $params_array['nombre'];
            $cria->descripcion = $params_array['descripcion'];
            $cria->fecha = $params_array['fecha'];
            $cria->id_proveedor = $params_array['id_proveedor'];
            $cria->peso = $params_array['peso'];
            $cria->costo = $params_array['costo'];
            $cria->colorMusculo = $params_array['colorMusculo'];
            $cria->marmoleo = $params_array['marmoleo'];
            $cria->id_corral = $params_array['id_corral'];
            if(isset($params_array['id_sensor'])){
                $cria->id_sensor = $params_array['id_sensor'];
            }
            $cria->id_status = $params_array['id_status'];

            //guardamos el obkjeto
            $cria->save();

            //mandamos data del objeto guardado correctamente
            $data = array(
                'status'    =>  'success',
                'code'      =>  200,
                'message'   =>  'cria creada correctamente'
            );

        }
        return response()->json([$data, $data['code']]);
    }
    public function buscaSensorID($id_sensor){
        $sensor = DB::table('sensor')->get();
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'sensor'      => $sensor
        ]);
    }
    public function actualizaSensor($id_sensor, Request $request){        
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        if(!empty($params_array)){
            //quitamos valores que no queremos actualizar
            unset($params_array['id_sensor']);

            //actualizamos
            $sensor = sensor::where('id_sensor',$id_sensor)->update($params_array);

            $data = array(
                'code'         =>  200,
                'status'       =>  'success',
                'sensor'    =>  $sensor
            );
        } else{
            $data = array(
                'code'         =>  200,
                'status'       =>  'error',
                'message'      =>  'Error al procesar'
            );
        }
        return response()->json($data,$data['code']);
    }
    public function agregaCuarentena($id_cria){
        //generamos array con los datos a actualziar
        $newArray = ["id_corral"=>"3","id_Status"=>"2"];

        //actualizamos
        $cria = cria::where('id_cria',$id_cria)->update($newArray);

        return response()->json([
            'code'      =>  200,
            'status'    =>  'success',
            'message'   =>  'Cria actualizada correctamente',
            'cria'      =>  $cria
        ]);
    }
    public function quitaCuarentena($id_cria){
        //generamos array con los datos a actualziar
        $newArray = ["id_corral"=>"1","id_Status"=>"1"];

        //actualizamos
        $cria = cria::where('id_cria',$id_cria)->update($newArray);

        return response()->json([
            'code'      =>  200,
            'status'    =>  'success',
            'message'   =>  'Cria actualizada correctamente',
            'cria'      =>  $cria
        ]);
    }
    
}
/***** */