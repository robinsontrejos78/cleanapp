<?php

namespace App\Http\Controllers;
use App\Http\Requests\createCiudadRequest;
use Illuminate\Support\Facades\Session;    //variable de sessión
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ciudade;
use Auth;
use DB;

class ReportesinventarioController extends Controller
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

        $propiedades  = DB::table("PROPIEDADES")
            ->get();


         $articulo = DB::table("ARTICULOS")
        ->get();

            

        return view('reportes.indexinventario', compact('propiedades', 'articulo', 'ciudad'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
      

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

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function articulo_edit($id, $idProp, $idInm)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
   

       return view('reportes.editararticulo', compact('id', 'idProp', 'idInm'));
    }

    public function buscarInventario()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);

          $idEmpresa = Session::get('idEmpresa');
  

        $s_propiedades  = $_POST["s_propiedades"];
        $s_articulos    = $_POST["s_articulos"];


        $articulo = DB::table("INVENTARIOS")
        ->select('INV_IDINVENTARIO', 'INV_INM_IDINMUEBLE', 'INV_ART_IDARTICULO', 'INM_PRO_IDPROPIEDAD', 'INV_CANTIDAD', 'ART_NOMBRE', 'PRO_NOMBRE', 'INM_DIRECCION')
        ->join('ARTICULOS', 'INV_ART_IDARTICULO', '=', 'ART_IDARTICULO')
        ->join('INMUEBLES', 'INM_IDINMUEBLE', '=', 'INV_INM_IDINMUEBLE')
        ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
        ->where('INM_PRO_IDPROPIEDAD', $s_propiedades)
        ->orWhere('INV_ART_IDARTICULO', $s_articulos)
        ->orWhere([
            ['INM_PRO_IDPROPIEDAD', $s_propiedades],
            ['INV_ART_IDARTICULO', $s_articulos],
        ])
        ->where('ART_ESTADO',1)
        ->where('INV_ESTADO',1)
        ->where('INM_ESTADO',1)
        ->where('PRO_ESTADO',1)
        ->get();
               
               //dd($articulo);
       

        return view('reportes.ajax.buscar', compact('articulo'));

    } 
     public function reporte_index()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        $idEmpresa = Session::get('idEmpresa');

         $ciudad = DB::table("CIUDADES")
        ->get();

         $propiedades  = DB::table("PROPIEDADES")
        ->get();


        $articulo = DB::table("ARTICULOS")
        ->get();


        return view('reportes.indexreporte', compact('propiedades', 'articulo', 'ciudad'));

    }
       public function buscareporte()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        $idEmpresa = Session::get('idEmpresa');
       

         $s_busCiu  = $_POST['s_busCiu'];
         $s_busProp = $_POST['s_busProp'];
         $s_busArt  = $_POST['s_busArt'];

        $opcion_bus = array();
        $s_busCiu ? $opcion_bus += array(0 => array('CIU_IDCIUDAD', '=', $s_busCiu) ) : null;
        $s_busProp ? $opcion_bus += array(0 => array('INM_PRO_IDPROPIEDAD', '=', $s_busProp) ) : null;
        $s_busArt ? $opcion_bus += array(0 => array('INV_ART_IDARTICULO', '=', $s_busArt) ) : null;
        


    $totales=DB::table("INVENTARIOS")
        ->select(DB::raw('count(INV_CANTIDAD) as cantidad'), DB::raw('SUM(INV_CANTIDAD) as unidades, CIU_NOMBRE, PRO_NOMBRE'))
        ->distinct('CIU_NOMBRE', 'PRO_NOMBRE')
        ->join( 'ARTICULOS','INV_ART_IDARTICULO','=','ART_IDARTICULO')
        ->join( 'INMUEBLES','INM_IDINMUEBLE','=','INV_INM_IDINMUEBLE')
        ->join( 'PROPIEDADES','INM_PRO_IDPROPIEDAD','=','PRO_IDPROPIEDAD')
        ->join( 'CIUDADES','PRO_CIU_IDCIUDAD','=','CIU_IDCIUDAD')
        ->where([[$opcion_bus],])
        ->where('ART_ESTADO',1)
        ->where('INV_ESTADO',1)
        ->where('INM_ESTADO',1)
        ->where('PRO_ESTADO',1)
        ->groupBy('CIU_NOMBRE', 'PRO_NOMBRE')
        ->get();

        //dd($totales);

         $resultados=DB::table("INVENTARIOS")
        ->select('INV_IDINVENTARIO','INV_INM_IDINMUEBLE','INV_ART_IDARTICULO','INM_PRO_IDPROPIEDAD',
        'INV_CANTIDAD','ART_NOMBRE','PRO_NOMBRE','INM_DIRECCION','CIU_IDCIUDAD','CIU_NOMBRE') 
        ->join( 'ARTICULOS','INV_ART_IDARTICULO','=','ART_IDARTICULO')
        ->join( 'INMUEBLES','INM_IDINMUEBLE','=','INV_INM_IDINMUEBLE')
        ->join( 'PROPIEDADES','INM_PRO_IDPROPIEDAD','=','PRO_IDPROPIEDAD')
        ->join( 'CIUDADES','PRO_CIU_IDCIUDAD','=','CIU_IDCIUDAD')
        ->where([[$opcion_bus],])
        ->where('ART_ESTADO',1)
        ->where('INV_ESTADO',1)
        ->where('INM_ESTADO',1)
        ->where('PRO_ESTADO',1)
        ->get();


        return view('reportes.ajax.reporte', compact('resultados','totales'));

    }
}