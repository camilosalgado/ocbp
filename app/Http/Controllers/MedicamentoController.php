<?php

namespace App\Http\Controllers;

use App\FormaFarmaceutica;
use App\FormaPresentacion;
use App\LinkedMedicamentos;
use App\LaboratoriosMedicamentos;
use App\Medicamento;
use App\Negociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicamentoController extends Controller
{
    //
    public function getMedicamentoData()
    {
        return response()->json(DB::select('exec getAllMedicamento'));
    }

    public function getAllMedicamento()
    {
        return response()->json(DB::select('exec getAllDataMedicamento'));
    }

    public function saveMedicamento(Request $request)
    {
        $user = auth()->user()->getAuthIdentifier();

        $formaf = FormaFarmaceutica::findOrFail($request->id_formaf);
        $formap = FormaPresentacion::findOrFail($request->id_formap);

        if (!$request->deseanegociar) {

            $med = Medicamento::create([
                'codigo_medicamento' => $request->codigo_medicamento,
                'nombre_generico' => strtoupper($request->nombre_generico),
                'nombre_comercial' => strtoupper($request->nombre_comercial),
                'id_formaf' => $formaf->id,
                'id_formap' => $formap->id,
                'presentacion_comercial' => strtoupper(trim($request->nombre_generico, " "))."  ". strtoupper($request->concentracion)."  ". strtoupper($formap->descripcion) ." X ".strtoupper($request->cantidadMed),
                'otro' => 'N',
                'alto_costo' => 'N',
                'super_acosto' => 'N',
                'regulado' => $request->regulado,
                'precio_regulado' => 0,
                'user_id' => $user,
                'estado' => 1
            ]);

            $lab_med = LaboratoriosMedicamentos::create([
                'med_id' => $med->id,
                'lab_id' => 99,
                'user_id' => $user
            ]);

            $nego = Negociacion::create([
                'med_id' => $med->id,
                'lab_id' => 99,
                'vpropuesta' => 0,
                'obs_descuento' => null,
                'vnegociacion' => 0,
                'utilidad' => 0,
                'cantidad' => 0,
                'aprob_farmacia' => 0,
                'user_id' => $user,
                'estado' => 1
            ]);

            return response()->json('Medicamento Guardado Correctamente', 200);

        }else {
            $vnego = $request->valor_negociacion;
            $med = Medicamento::create([
                'codigo_medicamento' => $request->codigo_medicamento,
                'nombre_generico' => strtoupper($request->nombre_generico),
                'nombre_comercial' => strtoupper($request->nombre_comercial),
                'id_formaf' => $formaf->id,
                'id_formap' => $formap->id,
                'presentacion_comercial' => strtoupper(trim($request->nombre_generico, " "))."  ". strtoupper($request->concentracion)."  ". strtoupper($formap->descripcion) ." X ".strtoupper($request->cantidadMed),
                'alto_costo' => $request->alto_costo,
                'regulado' => $request->regulado,
                'user_id' => $user,
                'estado' => 1
            ]);

            $lab_med = LaboratoriosMedicamentos::create([
                'med_id' => $med->id,
                'lab_id' => $request->lab_id,
                'user_id' => $user
            ]);

            $nego = Negociacion::create([
                'med_id' => $med->id,
                'lab_id' => $request->lab_id,
                'vpropuesta' => $request->valor_propuesta,
                'obs_descuento' => $request->obs_descuento,
                'vnegociacion' => $request->valor_negociacion,
                'utilidad' => $request->utilidad,
                'cantidad' => $request->cantidadNeg,
                'aprob_farmacia' => 0,
                'user_id' => $user,
                'estado' => 1
            ]);

            return response()->json('El Medicamento y la Negociacion se han guardado con exito', 200);
        }
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

}
