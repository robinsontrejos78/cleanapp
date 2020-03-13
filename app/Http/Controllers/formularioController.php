<?php

namespace App\Http\Controllers;

use App\Http\Requests\createprofesionalRequest;
use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use App\devolucion;
use Carbon\Carbon;
use App\Ciudade;
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
//     public function index()
//     {
//      /*  if (!Auth::user()->hasRole('Administrador')) abort(403);
//        $idEmpresa = Session::get('idEmpresa');
// */
//         $hoy = Carbon::now();
//         $hoy = $hoy->toDateTimeString();
//         $fecha = new Carbon('yesterday');
//         $fecha = $fecha->toDateString();

//         $ciudades = DB::table('CIUDADES')
//             ->select('CIU_IDCIUDAD', 'CIU_NOMBRE')
//             ->where('CIU_EMP_IDEMPRESA', Session::get('idEmpresa'))
//             ->get();

//         return view('inscripcion.formclient', compact('ciudades'));

//     }
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
         $planchar      = $_POST['planchar'];
         $cocinar       = $_POST['cocinar'];
         $nomcon        = $_POST['nomcon'];
         $apecon        = $_POST['apecon'];
         $tipodoccon    = $_POST['tipodoccon'];
         $numerodoccon  = $_POST['numerodoccon'];
         $nombrefa      = $_POST['nombrefa'];
         $aperefa       = $_POST['aperefa'];
         $parentrefa    = $_POST['parentrefa'];
         $citirefa      = $_POST['citirefa'];
         $telrefa       = $_POST['telrefa'];
         $nomrefcoma    = $_POST['nomrefcoma'];
         $aperefcoma    = $_POST['aperefcoma'];
         $parentrefcoma = $_POST['parentrefcoma'];
         $citicoma      = $_POST['citicoma'];
         $telrefcoma    = $_POST['telrefcoma'];
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
             'PRO_plancha'       => $planchar,
             'PRO_cocina'        => $cocinar,
             'PRO_nomcon'        => $nomcon,
             'PRO_apecon'        => $apecon,
             'PRO_tipodoccon'    => $tipodoccon,
             'PRO_numerodoccon'  => $numerodoccon,
             'PRO_nombrefa'      => $nombrefa,
             'PRO_aperefa'       => $aperefa,
             'PRO_parentrefa'    => $parentrefa,
             'PRO_citirefa'      => $citirefa,
             'PRO_telrefa'       => $telrefa,
             'PRO_nomrefcoma'    => $nomrefcoma,
             'PRO_aperefcoma'    => $aperefcoma,
             'PRO_parentrefcoma' => $parentrefcoma,
             'PRO_citicoma'      => $citicoma,
             'PRO_telrefcoma'    => $telrefcoma,
             'PRO_terminos'      => $s_terminos,
             'PRO_datos'         => $s_datos,
             'PRO_estado'        => 0
             ]
            );
         return with("Te Has Registrado con Éxito, Uno de Nuestros Asesores se Contactará Pronto");


           }else 
           {
               return with("El Documento Ya Se Encuentra Registrado");
           }
    }


    public function descartarins()
    {
      if (!Auth::user()->hasRole('Administrador')) abort(403);
       $idEmpresa = Session::get('idEmpresa');

         $data  = $_POST['data'];


// dd($data);
      DB::table('PROFESIONALES')
            ->where('id',$data)
            ->update(['PRO_estado' => 1]);
     
    return with("Se ha descartado la inscripción");
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
    }
    
     public function mostrarprof()
    {

     if (!Auth::user()->hasRole('Administrador')) abort(403);
       $idEmpresa = Session::get('idEmpresa');

     $resultados =  DB::table('PROFESIONALES')
                    ->where('PRO_estado', 0)
                    ->orderby('PRO_fecharegistro', 'desc')
                    ->get();


    $contador = DB::select('select COUNT(PRO_numdocprof) as total FROM PROFESIONALES as t1 where PRO_estado = 0 and NOT EXISTS (SELECT NULL FROM users as t2 WHERE t2.USR_DOCUMENTO = t1.PRO_numdocprof)');
              
       return view('users.mostrarprof', compact('contador', 'resultados'));
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
                    ->where('PRO_estado', 0)
                    ->orderby('PRO_fecharegistro', 'desc')
                    ->get();

        return view('users.ajax.buscarinscprof', compact('resultados', 'users'));
    }

   
}