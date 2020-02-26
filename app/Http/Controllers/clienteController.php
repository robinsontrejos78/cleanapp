<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use App\devolucion;
use Carbon\Carbon;
use App\Ciudade;
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
      /*  $this->middleware('auth');*/
    }
    public function index()
    {
     /*  if (!Auth::user()->hasRole('Administrador')) abort(403);
       $idEmpresa = Session::get('idEmpresa');
*/
        $hoy = Carbon::now();
        $hoy = $hoy->toDateTimeString();
        $fecha = new Carbon('yesterday');
        $fecha = $fecha->toDateString();

        $ciudades = DB::table('CIUDADES')
            ->select('CIU_IDCIUDAD', 'CIU_NOMBRE')
            ->where('CIU_EMP_IDEMPRESA', Session::get('idEmpresa'))
            ->get();

        return view('inscripcion.formclient', compact('ciudades'));

    }

        public function store(Request $request)
    {
         // if (!Auth::user()->hasRole('Cliente')) return abort(403);

        $datosEvento=request()->all();


        $user                    = new User();
        $user->name              = $request->get('nombres');
        $user->USR_APELLIDOS     = $request->get('apellidos');
        // $user->usr               = $request->get('tipodoc');
        $user->USR_DOCUMENTO     = $request->get('numerodoc');
        $user->USR_DIRECCION     = $request->get('direccion');
        $user->USR_TELEFONO      = $request->get('telefono');
        // $user->USR_CELULAR       = $request->get('celularUsu');
        $user->USR_CIU_IDCIUDAD  = $request->get('city');
        $user->email             = $request->get('mail');
        $user->password          = bcrypt($request->get('passwordUsu'));
        $user->USR_ESTADO        = 1;
        $user->save();

        $empr               = new Empresa();
        $empr->EMP_NOMBRE   = $request->get('nombreEmp');
        $empr->EMP_CONTACTO = $request->get('nombreCon');
        $empr->EMP_TELEFONO = $request->get('telefonoEmp');
        $empr->EMP_CORREO   = $request->get('emailCon');
        $empr->save();
        
        // return "entro al controlador";

        // return redirect('/empresa')->with('message', 'Empresa creada con exito');
    }
}