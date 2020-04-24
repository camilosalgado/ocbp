<?php

namespace App\Http\Controllers;

use App\LaboratoriosMedicamentos;
use App\Negociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NegociacionController extends Controller
{
    //

    public function getMedToNeg()
    {
        return response()->json(DB::table('medicamentos')->where('estado', '=', 1)->get());
    }

    public function saveNegotiations(Request $request)
    {
        $user = auth()->user()->getAuthIdentifier();
        $lab_med = LaboratoriosMedicamentos::create([
            'id_laboratorio' => $request->lab_id,
            'id_medicamento' => $request->cod_med,
            'user_id' => $user
        ]);

        $negociacion = Negociacion::create([
            'id_medicamento' => $request->cod_med,
            'id_laboratorio' => $request->lab_id,
            'valor_propuesta' => $request->valor_propuesta,
            'obs_descuento' => $request->obs_descuento,
            'valor_negociacion' => $request->valor_negociacion,
            'precio_regulado' => $request->precio_regulado,
            'utilidad' => $request->utilidad,
            'aprobacion_farmacia' => 0,
            'id_user' => $user,
            'estado' => 1
        ]);

        $negociacionForward = DB::table('negociaciones as n')
            ->join('medicamentos as m', 'n.id_medicamento', '=', 'm.id')
            ->join('laboratorios as l', 'n.id_laboratorio', '=', 'l.id')
            ->select('n.id', 'n.valor_propuesta', 'n.valor_negociacion', 'n.precio_regulado',
                'n.utilidad', 'n.aprobacion_farmacia', 'n.created_at', 'm.nombre_comercial', 'm.nombre_generico',
                'l.razon_social')
            ->where([
                ['n.estado', '=', 1],
                ['n.id', '=', $negociacion->id]
            ])->get();

        return response([
            'negociacion' => $negociacionForward
        ]);
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

}
