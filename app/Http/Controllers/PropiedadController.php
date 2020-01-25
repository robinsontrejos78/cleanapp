<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\StorePropiedad;
use App\Http\Requests;
use App\Propiedade;
use Auth;
use DB;

class PropiedadController extends Controller
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

        if (Auth::user()->hasRole('Administrador'))
        {
        $propiedades = Propiedade::join('CIUDADES', 'CIU_IDCIUDAD', '=', 'PRO_CIU_IDCIUDAD')
            ->where('PRO_EMP_IDEMPRESA', Session::get('idEmpresa'))
            ->get();
         }
    
        if (Auth::user()->hasRole('Adminciudades'))
        {
          $propiedades = Propiedade::join('CIUDADES', 'CIU_IDCIUDAD', '=', 'PRO_CIU_IDCIUDAD')
            //->where('PRO_EMP_IDEMPRESA', Session::get('idEmpresa'))
            ->get();
        }
        
        return view('Propiedades.index', compact('propiedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $ciudades = DB::table('CIUDADES')
            ->select('CIU_IDCIUDAD', 'CIU_NOMBRE')
            ->where('CIU_EMP_IDEMPRESA', Session::get('idEmpresa'))
            ->get();

        return view('propiedades.create', compact('ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropiedad $request)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $propiedad = new Propiedade();
        $propiedad->PRO_NOMBRE        = $request->get('nombre');
        $propiedad->PRO_EMP_IDEMPRESA = Session::get('idEmpresa');
        $propiedad->PRO_CIU_IDCIUDAD  = $request->get('ciudad');
        $propiedad->Save();

        return redirect('propiedad')->with('message', 'La Propiedad ha sido creada');
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

        $propiedad = Propiedade::find($id);

        if(!$propiedad)
            return redirect('propiedad')->with('messageE', 'Propiedad no encontrada');

        $ciudades = DB::table('CIUDADES')
            ->where('CIU_EMP_IDEMPRESA', Session::get('idEmpresa'))
            ->select('CIU_IDCIUDAD', 'CIU_NOMBRE')
            ->get();

        return view('propiedades.edit', compact('propiedad', 'ciudades'));
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
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $propiedad = Propiedade::find($id);
        $propiedad->PRO_NOMBRE        = $request->get('nombre');
        $propiedad->PRO_CIU_IDCIUDAD  = $request->get('ciudad');
        $propiedad->save();

        return redirect('propiedad')->with('message', 'La Propiedad ha sido Modificada');
    }

    public function estadoPropiedad()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $id      = $_POST["id"];
        $estado  = $_POST["estado"];

        $EstadoP = Propiedade::where('PRO_IDPROPIEDAD', '=', $id)->update(['PRO_ESTADO' => $estado]);
    }
}
