<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function getRoles()
    {
        $roles = Role::where('estado', '=', '1')->get();

        return response()->json($roles, 200);
    }
}
