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

            $novedades  = DB::table("ORDEN_SERVICIOS")
                ->join('users', 'ORD_USR_ID', '=', 'users.id')
                ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
                ->where('ORD_LOO_ESTADOORDEN', '=', 3)
                ->select('ORD_IDORDEN', 'ORD_FECHAORDEN', 'ORD_INM_IDINMUEBLE', 'USR_TELEFONO', 'name', 'USR_APELLIDOS')
                ->get();
   // dd($novedades);
            // ->orderBy('ORD_FECHAORDEN', 'desc')
            // ->get();
                
            $contador = DB::table("ORDEN_SERVICIOS")
                ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
                ->where('ORD_LOO_ESTADOORDEN', 3)
                ->count();


            return view('home', compact('novedades', 'contador'));
        }

        if (Auth::user()->hasRole('Cliente'))
        {

           $profesionales = DB::table("users")
                ->select('id','name','USR_APELLIDOS','id','USR_foto')
                ->take(5)
                ->get();


            $inmuebles = DB::table("INMUEBLES")
                ->select('INM_IDINMUEBLE','INM_DIRECCION')
                ->where('INM_USR_IDUSER', Auth::user()->id)
                ->get();

                return view('home', compact('profesionales','inmuebles'));
        }        

        return view('home');
     
    }
}