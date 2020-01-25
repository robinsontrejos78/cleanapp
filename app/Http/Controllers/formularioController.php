<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use App\devolucion;
use Carbon\Carbon;
use Auth;
use DB;



class formularioController extends Controller
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

   //dd($fecha);

        return view('inscripcion.formclient');

    }
   public function formprof()
    {
  /*     if (!Auth::user()->hasRole('Administrador')) abort(403);
       $idEmpresa = Session::get('idEmpresa');*/

        $hoy = Carbon::now();
        $hoy = $hoy->toDateTimeString();
        $fecha = new Carbon('yesterday');
        $fecha = $fecha->toDateString();

   //dd($fecha);

        return view('inscripcion.formprof');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createprof()
    {
    // if (!Auth::user()->hasRole('persona')) abort(403);
    //    $idEmpresa = Session::get('idEmpresa');

        $hoy = Carbon::now();
        $hoy = $hoy->toDateTimeString();
        $fecha = new Carbon('yesterday');
        $fecha = $fecha->toDateString();

         $nombresprof   = $_POST['nombresprof'];
         $apellidosprof = $_POST['apellidosprof'];
         $tipodocprof   = $_POST['tipodocprof'];
         $numdocprof    = $_POST['numdocprof'];
         $fnaciprof     = $_POST['fnaciprof'];
         $generoprof    = $_POST['generoprof'];
         $lugarnacprof  = $_POST['lugarnacprof'];
         $antigprof     = $_POST['antigprof'];
         $estcivilprof  = $_POST['estcivilprof'];
         $dirprof       = $_POST['dirprof'];
         $telprof       = $_POST['telprof'];
         $telresprof    = $_POST['telresprof'];
         $mailprof      = $_POST['mailprof'];
         $nivelprof     = $_POST['nivelprof'];
         $percarprof    = $_POST['percarprof'];
         $nomcon        = $_POST['nomcon'];
         $apecon        = $_POST['apecon'];
         $tipodoccon    = $_POST['tipodoccon'];
         $numerodoccon  = $_POST['numerodoccon'];
         $nombrefa      = $_POST['nombrefa'];
         $aperefa       = $_POST['aperefa'];
         $parentrefa    = $_POST['parentrefa'];
         $citirefa      = $_POST['citirefa'];
         $telrefa       = $_POST['telrefa'];
         $nomrefb       = $_POST['nomrefb'];
         $aperefb       = $_POST['aperefb'];
         $parentrefb    = $_POST['parentrefb'];
         $citirefb      = $_POST['citirefb'];
         $telrefb       = $_POST['telrefb'];
         $nomrefcoma    = $_POST['nomrefcoma'];
         $aperefcoma    = $_POST['aperefcoma'];
         $parentrefcoma = $_POST['parentrefcoma'];
         $citicoma      = $_POST['citicoma'];
         $telrefcoma    = $_POST['telrefcoma'];
         $nomrefcomb    = $_POST['nomrefcomb'];
         $aperefcomb    = $_POST['aperefcomb'];
         $parentrefcomb = $_POST['parentrefcomb'];
         $citicomb      = $_POST['citicomb'];
         $telrefcomb    = $_POST['telrefcomb'];
         $s_terminos    = $_POST['s_terminos'];
         $s_datos       = $_POST['s_datos'];


         $validar = DB::table('PROFESIONALES')->select('PRO_numdocprof')
            ->where('PRO_numdocprof', $numdocprof)
            ->exists();

      if ($validar != 'true'){


          DB::table('PROFESIONALES')->insert(
            ['PRO_fecharegistro' => $fecha,
             'PRO_nombresprof'   => $nombresprof,
             'PRO_apellidosprof' => $apellidosprof, 
             'PRO_tipodocprof'   => $tipodocprof, 
             'PRO_numdocprof'    => $numdocprof, 
             'PRO_fnaciprof'     => $fnaciprof, 
             'PRO_generoprof'    => $generoprof, 
             'PRO_lugarnacprof'  => $lugarnacprof, 
             'PRO_antigprof'     => $antigprof, 
             'PRO_estcivilprof'  => $estcivilprof, 
             'PRO_dirprof'       => $dirprof, 
             'PRO_telprof'       => $telprof, 
             'PRO_telresprof'    => $telresprof, 
             'PRO_mailprof'      => $mailprof, 
             'PRO_nivelprof'     => $nivelprof, 
             'PRO_percarprof'    => $percarprof, 
             'PRO_nomcon'        => $nomcon,
             'PRO_apecon'        => $apecon,
             'PRO_tipodoccon'    => $tipodoccon,
             'PRO_numerodoccon'  => $numerodoccon,
             'PRO_nombrefa'      => $nombrefa,
             'PRO_aperefa'       => $aperefa,
             'PRO_parentrefa'    => $parentrefa,
             'PRO_citirefa'      => $citirefa,
             'PRO_telrefa'       => $telrefa,
             'PRO_nomrefb'       => $nomrefb,
             'PRO_aperefb'       => $aperefb,
             'PRO_parentrefb'    => $parentrefb,
             'PRO_citirefb'      => $citirefb,
             'PRO_telrefb'       => $telrefb,
             'PRO_nomrefcoma'    => $nomrefcoma,
             'PRO_aperefcoma'    => $aperefcoma,
             'PRO_parentrefcoma' => $parentrefcoma,
             'PRO_citicoma'      => $citicoma,
             'PRO_telrefcoma'    => $telrefcoma,
             'PRO_nomrefcomb'    => $nomrefcomb,
             'PRO_aperefcomb'    => $aperefcomb,
             'PRO_parentrefcomb' => $parentrefcomb,
             'PRO_citicomb'      => $citicomb,
             'PRO_telrefcomb'    => $telrefcomb,
             'PRO_terminos'      => $s_terminos,
             'PRO_datos'         => $s_datos
             ]
            );
         return with("Te Has Registrado con Éxito, Uno de Nuestros Asesores se Contactará Pronto");


           }else 
           {
               return with("El Documento Ya Se Encuentra Registrado");
           }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $hoy = Carbon::now();
        $hoy = $hoy->toDateTimeString();


     
    return with($s_nombres);
               // return view('ventas.ajax.buscar', compact('datos', 'validar','Saldo'));

 
    }
    
     public function mostrarprof()
    {

     if (!Auth::user()->hasRole('Administrador')) abort(403);
       $idEmpresa = Session::get('idEmpresa');


  $contador = DB::select('select COUNT(PRO_numdocprof) as total FROM PROFESIONALES as t1 WHERE NOT EXISTS (SELECT NULL FROM users as t2 WHERE t2.USR_DOCUMENTO = t1.PRO_numdocprof)');
              
       return view('users.mostrarprof', compact('contador'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show()
    {
     return view('ventas.datos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showterminos()
    {
       return view('inscripcion.termcondition');
    }
     public function showhabeas()
    {
       return view('inscripcion.habeasdata');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrardatosprof()
    {
     if (!Auth::user()->hasRole('Administrador')) abort(403);
       $idEmpresa = Session::get('idEmpresa');
      
         $fechaprof  = $_POST['fechaprof'];
         $docuprof   = $_POST['docuprof'];
         $nombreprof = $_POST['nombreprof'];

            
    $busqueda = array();

        $fechaprof    ? $busqueda += array(2 => array('PRO_fecharegistro', 'LIKE', '%'.$fechaprof.'%')) : null;
        $docuprof     ? $busqueda += array(3 => array('PRO_numdocprof', 'LIKE', '%'.$docuprof.'%')) : null;
        $nombreprof   ? $busqueda += array(4 => array('PRO_nombresprof', 'LIKE', '%'.$nombreprof.'%')) : null;
     

     $resultados =  DB::table('PROFESIONALES')
                    ->where($busqueda)
                    ->orderby('PRO_fecharegistro', 'desc')
                    ->get();

        return view('users.ajax.buscarinscprof', compact('resultados'));
    }

   
}