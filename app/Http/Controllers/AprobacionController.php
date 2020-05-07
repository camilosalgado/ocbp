<?php

namespace App\Http\Controllers;

use App\Aprobacion;
use App\Negociacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class AprobacionController extends Controller
{
    //
    public function getOrdersFromHosvital()
    {
        $resp = Http::get('http://ocbp.hosvital.api/api/v1/ordenescompra');
        return $resp->json();
    }

    public function saveAprroveOrder(Request $request)
    {

        $user = auth()->user()->getAuthIdentifier();

        $order = Aprobacion::create([
            'nro_orden_hosvital' => $request->NRO_ORDEN,
            'estado' => 1,
            'user_id' => $user,
        ]);

        return response('ok',200);
    }

    public function getApprovedNegotiations()
    {
        $negociacion = DB::select('exec getNegoAprobadas');

        return response()->json($negociacion);
    }

    public function approveNegotiations(Request $request)
    {
        $query = Negociacion::findOrFail($request->id);

        $query->aprob_farmacia = 1;
        $query->save();

        return response()->json('ok', 200);
    }




    /*public function pruebaGuzzle()
    {
        $resp = Http::get('http://ocbp.hosvital.api/api/v1/abonos');
        $ap = DB::table('aprobaciones')
                        ->where('estado', '=', 1)->get();

        $respcount = sizeof($resp->json());
        $apcount = sizeof($ap);
        $respArray = array();
        $appArray = array();
        $totalArray = array();


        for ($i=0; $i < $respcount ;$i++) {
            $respArray[$i] = $resp->json()[$i]['NRO_ORDEN'];
            for ($j=0; $j < $apcount; $j++){
                $appArray[$j] = $ap[$j]->nro_orden_hosvital;
            }
        }


        foreach ($appArray as $valor) {
            if (in_array($valor, $respArray)) {
                $totalArray[] = $valor;
            }
        }

        return $totalArray;
    }*/
}
