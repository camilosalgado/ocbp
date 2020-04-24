<?php

namespace App\Http\Controllers;

use App\FormaFarmaceutica;
use App\FormaPresentacion;
use App\LinkedMedicamentos;
use App\Medicamento;
use App\Negociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicamentoController extends Controller
{
    //
    public function getAllMedicamento()
    {
        return response()->json(DB::select('exec getAllDataMedicamento'));
    }

    public function saveMedicamento(Request $request)
    {
        $user = auth()->user()->getAuthIdentifier();
        $formaf = FormaFarmaceutica::findOrFail($request->id_formaf);
        $formap = FormaPresentacion::findOrFail($request->id_formap);

        $med = Medicamento::create([
            'codigo_medicamento' => $request->codigo_medicamento,
            'nombre_generico' => strtoupper($request->nombre_generico),
            'nombre_comercial' => strtoupper($request->nombre_comercial),
            'id_formaf' => $formaf->id,
            'concentracion' => strtoupper($request->concentracion),
            'id_formap' => $request->id_formap,
            'cantidad' => $request->cantidad,
            'presentacion_comercial' => strtoupper(trim($formap->descripcion, " "))." X ".strtoupper($request->cantidad),
            'forma_farmaceutica' => strtoupper(trim($formap->descripcion, " "))." X ".strtoupper($request->concentracion),
            'alto_costo' => $request->alto_costo,
            'regulado' => $request->regulado,
            'user_id' => $user,
            'estado' => 1
        ]);

        return response()->json($med);

    }

    public function getDataMedToNegotiations($id)
    {
        return response()->json(DB::table('medicamentos as m')
            ->join('forma_farmaceuticas as ff', 'm.id_formaf', '=', 'ff.id')
            ->select('m.codigo_medicamento', 'm.nombre_generico as nombre_generico',
                'm.nombre_comercial as nombre_comercial', 'ff.descripcion as embalaje', 'm.concentracion', 'm.cantidad', 'm.presentacion_comercial', 'm.alto_costo', 'm.regulado')
            ->where([
                ['m.estado', '=', '1'],
                ['m.codigo_medicamento', '=', $id]
            ])->get());
    }

    public function getLinkedMedicamentos()
    {
        $query = DB::table('linked_medicamentos as l')
                        ->join('medicamentos as m', 'l.id_medicamento', '=', 'm.id')
                        ->select('m.nombre_generico as NGENERICO', 'm.codigo_medicamento as CMEDICAMENTO', 'l.h_DESCRIPCION as HDESCRIPCION',
                                            'l.h_MSNomG as HNGENERICO', 'l.h_MSRESO as HCODIGO', 'l.created_at as FENLACE')
                        ->where('l.estado', '=', 1)->get();

        return response()->json($query, 200);
    }

    public function saveLinkedMedicamentos(Request $request)
    {
        $user = \auth()->user()->getAuthIdentifier();
        $link = LinkedMedicamentos::create([
            'id_medicamento' => $request->item1,
            'h_MSRESO' => $request->item2['PRODUCTO'],
            'h_DESCRIPCION' => $request->item2['DESCRIPCION'],
            'h_MSNomG' => $request->item2['NOMBREGENERICO'],
            'h_MSReg' => $request->item2['REGULADO'],
            'user_id' => $user,
            'estado' => 1
        ]);

        return response()->json('ok', 200);
    }

    public function desactivateMedicamento($id)
    {
        $comodin = Medicamento::findOrFail($id);
        $comodin->estado = 0;

        if($comodin->save()) {
            return response()->json('ok', 200);
        }
    }
}
