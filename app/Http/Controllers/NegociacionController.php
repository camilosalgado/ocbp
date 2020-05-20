<?php

namespace App\Http\Controllers;

use App\LaboratoriosMedicamentos;
use App\Medicamento;
use App\Negociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NegociacionController extends Controller
{
    //

    public function saveNegotiations(Request $request)
    {
        $user = auth()->user()->getAuthIdentifier();

        $lab_med = LaboratoriosMedicamentos::create([
            'med_id' => $request->cod_med,
            'lab_id' => $request->lab_idNeg,
            'user_id' => $user,
            'created_at' => date('Y-d-m H:i:s'),
            'updated_at' => date('Y-d-m H:i:s'),
        ]);

        $negociacion = Negociacion::create([
            'med_id' => $request->cod_med,
            'lab_id' => $request->lab_idNeg,
            'vpropuesta' => $request->valor_propuesta,
            'obs_descuento' => $request->obs_descuento,
            'vnegociacion' => $request->valor_negociacion,
            'utilidad' => $request->utilidad,
            'cantidad' => $request->cantidad,
            'aprob_farmacia' => 0,
            'user_id' => $user,
            'estado' => 1,
            'created_at' => date('Y-d-m H:i:s'),
            'updated_at' => date('Y-d-m H:i:s'),
        ]);

        $negociacionForward = DB::table('negociaciones as n')
            ->join('medicamentos as m', 'n.med_id', '=', 'm.id')
            ->join('laboratorios as l', 'n.lab_id', '=', 'l.id')
            ->select('n.id', 'n.vpropuesta', 'n.vnegociacion',
                'n.utilidad', 'n.aprob_farmacia', 'n.created_at', 'm.nombre_comercial', 'm.nombre_generico',
                'l.razon_social')
            ->where([
                ['n.estado', '=', 1],
                ['n.id', '=', $negociacion->id]
            ])->get();

        return response()->json('Negociacion Guardada Correctamente', 200);
    }

    public function getNegotiationsByMed($id)
    {
        $negociacion = DB::select('exec getNegociacionesByMed ?', array($id));

        return response()->json($negociacion);
    }

    public function getAllNegotiations()
    {
        $negociacion = DB::select('exec getAllNegociaciones');

        return response()->json($negociacion);
    }

    public function desactivateMedicamento(Request $request)
    {
        $comodin = Negociacion::findOrFail($request->idneg);
        $comodin->estado = 0;

        if($comodin->save()) {
            return response()->json('ok', 200);
        }
    }

}
