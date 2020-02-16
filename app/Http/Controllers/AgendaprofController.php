<?php

namespace App\Http\Controllers;

use App\Http\Requests\createEmpresaRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\editEmpresaRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Empresa;
use Auth;
use DB;

class AgendaprofController extends Controller
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

    // public function index()
    // {
    //     if (!Auth::user()->hasRole('Cliente')) abort(403);

    //     return "vista de agenda";

    //     $idEmpresa = Session::get('idEmpresa');
    //     $empresas = DB::table('EMPRESAS')->where('EMP_IDEMPRESA', '!=', $idEmpresa)->get();

    //     return view('empresas.index', compact('empresas'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     if (!Auth::user()->hasRole('SuperAdmin')) abort(403);

    //     return view('empresas.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(createEmpresaRequest $request)
    // {
    //     if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);
        
    //     $empr               = new Empresa();
    //     $empr->EMP_NOMBRE   = $request->get('nombreEmp');
    //     $empr->EMP_CONTACTO = $request->get('nombreCon');
    //     $empr->EMP_TELEFONO = $request->get('telefonoEmp');
    //     $empr->EMP_CORREO   = $request->get('emailCon');
    //     $empr->save();

    //     return redirect('/empresa')->with('message', 'Empresa creada con exito');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasRole('Cliente')) abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $profesional = DB::table('profesionales')->where('id', $id)->first();

        // if (!$empresa)
        //     return redirect('/empresa')->with('messageE', 'Empresa no encontrada. ERROR');

        return view('agendaProf.edit', compact('profesional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editAgendaRequest $request, $id)
    {
        if (!Auth::user()->hasRole('SuperAdmin')) abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $edit = Empresa::where('EMP_IDEMPRESA', '=', $id)
        ->update(array(
            'EMP_NOMBRE'     => $request['nombreEmp'], 
            'EMP_CONTACTO'   => $request['nombreCon'], 
            'EMP_TELEFONO'   => $request['telefonoEmp'], 
            'EMP_CORREO'     => $request['emailCon']));

        return redirect('/empresa')->with('message', 'Empresa Modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarAgenda()
    {
        if (!Auth::user()->hasRole('SuperAdmin')) abort(403);

        $s_nombreEmpresa = $_POST['s_nombreEmpresa'];
        $s_nombreContacto = $_POST['s_nombreContacto'];
        $s_correoElectronico = $_POST['s_correoElectronico'];
        $idEmpresa = Session::get('idEmpresa');

        $busqueda = array();

        $s_nombreEmpresa     ? $busqueda += array(0 => array('EMP_NOMBRE', 'LIKE', '%'.$s_nombreEmpresa.'%')) : null;
        $s_nombreContacto    ? $busqueda += array(1 => array('EMP_CONTACTO', 'LIKE', '%'.$s_nombreContacto.'%')) : null;
        $s_correoElectronico ? $busqueda += array(2 => array('EMP_CORREO', 'LIKE', '%'.$s_correoElectronico.'%')) : null;

        $buscarEmp = DB::table('EMPRESAS')->where($busqueda)->where('EMP_IDEMPRESA', '!=', $idEmpresa)->get();

        return view('empresas.ajax.buscar', compact('buscarEmp'));
    }

    public function cambioEstadoAgenda()
    {
        if (!Auth::user()->hasRole('SuperAdmin')) abort(403);
        
        $id      = $_POST["id"];
        $estado  = $_POST["estado"];

        $cambioE = Empresa::where('EMP_IDEMPRESA', '=', $id)->update(array('EMP_ESTADO' => $estado));
    }
}
