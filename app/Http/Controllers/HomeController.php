<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $idEmpresa = Session::get('idEmpresa');

        if (Auth::user()->hasRole('Administrador'))
        {

            $novedades  = DB::table("NOVEDADES")
                ->join('ORDEN_SERVICIOS', 'ORD_IDORDEN', '=', 'NOV_ORD_IDORDEN')
                ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
                ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
                ->join('users', 'ORD_USR_ID', '=', 'id')
                ->join('LOOKUP', 'LOO_IDLOOKUP', '=', 'NOV_LOO_TIPONOVEDAD')
                ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
                ->where('LOO_GRUPO', '=', 4)
                ->where('NOV_ESTADO', 0)
                ->select('NOV_IDNOVEDAD', 'LOO_DESCRIPCION', 'NOV_DESCRIPCION', 'ORD_FECHAORDEN', 'INM_DIRECCION', 'INM_PROPIETARIO', 'INM_TELEFONO', 'name', 'USR_APELLIDOS', 'PRO_NOMBRE')
                ->get();

                
            $contador = DB::table("NOVEDADES")
                ->join('ORDEN_SERVICIOS', 'ORD_IDORDEN', '=', 'NOV_ORD_IDORDEN')
                ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
                ->where('NOV_ESTADO', 0)
                ->count();


            return view('home', compact('novedades', 'contador'));
        }

        if (Auth::user()->hasRole('Cliente'))
        {

           $profesionales = DB::table("PROFESIONALES")
                ->select('PRO_nombresprof','PRO_apellidosprof','PRO_numdocprof','id','PRO_foto')
                ->get();

                return view('home', compact('profesionales'));
        }        

        return view('home');
     
    }
}