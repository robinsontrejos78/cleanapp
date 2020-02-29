<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use DB;

class CalificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       if (!Auth::user()->hasRole('Administrador')) return abort(403);
        
          $nomb =  DB::table('users')
                    ->join('role_user', 'user_id', '=', 'users.id')
                    ->where('role_id', '=', 3)
                    ->get();

             // dd($nomb);      
        return view('calificaciones.consultaprof', compact('nomb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarcalifprof()
    {
       
       if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $id_usuario = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');


         $nombreUsu   = $_POST['nombreUsu'];
         
    $contador = DB::table('CALIFICACIONES')
                     ->select(DB::raw('round(AVG(CAL_calificacion),1) AS promedio'))
                     ->where('CAL_IDUSERPROF', '=', $nombreUsu)
                     ->get();

    $busqueda = array();

        $nombreUsu    ? $busqueda += array(2 => array('CAL_IDUSERPROF', 'LIKE', '%'.$nombreUsu.'%')) : null;
     

     $resultados =  DB::table('users')
                    ->join('CALIFICACIONES', 'users.id', '=', 'CAL_IDUSERCLIENTE')
                    ->join('role_user', 'user_id', '=', 'CAL_IDUSERCLIENTE')
                    ->where('role_id', '=', 4)
                    ->where($busqueda)
                    ->orderby('CAL_fecharegistro', 'desc')
                    ->get();
        
        return view('calificaciones.ajax.califprof', compact('resultados', 'contador'));


    }

 public function calificarcliente()
    {
        
       if (!Auth::user()->hasRole('Administrador')) return abort(403);
        
          $nomb =  DB::table('users')
                    ->join('role_user', 'user_id', '=', 'users.id')
                    ->where('role_id', '=', 4)
                    ->get();

        return view('calificaciones.consultacliente', compact('nomb'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mostrarcalcli()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

    $id_usuario = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');


         $nombreUsucli = $_POST['nombreUsucli'];
         // $docucli      = $_POST['docucli'];
         
         
    $contador = DB::table('CALIFICACIONES')
                     ->select(DB::raw('round(AVG(CAL_calificacion),1) AS promedio'))
                     ->where('CAL_IDUSERPROF', '=', $nombreUsucli)
                     ->get();

    $busqueda = array();

        $nombreUsucli  ? $busqueda += array(0 => array('CAL_IDUSERCLIENTE', 'LIKE', '%'.$nombreUsucli.'%')) : null;
        // $docucli       ? $busqueda += array(1 => array('USR_DOCUMENTO', 'LIKE', '%'.$docucli.'%')) : null;
     

     $resultados =  DB::table('users')
                    ->join('CALIFICACIONES', 'users.id', '=', 'CAL_IDUSERPROF')
                    ->join('role_user', 'user_id', '=', 'CAL_IDUSERPROF')
                    ->where('role_id', '=', 3)
                    ->where($busqueda)
                    ->orderby('CAL_fecharegistro', 'desc')
                    ->get();
              

        return view('calificaciones.ajax.califcliente', compact('resultados', 'contador'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePropiedad $request, $id)
    {
      
    }

    public function estadoPropiedad()
    {
    }
}
