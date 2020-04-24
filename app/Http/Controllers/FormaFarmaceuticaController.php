<?php

namespace App\Http\Controllers;

use App\FormaFarmaceutica;
use App\FormaPresentacion;
use Illuminate\Http\Request;

class FormaFarmaceuticaController extends Controller
{
    //
    public function getFormaFarmaceutica()
    {
        $forma = FormaFarmaceutica::where('estado', '=', 1)->get();

        return response()->json($forma);
    }

    public function getFormaPresentacion()
    {
        $forma = FormaPresentacion::where('estado', '=', 1)->get();

        return response()->json($forma);
    }
}
