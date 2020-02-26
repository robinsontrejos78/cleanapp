<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use App\devolucion;
use Carbon\Carbon;
use App\Ciudade;
use App\User;
use App\Role;
use App\userRole;
use App\Users_empresa;
use Auth;
use DB;



class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        // $this->middleware('auth');
    }

   public function create()
    {
        
        // $hoy = Carbon::now();
        // $hoy = $hoy->toDateTimeString();
        // $fecha = new Carbon('yesterday');
        // $fecha = $fecha->toDateString();

        $ciudades = DB::table('CIUDADES')
            ->select('CIU_IDCIUDAD', 'CIU_NOMBRE')
            ->get();        
       

        return view('inscripcion.formclient', compact('ciudades'));
    }

        public function store(Request $request)
    {
         // if (!Auth::user()->hasRole('Cliente')) return abort(403);

        $datosEvento=request()->except(['_token']);

        
        $user                    = new User();
        $user->name              = $request->get('nombres');
        $user->USR_APELLIDOS     = $request->get('apellidos');
        $user->USR_TIPODOCUMENTO = $request->get('tipodoc');
        $user->USR_DOCUMENTO     = $request->get('numerodoc');
        $user->USR_DIRECCION     = $request->get('direccion');
        $user->USR_TELEFONO      = $request->get('telefono');
        $user->USR_CELULAR       = $request->get('celularUsu');
        $user->USR_CIU_IDCIUDAD  = $request->get('city');
        $user->email             = $request->get('mail');
        $user->password          = bcrypt($request->get('passwordUsu'));
        $user->USR_ESTADO        = 1;
        $user->save();

        $id = DB::getPdo()->lastInsertId();


        $usuRol               = new userRole();
        $usuRol->user_id = $id;
        $usuRol->role_id = 4;//4 es el rol de cliente= crear ordenes de servicio
        $usuRol->save();

        $empresaUsu                     = new Users_empresa();
        $empresaUsu->USE_EMP_IDEMPRESA  = 1;
        $empresaUsu->USE_USR_id         = $id;
        $empresaUsu->save();
        
        // return "entro al controlador";

        // return redirect('/empresa')->with('message', 'Empresa creada con exito');
    }
}