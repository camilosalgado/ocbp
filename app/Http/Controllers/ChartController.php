<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //
    public function getDataBarChart()
    {
        $query = DB::select('exec getLabWithMaxMedicamento');

        return response()->json($query);
    }

    public function getDataToPieChart()
    {
        $pie = [];

        $altocosto = count(DB::table('medicamentos')->where('alto_costo','=', 'S')->get());
        $regulado = count(DB::table('medicamentos')->where('regulado','=', 'S')->get());
        $otros = count(DB::table('medicamentos')->where([
            ['alto_costo', '=', 'N'],
            ['regulado', '=', 'N']
        ])->get());

        array_push($pie, [$altocosto, $regulado, $otros]);

        return response()->json($pie);

    }

}
