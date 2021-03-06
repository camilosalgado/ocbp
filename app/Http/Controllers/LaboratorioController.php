<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaboratorioController extends Controller
{
    //
    public function getLabs()
    {
        return response()->json(DB::table('laboratorios')->where('farmacia', '=', 'S')->get());
    }

    public function createLabs(Request $request)
    {
        $user = auth()->user()->getAuthIdentifier();

        $foundlab = DB::table('laboratorios')
            ->where('nit', '=', $request->nit)
            ->get();

        $labcount = count($foundlab);

        if ($labcount !=0) {
            return response()->json(['msg' => 'Ya existe un lab con este nit', 'lab' => $foundlab]);
        }else{
            $lab = Laboratorio::create([
               'razon_social' => strtoupper($request->razon_social),
                'nit' => $request->nit,
                'farmacia' =>  'S',
                'direccion' => strtoupper($request->direccion),
                'telefono' => $request->telefono,
                'user_id' => $user,
                'estado' => 1,
                'created_at' => date('Y-d-m H:i:s'),
                'updated_at' => date('Y-d-m H:i:s'),
            ]);

            return response()->json($lab);

        }
    }

}
