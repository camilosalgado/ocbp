<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', 'AuthController@register');
});


//MEDICAMENTOS
Route::get('getmedicamentos', 'MedicamentoController@getAllMedicamento');
Route::get('getmedicamentodata', 'MedicamentoController@getMedicamentoData');
Route::post('savemedicamento', 'MedicamentoController@saveMedicamento');

//LINKED MEDICAMENTOS
Route::get('getlinkedmedicamentos', 'LinkedMedicamentosController@getLinkedMedicamentos');
Route::post('savelinkedmedicamentos', 'LinkedMedicamentosController@saveLinkedMedicamentos');


//LABORATORIOS
Route::get('getlaboratorios', 'LaboratorioController@getLabs');
Route::post('createlaboratorios', 'LaboratorioController@createLabs');

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
Route::get('getallnegociaciones', 'NegociacionController@getAllNegotiations');
Route::post('updatestatus', 'NegociacionController@desactivateMedicamento');

//CONTANDORES
Route::get('countlaboratorios', function () {
    return response()->json(count(DB::table('laboratorios')->get()));
});
Route::get('countmedicamentos', function () {
    return response()->json(count(DB::table('medicamentos')->get()));
});
Route::get('countaltocosto', function () {
    return response()->json(count(DB::table('medicamentos')->where('alto_costo', '=', 'S')->get()));
});
Route::get('countregulado', function () {
    return response()->json(count(DB::table('medicamentos')->where('regulado', '=', 'S')->get()));
});


//CHARTS
    Route::get('databar', 'ChartController@getDataBarChart');
    Route::get('datapie', 'ChartController@getDataToPieChart');


//APROBACIONES
    Route::get('getapprovednegotiations', 'AprobacionController@getApprovedNegotiations');
    Route::post('approvenegotiations', 'AprobacionController@approveNegotiations');
    Route::get('getorderfromhosvital', 'AprobacionController@getOrdersFromHosvital' );
    //Route::post('saveapproveorder', 'AprobacionController@saveAprroveOrder' );


    Route::get('g', 'AprobacionController@pruebaGuzzle');

Route::get('/{any?}', function () {
    return view('home');
})->where('any', '^(?!api\/)[\/\w\.-]*');
