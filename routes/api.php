<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//USERS CREATE, INACTIVATE & UPDATE
Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', 'AuthController@register');
});

//MEDICAMENTOS
Route::get('getmedicamentos', 'MedicamentoController@getAllMedicamento');
Route::post('savemedicamento', 'MedicamentoController@saveMedicamento');
Route::put('updatestatus/{id}', 'MedicamentoController@desactivateMedicamento');
Route::get('getdatamedtonegotiations/{id}', 'MedicamentoController@getDataMedToNegotiations');

//LABORATORIOS
Route::get('getlaboratorios', 'LaboratorioController@getLabs');

//FORMA FARMACEUTICA
Route::get('getformafarmaceutica', 'FormaFarmaceuticaController@getFormaFarmaceutica');
Route::get('getformapresentacion', 'FormaFarmaceuticaController@getFormaPresentacion');

//USERS SHOW
Route::get('getusers', 'UserController@getAllUsers');

//TIPO DOCS
Route::get('gettipodocs', 'TipoDocController@getTipoDocs');

//ROLES
Route::get('getroles', 'RoleController@getRoles');

//GETLASTMEDID
Route::get('getlastmedid', function() {
    $vr = DB::table('medicamentos')->max('id');
    $vrplus = $vr + 1;
    return response()->json($vrplus);
});

//NEGOCIACIONES
Route::get('getmedicamentotoneg', 'NegociacionController@getMedToNeg');
Route::get('getnegotiations/{idmed}', 'NegociacionController@getNegotiationsByMed');
Route::post('savenegotiations', 'NegociacionController@saveNegotiations');
