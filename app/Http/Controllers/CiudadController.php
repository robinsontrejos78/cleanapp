<?php

namespace App\Http\Controllers;
use App\Http\Requests\createCiudadRequest;
use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ciudade;
use Auth;
use DB;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        $idEmpresa = Session::get('idEmpresa');

        $ciudades  = DB::table("CIUDADES")
            ->where('CIU_EMP_IDEMPRESA', $idEmpresa)
            ->get();

       

        return view('ciudades.index', compact('ciudades'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
      
        return view('ciudades.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createCiudadRequest $request)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        
        $idEmpresa = Session::get('idEmpresa');  //variable de sesión
     
        DB::table('CIUDADES')->insert(
            ['CIU_PAIS' => $request->get('nombrePais'),
             'CIU_NOMBRE' => $request->get('nombreCiu'), 
             'CIU_EMP_IDEMPRESA' => $idEmpresa, 
             'CIU_ESTADO' => 1]
        );



       return redirect('/ciudad')->with('message', 'Ciudad creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);     
        /*if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);*/

      $ciudadelas =  DB::table('CIUDADES')->where('CIU_NOMBRE', $request->nombreCiu)->first();
       /* , 'CIU_NOMBRE' => $request->nombreCiu*/
   
        return view('ciudades.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $idEmpresa = Session::get('idEmpresa');  //variable de sesión

        $ciudad = DB::table('CIUDADES')
            ->where('CIU_EMP_IDEMPRESA', $idEmpresa)
            ->where('CIU_IDCIUDAD', $id)
            ->first();
      
        if(!$ciudad) 
            return redirect('/ciudad')->with('messageE', 'Ciudad no encontrada. ERROR');

        return view('ciudades.edit', compact('ciudad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!Auth::user()->hasRole('Administrador')) abort(403);     
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        DB::table('CIUDADES')
            ->where('CIU_IDCIUDAD', $id)
            ->update(['CIU_PAIS'   => $request->nombrePais, 
                      'CIU_NOMBRE' => $request->nombreCiu]);

        return redirect('/ciudad')->with('message', 'Ciudad modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscarCiudad()
    {
        $s_nombreCiudad = $_POST['s_nombreCiudad'];
        $s_nombrePais   = $_POST['s_nombrePais'];
        $idEmpresa = Session::get('idEmpresa');

        $busqueda = array();

        $s_nombreCiudad  ? $busqueda += array(0 => array('CIU_NOMBRE', 'LIKE', '%'.$s_nombreCiudad.'%')) : null;
        $s_nombrePais    ? $busqueda += array(1 => array('CIU_PAIS', 'LIKE', '%'.$s_nombrePais.'%')) : null;

        $resultados = DB::table('CIUDADES')
            ->where('CIU_EMP_IDEMPRESA', $idEmpresa)
            ->where($busqueda)
            ->get();

        return view('ciudades.ajax.buscar', compact('resultados'));
    }

    public function cambioEstadoCiudades()
    {
        $id = $_POST['id'];
        $estado = $_POST['estado'];

        DB::table('CIUDADES')->where('CIU_IDCIUDAD', $_POST['id'])->update(['CIU_ESTADO' => $_POST['estado']]);
    }
}
