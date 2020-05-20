<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','getmedicamentos']]);
    }


    public function register(Request $request)
    {
        $ufletter = substr($request->nombre, 0, 1) ;
        $checkuser = strtoupper($ufletter.$request->apellido);

        $query = count(DB::table('users')->where('usuario', '=', $checkuser)
            ->orWhere('documento', '=', $request->documento)->get());

        if ($query) {
            return response()->json(['msj' => 'Ya existe un usuario con cedula: '.$request->documento.', con el usuario: '.$checkuser. ' o email: '.$request->email]);
        }

        $v = $request->validate([
            'id_tipodoc' => 'required',
            'documento' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->nombre = strtoupper($request->nombre);
        $user->apellido = strtoupper($request->apellido);
        $user->usuario = strtoupper($ufletter.$request->apellido);
        $user->id_tipodoc = $request->id_tipodoc;
        $user->documento = $request->documento;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_rol = $request->id_rol;
        $user->estado = 1;
        $user->created_at = date('Y-d-m H:i:s');
        $user->updated_at = date('Y-d-m H:i:s');

        if ($user->save()) {
            return response()->json(['user' => $user]);
        }
    }
}
