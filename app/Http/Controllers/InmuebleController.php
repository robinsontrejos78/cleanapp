<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\StoreInmueble;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Inmueble;
use Auth;
use DB;

class InmuebleController extends Controller
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
    public function index($id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $inmuebles = DB::table('INMUEBLES')
            ->join('LOOKUP', 'INM_LOO_TIPO', '=', 'LOO_IDLOOKUP')
            ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
            ->select('LOO_DESCRIPCION', 'INM_ESTADO', 'INM_DIRECCION', 'INM_IDINMUEBLE', 'PRO_NOMBRE')
            ->where([
                        ['LOO_GRUPO', 3],['INM_PRO_IDPROPIEDAD', $id]
                    ])
            ->get();

        return view('Inmuebles.index', compact('inmuebles', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $tipos = DB::table('LOOKUP')->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->where('LOO_GRUPO', 3)->get();
        
        return view('inmuebles.create', compact('tipos', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInmueble $request, $id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $id_usuario = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $inmueble = new Inmueble();
        $inmueble->INM_USR_IDUSER      = $id_usuario;
        $inmueble->INM_PRO_IDPROPIEDAD = $request->get('id_propiedad');
        $inmueble->INM_LOO_TIPO        = $request->get('tipo_Inm');
        $inmueble->INM_DIRECCION       = $request->get('direccion');
        $inmueble->INM_PROPIETARIO     = $request->get('nombre');
        $inmueble->INM_TELEFONO        = $request->get('telefono');
        $inmueble->INM_EMAIL           = $request->get('email');
        $inmueble->save();

        return redirect('inmueble_index/'.$id)->with('message', 'El Inmueble se ha Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);
        
        $inmueble = DB::table('INMUEBLES')
                ->join('LOOKUP', 'INM_LOO_TIPO', '=', 'LOO_IDLOOKUP')
                ->join('users', 'INM_USR_IDUSER', '=', 'users.id')
                ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
                ->select('PRO_NOMBRE', 'LOO_DESCRIPCION', 'INM_DIRECCION', 'INM_PROPIETARIO', 'INM_TELEFONO', 'INM_EMAIL', 'INM_ESTADO', 'users.name')
                ->where([
                    ['INM_IDINMUEBLE', $id],
                    ['LOO_GRUPO', 3]
                ])
                ->first();

        return view('inmuebles.show', compact('inmueble'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $idpropiedad)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idpropiedad, FILTER_VALIDATE_INT)) abort(404);

        $tipos = DB::table('LOOKUP')->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->where('LOO_GRUPO', 3)->get();
        $inmueble = Inmueble::find($id);

        return view('inmuebles.edit', compact('inmueble', 'tipos', 'idpropiedad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idpropiedad)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idpropiedad, FILTER_VALIDATE_INT)) abort(404);
        
        $inmueble = Inmueble::find($id);
        $inmueble->INM_LOO_TIPO    = $request->get('tipo_Inm');
        $inmueble->INM_DIRECCION   = $request->get('direccion');
        $inmueble->INM_PROPIETARIO = $request->get('nombre');
        $inmueble->INM_TELEFONO    = $request->get('telefono');
        $inmueble->INM_EMAIL       = $request->get('email');
        $inmueble->save();

        return redirect('inmueble_index/'.$idpropiedad)->with('message', 'El Inmueble ha sido Modificado');
    }

    public function estadoInmueble()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $id      = $_POST["id"];
        $estado  = $_POST["estado"];

        $EstadoP = Inmueble::where('INM_IDINMUEBLE', '=', $id)->update(['INM_ESTADO' => $estado]);
    }
}
