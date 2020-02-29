<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use \Eventviva\ImageResize;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use DB;

class OrdenpersonaController extends Controller
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
        if (!Auth::user()->hasRole('Profesional')) abort(403);

        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        //dd($idPersona);

        $ordenes = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_CLI', '=', 'users.id')
            ->where('ORD_USR_ID', $idPersona)
            ->whereBetween('ORD_LOO_ESTADOORDEN', [1, 2])
            ->get();

            // dd($ordenes);

        return view('ordenpersona.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comenzarOrden($ido)
    {
        if (!Auth::user()->hasRole('Profesional')) abort(403);
        if (!filter_var($ido, FILTER_VALIDATE_INT)) abort(404);

        $idEmpresa = Session::get('idEmpresa');
        $fecha = Carbon::now();
        

        $orden = DB::table('ORDEN_SERVICIOS')
            ->join('LOOKUP', 'ORD_LOO_TIPOORDEN', '=', 'LOO_IDLOOKUP')
            ->where('LOO_GRUPO', 1)
            ->where('ORD_IDORDEN', $ido)
            ->first();


        $tipo = $orden->ORD_LOO_TIPOORDEN;
      // dd($tipo);

        DB::table('ORDEN_SERVICIOS')->where('ORD_IDORDEN', $ido)->update(['ORD_LOO_ESTADOORDEN' => 2, 'ORD_INICIOORDEN' => $fecha]);
        return view('ordenpersona.atenderOrden', compact('orden', 'tipo', 'inventarios'));
    }

    public function guardarEvidencias(Request $request)
    {
        if (!Auth::user()->hasRole('Profesional')) abort(403);

        $s_name = $_POST['fname'];
        $i_idor = $_POST['idor'];
        $s_desc = $_POST['s_desc'];
        //$i_step = $_POST['i_step'];
        $i_tipo = $_POST['i_tipo'];
        $time   = time();
        $s_name = $time."_".$s_name;

        $filename = "image/evidencias/".$s_name;

        $data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
        $decodedData = base64_decode($data);
        
     
        $fp = fopen($filename, 'wb');
        fwrite($fp, $decodedData);
        fclose($fp);
        
        DB::table('EVIDENCIAS')
            ->insert(['EVI_ORD_IDORDEN' => $i_idor, 
                      'EVI_DESCRIPCION' => $s_desc, 
                      'EVI_IMAGEN'      => $s_name,
                      'EVI_LOO_TIPO'    => $i_tipo,
                      //'EVI_STEP'        => $i_step
                   ]);


    }

    public function finalizarOrdenes($idor)
    {
        if (!Auth::user()->hasRole('Profesional')) abort(403);
        if (!filter_var($idor, FILTER_VALIDATE_INT)) abort(404);

        $fecha = Carbon::now();

        DB::table('ORDEN_SERVICIOS')->where('ORD_IDORDEN', $idor)->update(['ORD_LOO_ESTADOORDEN' => 3, 'ORD_FINORDEN' => $fecha]);

        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');


        $ordenes = DB::table('ORDEN_SERVICIOS')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->join('PROPIEDADES', 'PRO_IDPROPIEDAD', '=', 'INM_PRO_IDPROPIEDAD')
            ->where('ORD_USR_ID', $idPersona)
            ->whereBetween('ORD_LOO_ESTADOORDEN', [1, 2])
            ->get();
        
        return view('ordenpersona.index', compact('ordenes'));
    }

public function calificarorden()
    {
        if (!Auth::user()->hasRole('Profesional')) abort(403);
        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

         $calif    = $_POST['calif'];
         $obser    = $_POST['obser'];
         $dataord  = $_POST['dataord'];
         $dataruta = $_POST['dataruta'];


        $fecha   = Carbon::now();

//dd($fecha);

        // $ordenes = DB::table('ORDEN_SERVICIOS')
        //     ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
        //     ->join('PROPIEDADES', 'PRO_IDPROPIEDAD', '=', 'INM_PRO_IDPROPIEDAD')
        //     ->where('ORD_USR_ID', $idPersona)
        //     ->whereBetween('ORD_LOO_ESTADOORDEN', [1, 2])
        //     ->get();

            DB::table('CALIFICACIONES')->insert(
            ['CAL_IDUSERPROF'    => $idPersona,
             'CAL_IDUSERCLIENTE' => $dataruta,
             'CAL_observacion'   => $obser, 
             'CAL_calificacion'  => $calif, 
             'CAL_fecharegistro' => $fecha,
             'CAL_ORD_IDORDEN'   => $dataord
             ]
            ); 

             DB::table('ORDEN_SERVICIOS')->where('ORD_IDORDEN', $dataord)->update(['ORD_LOO_ESTADOORDEN' => 3, 'ORD_FINORDEN' => $fecha]);
       
        $ordenes = DB::table('ORDEN_SERVICIOS')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->join('PROPIEDADES', 'PRO_IDPROPIEDAD', '=', 'INM_PRO_IDPROPIEDAD')
            ->join('users', 'ORD_USR_CLI', '=', 'users.id')
            ->where('ORD_USR_ID', $idPersona)
            ->whereBetween('ORD_LOO_ESTADOORDEN', [1, 2])
            ->get();

        return ('listo');
    }


    public function novedadCheckin()
    {
        if (!Auth::user()->hasRole('Profesional')) abort(403);

        $i_idOrden = $_POST['i_idOrden'];

        return view('ordenpersona.ajax.modalNovedadCheckin', compact('i_idOrden'));
    }

    public function guardarNovedades()
    {
        if (!Auth::user()->hasRole('Profesional')) abort(403);

        $s_desc = $_POST['s_desc'];
        $i_tipo = $_POST['i_tipo'];
        $i_idor = $_POST['i_idor'];
        $s_name = $_POST['fname'];
        $time   = time();
        $s_name = $time."_".$s_name;

        $idor = $_POST['idor'];
        $filename = "image/novedades/".$s_name;

        $data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
        $decodedData = base64_decode($data);
        
        $fp = fopen($filename, 'wb');
        fwrite($fp, $decodedData);
        fclose($fp);

        DB::table('NOVEDADES')->insert([
                'NOV_ORD_IDORDEN'      => $i_idor, 
                'NOV_DESCRIPCION'      => $s_desc, 
                'NOV_IMAGEN'           => $s_name,
                'NOV_LOO_TIPONOVEDAD'  => $i_tipo
            ]);
    }

    public function continuarOrdenes($idor)
    {
        $orden = DB::table('ORDEN_SERVICIOS')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
            ->join('LOOKUP', 'ORD_LOO_TIPOORDEN', '=', 'LOO_IDLOOKUP')
            ->where('LOO_GRUPO', 1)
            ->where('ORD_IDORDEN', $idor)
            ->first();
              


        $inventario = DB::table('LOOKUP')->select('LOO_DESCRIPCION')
              ->where('LOO_GRUPO', 6) 
              ->whereNotIn('LOO_DESCRIPCION', $prueba = DB::table('EVIDENCIAS')->select('EVI_STEP') 
              ->where('EVI_ORD_IDORDEN', $idor)) 
              ->get();
                    


        return view('ordenpersona.continuarOrdenAseo', compact('orden', 'inventario'));
    }

    public function checkoutOrdenes($idor)
    {
        $orden = DB::table('ORDEN_SERVICIOS')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
            ->join('LOOKUP', 'ORD_LOO_TIPOORDEN', '=', 'LOO_IDLOOKUP')
            ->where('LOO_GRUPO', 1)
            ->where('ORD_IDORDEN', $idor)
            ->first();

        $inventarioout = DB::table('LOOKUP')->select('LOO_DESCRIPCION')
              ->where('LOO_GRUPO', 7) 
              ->whereNotIn('LOO_DESCRIPCION', $prueba = DB::table('EVIDENCIAS')->select('EVI_STEP') 
              ->where('EVI_ORD_IDORDEN', $idor)) 
              ->get();


        return view('ordenpersona.checkout', compact('orden', 'inventarioout'));
    }

    public function ordenesSinPagar()
    
    {
        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $ordenSin = DB::table('ORDEN_SERVICIOS')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->where('ORD_USR_ID', $idPersona)
            ->where('ORD_PAGADO', 0)
            ->where('ORD_LOO_ESTADOORDEN', 3)
            ->get();

        return view('ordenpersona.sinPagar', compact('ordenSin'));
    }

        public function calificaciones()
    
    {
        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

   
$contador = DB::table('CALIFICACIONES')
                     ->select(DB::raw('round(AVG(CAL_calificacion),1) AS promedio'))
                     ->where('CAL_IDUSERCLIENTE', '=', $idPersona)
                     ->get();
                     
        $valoraciones = DB::table('CALIFICACIONES')
         ->join('users', 'CAL_IDUSERCLIENTE', '=', 'users.id')
         ->where('CAL_IDUSERCLIENTE', $idPersona)
         ->orderby('CAL_fecharegistro', 'desc')
         ->get();

        return view('ordenpersona.vercalificacion', compact('valoraciones','contador'));
    }


        public function historialorden()
    
    {
        $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

  
        // $historico = DB::table('ORDEN_SERVICIOS')
        //  ->join('users', 'CAL_IDUSERCLIENTE', '=', 'users.id')
        //  ->join('LOOKUP', 'ORD_LOO_ESTADOORDEN', '=', 'LOO_IDLOOKUP')
        //  ->where('CAL_IDUSERCLIENTE', $idPersona)
        //  ->orderby('CAL_fecharegistro', 'desc')
        //  ->get();

    $historico = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_CLI', '=', 'users.id')
            ->join('LOOKUP', 'ORD_LOO_ESTADOORDEN', '=', 'LOO_IDLOOKUP')
            ->where('ORD_USR_ID', $idPersona)
            ->where('LOO_GRUPO', 2)
            ->whereBetween('ORD_LOO_ESTADOORDEN', [2, 4])
            ->get();

        return view('ordenpersona.historial', compact('historico'));
    }
    

    public function guardarImagenNovedades(Request $request)
    {
        
        $idor = $_POST['idor'];
        $filename = "image/novedades/".$_POST["fname"];
        
        $data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
        // decode it
        $decodedData = base64_decode($data);
        
        $fp = fopen($filename, 'wb');
        fwrite($fp, $decodedData);
        fclose($fp);
    }
}