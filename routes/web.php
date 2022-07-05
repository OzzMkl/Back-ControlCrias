<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//rutas proveedores
Route::get('/api/proveedores','ProveedorController@index');
//rutas empleado
Route::post('/api/registra-empleado','EmpleadoController@registraEmpleado');
Route::post('/api/login','EmpleadoController@login');
Route::post('/api/update','EmpleadoController@update');
Route::get('/api/roles','EmpleadoController@getRoles');
//rutas cria
Route::get('/api/indexCorral','CriaController@indexCorral');
Route::get('/api/indexCria','CriaController@indexCria');
Route::get('/api/indexCriaSanas','CriaController@indexCriaSanas');
Route::get('/api/indexCriaEnfermas','CriaController@indexCriaEnfermas');
Route::get('/api/indexCriaFinadas','CriaController@indexCriaFinadas');
Route::post('/api/registra-cria','CriaController@registraCria');
Route::post('/api/registra-sensor/{id_cria}','CriaController@registraSensor');
Route::get('/api/busca-cria/{id_cria}','CriaController@buscaCriaID');
Route::get('/api/busca-sensor/{id_cria}','CriaController@buscaSensorID');

Route::put('/api/actualiza-sensor/{id_sensor}', 'CriaController@actualizaSensor');
Route::put('/api/agrega-cuarentena/{id_cria}', 'CriaController@agregaCuarentena');
Route::put('/api/quita-cuarentena/{id_cria}', 'CriaController@quitaCuarentena');
/************* */
