<?php

namespace App\Http\Controllers;

use App\LinkedMedicamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkedMedicamentosController extends Controller
{
    //
    public function getLinkedMedicamentos()
    {
        $query = DB::table('linked_medicamentos as l')
            ->join('medicamentos as m', 'l.med_id', '=', 'm.id')
            ->select('m.nombre_generico as NGENERICO', 'm.codigo_medicamento as CMEDICAMENTO', 'l.h_DESCRIPCION as HDESCRIPCION',
                'l.h_MSNomG as HNGENERICO', 'l.h_MSRESO as HCODIGO', 'l.created_at as FENLACE')
            ->get();

        return response()->json($query, 200);
    }

    public function saveLinkedMedicamentos(Request $request)
    {
        $user = \auth()->user()->getAuthIdentifier();
        $link = LinkedMedicamentos::create([
            'med_id' => $request->item1,
            'h_MSRESO' => $request->item2['PRODUCTO'],
            'h_DESCRIPCION' => $request->item2['DESCRIPCION'],
            'h_MSNomG' => $request->item2['NOMBREGENERICO'],
            'h_MSReg' => $request->item2['REGULADO'],
            'user_id' => $user,
            'estado' => 1
        ]);

        return response()->json('ok', 200);
    }
}
