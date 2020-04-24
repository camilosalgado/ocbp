<?php

namespace App\Http\Controllers;

use App\TipoDoc;
use Illuminate\Http\Request;

class TipoDocController extends Controller
{
    //
    public function getTipoDocs()
    {
        $tipos = TipoDoc::where('estado', '=', '1')->get();

        return response()->json($tipos, 200);
    }
}
