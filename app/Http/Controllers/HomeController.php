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
                ->join('users', 'ORD_USR_CLI', '=', 'users.id')
                ->join('role_user', 'ORD_USR_CLI', '=', 'user_id')
                ->where('role_id', '=', 4)
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


        // $foto = DB::table('users')
        //     ->where('id', $idPersona)
        //     ->select('USR_foto')
        //     ->get();

            $inmuebles = DB::table("INMUEBLES")
                ->select('INM_IDINMUEBLE','INM_DIRECCION')
                ->where('INM_USR_IDUSER', Auth::user()->id)
                ->get();


                return view('home', compact('profesionales','inmuebles', 'foto'));
        } 

       if (Auth::user()->hasRole('Profesional'))
        {

        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $foto = DB::table('users')
            ->where('id', $idPersona)
            ->select('name','USR_APELLIDOS','USR_foto')
            ->get();


                return view('home', compact('foto'));
        }        

        return view('home');
     
    }
}