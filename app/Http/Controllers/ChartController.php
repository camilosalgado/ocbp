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

        $altocosto = count(DB::table('medicamentos')->where('alto_costo','=', '1')->get());
        $regulado = count(DB::table('medicamentos')->where('regulado','=', '1')->get());
        $otros = count(DB::table('medicamentos')->where([
            ['alto_costo', '=', '0'],
            ['regulado', '=', '0']
        ])->get());

        array_push($pie, [$altocosto, $regulado, $otros]);

        return response()->json($pie);

    }

}
