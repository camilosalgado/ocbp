<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function getAllUsers()
    {
        return response()->json(DB::select('exec getAllUsers'));
    }

}
