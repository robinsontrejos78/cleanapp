<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\createOrdenRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use Auth;
use Mail;
use DB;

class OrdenController extends Controller
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
        $estadosO = DB::table('LOOKUP')->where('LOO_GRUPO', 2)->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->get();

        $personas = Db::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->where('USE_EMP_IDEMPRESA', $idEmpresa)
            ->wherenotnull('USR_LOO_TIPO')
            ->select('id', 'name', 'USR_APELLIDOS')
            ->get();

        $ordenServicio = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_ID', '=', 'users.id')
            ->join('LOOKUP as c', 'c.LOO_IDLOOKUP', '=', 'ORD_LOO_ESTADOORDEN')
            ->where('ORD_LOO_ESTADOORDEN', '!=', 4)
            ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
            ->where('ORD_PAGADO', 0)
            ->where('c.LOO_GRUPO', 2)
            ->select('ORDEN_SERVICIOS.*', 'users.name', 'email', 'USR_APELLIDOS', 'ORD_INM_IDINMUEBLE', 'USR_DOCUMENTO',  'c.LOO_DESCRIPCION as estado_orden', 'ORD_PAGADO')
            ->orderBy('ORD_FECHAORDEN', 'desc')
            ->get();
    //dd($ordenServicio);
 
       // $ordencli = DB::table('users')
       //      ->join('role_user', 'users.id', '=', 'user_id')
       //      ->join('ORDEN_SERVICIOS', 'users.id', '=', 'ORD_USR_CLI')
       //      ->where('role_id', 4)
       //      ->select('users.name', 'USR_APELLIDOS')
       //      ->get();

        return view('ordenes.index', compact('estadosO', 'personas', 'ordenServicio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);

        $idEmpresa = Session::get('idEmpresa');


        $cliente = DB::table('users')
            ->join('role_user', 'user_id', '=', 'users.id')
            ->where('role_id', 4)
            ->get();

        $profesional = DB::table('users')
           ->join('role_user', 'user_id', '=', 'users.id')
            ->where('role_id', 3)
            ->get();

        $tipoOrden = DB::table('LOOKUP')->where('LOO_GRUPO', 1)->where('LOO_IDLOOKUP', 1)->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->get();
        
        return view('ordenes.create', compact('tipoOrden', 'cliente', 'profesional'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createOrdenRequest $request)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);

        $fecha1 =  strtotime($_POST['Fecha']);
        $fecha = Carbon::now();
        $fecha = strtotime($fecha);

        if($fecha1 < $fecha){
            return redirect('/orden/create')->with('message', 'La fecha debe de ser superior a la fecha actual');
        }
        
        $idEmpresa = Session::get('idEmpresa');
        $fechaOrden = strftime('%Y-%m-%d %H:%M:%S', strtotime($_POST['Fecha']));

        DB::table('ORDEN_SERVICIOS')->insert(
                ['ORD_INM_IDINMUEBLE'  => $_POST['inmueble'], 
                 'ORD_EMP_IDEMPRESA'   => $idEmpresa, 
                 'ORD_USR_ID'          => $_POST['profesional'], 
                 'ORD_USR_CLI'         => $_POST['persona'], 
                 'ORD_LOO_ESTADOORDEN' => 1, 
                 'ORD_LOO_TIPOORDEN'   => $_POST['tipoOrden'],
                 'ORD_FECHAORDEN'      => $fechaOrden,
                 'ORD_PAGADO'          => 0,
                 'ORD_DESCRIPCION'     => $_POST['ordDesc'],
                 'ORD_COSTO'           => $_POST['costo']
            ]);

        $persona = DB::table('users')
            ->where('id', $_POST['persona'])
            ->select('email', 'name', 'USR_APELLIDOS')
            ->first();

        $inmueble = DB::table('INMUEBLES')
            ->where('INM_IDINMUEBLE', $_POST['inmueble'])
            ->select('INM_DIRECCION')
            ->first();

        $tipo = DB::table('LOOKUP')
            ->where('LOO_GRUPO', 1)
            ->where('LOO_IDLOOKUP', $_POST['tipoOrden'])
            ->select('LOO_DESCRIPCION')
            ->first();

        $fechaOrden = strftime('%Y-%B-%A %H:%M', strtotime($_POST['Fecha']));

        // $user = array('email'=>$persona->email, 'name'=>'eduardo');
        //               $data= array(
        //               'detail'    => 'Este mensaje es automático. Por favor no responder', 
        //               'costo'     => $_POST['costo'],
        //               'direccion' => $inmueble->INM_DIRECCION,
        //               'tipo'      => $tipo->LOO_DESCRIPCION,
        //               'fecha'     => $fechaOrden, 
        //               'name'      => $persona->name,
        //               'surname'   => $persona->USR_APELLIDOS);

        // Mail::send('emails.nuevaOrden', $data, function ($message) use ($user)
        // {
        // $message->from('ordendeservicio@conciergeguru.com', Session::get('nombreEmpresa'));
        // $message->to($user['email'], $user['name'])->subject('Nueva orden de servicio');
        // });

        return redirect('/orden')->with('message', 'Orden creada con exito. Se ha enviado e-mail de confirmación');
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

        $orden = DB::table('ORDEN_SERVICIOS')
            ->where('ORD_IDORDEN', $id)
            ->first();

        $idEmpresa = Session::get('idEmpresa');

        $profesional = DB::table('users')
           ->join('role_user', 'user_id', '=', 'users.id')
            ->where('role_id', 3)
            ->get();


        $temporal = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'id', '=', 'ORD_USR_ID')
            ->join('role_user', 'users.id', '=', 'user_id')
            ->select('ORD_LOO_TIPOORDEN', 'USR_CIU_IDCIUDAD', 'ORD_INM_IDINMUEBLE')
            ->where('ORD_IDORDEN', $id)
            ->first();



        $personas = DB::table('users')
            ->join('role_user', 'users.id', '=', 'user_id')
            // ->where('USR_CIU_IDCIUDAD', $temporal->USR_CIU_IDCIUDAD)
            // ->where('USR_LOO_TIPO', $temporal->ORD_LOO_TIPOORDEN)
            ->where('role_id', 3)
            ->select('id', 'name', 'USR_APELLIDOS')
            ->get();

        $tipoOrden = DB::table('LOOKUP')->where('LOO_GRUPO', 1)->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->get();

        return view('ordenes.edit', compact('orden', 'temporal', 'tipoOrden', 'personas', 'profesional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(createOrdenRequest $request, $id)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        $fechaOrden = strftime('%Y-%m-%d %H:%M:%S', strtotime($request->Fecha));

        $test = DB::table('ORDEN_SERVICIOS')
            ->where('ORD_INM_IDINMUEBLE', $request->inmueble)
            ->where('ORD_LOO_TIPOORDEN', $request->tipoOrden)
            ->where('ORD_USR_ID', $request->persona)
            ->where('ORD_FECHAORDEN',  $fechaOrden)
            ->where('ORD_COSTO', $request->costo)
            ->first();

        if($test)
            return redirect('/orden')->with('message', 'Orden no Modificada. La información no fue cambiada');

        $validaPersona = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_ID', '=', 'id')
            ->where('ORD_IDORDEN', $id)
            ->select('ORD_USR_ID', 'email', 'USR_DIRECCION', 'name', 'USR_APELLIDOS')
            ->first();

       
        if($validaPersona->ORD_USR_ID != $request->persona)
        {
            $fecha = Carbon::now();
            $fecha = $fecha->format('l jS \\of F Y h:i:s A');

            // $user = array('email'=>$validaPersona->email);
            // $data = array('detail'=>'Este mensaje es automático. Por favor no responder', 'direccion' => $validaPersona->INM_DIRECCION, 'fecha' => $fecha, 'name'  => $name);

            // Mail::send('emails.anularOrden', $data, function ($message) use ($user)
            // {
            // $message->from('ordenanulada@conciergeguru.com', Session::get('nombreEmpresa'));
            // $message->to($user['email'])->subject('Anulación de Orden de Servicio');
            // });

            DB::table('ORDEN_SERVICIOS')
                ->where('ORD_IDORDEN', $id)
                ->update(['ORD_INM_IDINMUEBLE'  => $request->inmueble,
                          'ORD_LOO_TIPOORDEN'   => $request->tipoOrden,
                          'ORD_USR_ID'          => $request->persona,
                          'ORD_LOO_ESTADOORDEN' => 1,
                          'ORD_COSTO'           => $request->costo,
                          'ORD_FECHAORDEN'      => $fechaOrden]);

            $persona = DB::table('users')
                ->where('id', $request->persona)
                ->select('email', 'name', 'USR_APELLIDOS')
                ->first();

            $inmueble = DB::table('INMUEBLES')
                ->join('ORDEN_SERVICIOS', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
                ->where('INM_IDINMUEBLE', $request->inmueble)
                ->select('INM_DIRECCION', 'ORD_COSTO')
                ->first();

            $tipo = DB::table('LOOKUP')
                ->where('LOO_GRUPO', 1)
                ->where('LOO_IDLOOKUP', $request->tipoOrden)
                ->select('LOO_DESCRIPCION')
                ->first();

            $fechaOrden = strftime('%Y-%B-%A %H:%M', strtotime($request->Fecha));

            // $user = array('email'=>$persona->email, 'name'=>'eduardo');
            // $data = array('detail'    => 'Este mensaje es automático. Por favor no responder', 
            //               'costo'     => $inmueble->ORD_COSTO,
            //               'direccion' => $inmueble->INM_DIRECCION,
            //               'tipo'      => $tipo->LOO_DESCRIPCION,
            //               'fecha'     => $fechaOrden, 
            //               'name'      => $persona->name,
            //               'surname'   => $persona->USR_APELLIDOS);

            // Mail::send('emails.nuevaOrden', $data, function ($message) use ($user)
            // {
            // $message->from('ordendeservicio@conciergeguru.com', Session::get('nombreEmpresa'));
            // $message->to($user['email'], $user['name'])->subject('Nueva orden de servicio');
            // });

            return redirect('/orden')->with('message', 'Como la persona cambió se ha enviado e-mail de anulación a la persona anterior y de confirmación a la persona nueva');  
        }
        else
        {
            DB::table('ORDEN_SERVICIOS')
                ->where('ORD_IDORDEN', $id)
                ->update(['ORD_INM_IDINMUEBLE' => $request->inmueble,
                          'ORD_LOO_TIPOORDEN'  => $request->tipoOrden,
                          'ORD_COSTO'           => $request->costo,
                          'ORD_FECHAORDEN'     => $fechaOrden]);

            $users = DB::table('users')
                ->join('ORDEN_SERVICIOS', 'id', '=', 'ORD_USR_ID')
                ->join('LOOKUP', 'USR_LOO_TIPO', '=', 'LOO_IDLOOKUP')
                ->where('LOO_GRUPO', 1)
                ->where('ORD_IDORDEN', $id)
                ->select('email', 'ORD_COSTO', 'INM_DIRECCION', 'name', 'USR_APELLIDOS', 'LOO_DESCRIPCION')
                ->first();

            $fecha = strftime('%Y-%m-%d %H:%M:%S', strtotime($_POST['Fecha']));

            // $user = array('email' => $users->email);
            // $data = array('detail'=>'Este mensaje es automático. Por favor no responder', 'tipo' => $users->LOO_DESCRIPCION, 'costo' => $users->ORD_COSTO, 'direccion' => $users->INM_DIRECCION, 'fecha' => $fecha, 'name'  => $users->name, 'surname' => $users->USR_APELLIDOS);

            // Mail::send('emails.editarOrden', $data, function ($message) use ($user)
            // {
            // $message->from('ordenEditada@conciergeguru.com', Session::get('nombreEmpresa'));
            // $message->to($user['email'])->subject('Edición de orden de trabajo');
            // });
        
            return redirect('/orden')->with('message', 'Orden Modificada con exito. Se ha enviado e-mail de confirmación');
        }
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

    public function buscarOrdenes()
    {
        $idEmpresa = Session::get('idEmpresa');
        $i_nombrePersona    = $_POST['i_nombrePersona'];
        $i_documentoPersona = $_POST['i_documentoPersona'];
        $i_estadoOrden      = $_POST['i_estadoOrden'];

        $idp = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->where('USE_EMP_IDEMPRESA', $idEmpresa)
            ->where('USR_DOCUMENTO', $i_documentoPersona)
            ->wherenotnull('USR_LOO_TIPO')
            ->select('id')
            ->first();
        
        if($idp)
            $i_documentoPersona = $idp->id;
        else
            $i_documentoPersona = "";

        $busqueda = array();


        $i_nombrePersona     ? $busqueda += array(0 => array('ORD_USR_ID', '=', $i_nombrePersona)) : null;
        $i_documentoPersona  ? $busqueda += array(1 => array('ORD_USR_ID', '=', $i_documentoPersona)) : null;
        $i_estadoOrden       ? $busqueda += array(2 => array('ORD_LOO_ESTADOORDEN', '=', $i_estadoOrden)) : null;

        $busquedaOrden = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_ID', '=', 'users.id')
            ->join('LOOKUP as c', 'c.LOO_IDLOOKUP', '=', 'ORD_LOO_ESTADOORDEN')
            // ->where('ORD_LOO_ESTADOORDEN', '!=', 5)
            ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
            // ->where('ORD_PAGADO', 0)
            ->where('c.LOO_GRUPO', 2)
            ->where($busqueda)
            ->select('ORDEN_SERVICIOS.*', 'users.name', 'email', 'USR_APELLIDOS', 'ORD_INM_IDINMUEBLE',  'c.LOO_DESCRIPCION as estado_orden', 'ORD_PAGADO', 'ORD_FECHAORDEN','USR_DOCUMENTO')
            ->get();
        
        return view('ordenes.ajax.buscar', compact('busquedaOrden'));
    }

    public function selectTipoper()
    {
        $i_tipo       = $_POST['i_tipo'];
        $i_idinmueble = $_POST['i_idinmueble'];
        $idEmpresa    = Session::get('idEmpresa');

        $ciudad = DB::table('INMUEBLES')
            ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
            ->where('INM_IDINMUEBLE', $i_idinmueble)
            ->select('PRO_CIU_IDCIUDAD')
            ->first();

        $ciu = $ciudad->PRO_CIU_IDCIUDAD;

        $personas = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->where('USE_EMP_IDEMPRESA', $idEmpresa)
            ->where('USR_LOO_TIPO', $i_tipo)
            ->where('USR_CIU_IDCIUDAD', $ciu)
            ->select('id', 'name', 'USR_APELLIDOS')
            ->get();
        
        return view('ordenes.ajax.select', compact('personas'));
    }

    public function pagarOrdenes()
    {
        $i_idorden = $_POST['i_idorden'];
        $s_nombre  = $_POST['s_nombre'];
        $fecha = Carbon::now();
        $fecha = $fecha->format('l jS \\of F Y h:i:s A');
                
        $user = array('email'=>$_POST['s_email']);
        $data = array('detail'=>'Este mensaje es automático. Por favor no responder', 'costo' =>$_POST['i_costo'], 'direccion' => $_POST['s_direc'], 'fecha' => $fecha,'name'  => $_POST['s_nombre']);

        Mail::send('emails.pagarOrden', $data, function ($message) use ($user)
        {
        $message->from('pagogenerado@conciergeguru.com', Session::get('nombreEmpresa'));
        $message->to($user['email'])->subject('Confirmación de Pago');
        });

        DB::table('ORDEN_SERVICIOS')
            ->where('ORD_IDORDEN', $i_idorden)
            ->update(['ORD_PAGADO' => 1]);
    }

    public function anularOrdenes()
    {
        $i_idorden = $_POST['i_idorden'];
        $s_nombre  = $_POST['s_nombre'];
        $fecha = Carbon::now();
        $fecha = $fecha->format('l jS \\of F Y h:i:s A');
                
        $user = array('email'=>$_POST['s_email']);
        $data = array('detail'=>'Este mensaje es automático. Por favor no responder', 'direccion' => $_POST['s_direc'], 'fecha' => $fecha, 'name'  => $_POST['s_nombre']);

        // Mail::send('emails.anularOrden', $data, function ($message) use ($user)
        // {
        // $message->from('ordenanulada@conciergeguru.com', Session::get('nombreEmpresa'));
        // $message->to($user['email'])->subject('Anulación de Orden de Servicio');
        // });

        DB::table('ORDEN_SERVICIOS')
            ->where('ORD_IDORDEN', $i_idorden)
            ->update(['ORD_LOO_ESTADOORDEN' => 4]);   
    }

    public function evidenciasOrdenes($idor)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);

        if (!filter_var($idor, FILTER_VALIDATE_INT)) abort(404);

        $datos = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_ID', '=', 'id')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->where('ORD_IDORDEN', $idor)
            ->select('name', 'USR_APELLIDOS', 'INM_DIRECCION')
            ->first();

        if(!$datos){
            return redirect('/orden')->with('messageE', 'No se encontró información');
        }

        $tipo = DB::table('ORDEN_SERVICIOS')
            ->select('ORD_LOO_TIPOORDEN')
            ->where('ORD_IDORDEN', $idor)
            ->first();
        $tipoOrden = $tipo->ORD_LOO_TIPOORDEN;

        if($tipoOrden == 1){
            $evidenciasAseos    = DB::table('EVIDENCIAS')->where('EVI_ORD_IDORDEN', $idor)->where('EVI_LOO_TIPO', 1)->get();
            $evidenciasCheckout = DB::table('EVIDENCIAS')->where('EVI_ORD_IDORDEN', $idor)->where('EVI_LOO_TIPO', 2)->get();
            return view('ordenes.evidencias', compact('evidenciasAseos', 'evidenciasCheckout', 'tipoOrden', 'idor', 'datos'));
        }

        if($tipoOrden == 2){
            $evidenciasMantenimiento = DB::table('EVIDENCIAS')->where('EVI_ORD_IDORDEN', $idor)->where('EVI_LOO_TIPO', 3)->get();
            return view('ordenes.evidencias', compact('evidenciasMantenimiento', 'tipoOrden', 'idor', 'datos'));
        }

        if($tipoOrden == 3){
            $evidenciasInventario = DB::table('EVIDENCIAS')->where('EVI_ORD_IDORDEN', $idor)->where('EVI_LOO_TIPO', 4)->get();
            return view('ordenes.evidencias', compact('evidenciasInventario', 'tipoOrden', 'idor', 'datos'));   
        }
    }

    public function verImagenEvidencia()
    {
        $s_ruta = $_POST['s_ruta'];
        $s_desc = $_POST['s_desc'];

        return view('ordenes.ajax.verImagenEvidencias', compact('s_ruta', 's_desc'));
    }

    public function imagenNovedades()
    {
        $id = $_POST['id'];

        $novedad = DB::table('NOVEDADES')->where('NOV_IDNOVEDAD', $id)->first();

        return view('ordenes.ajax.mostrarNovedad', compact('novedad'));
    }

    public function finalizarNovedades()
    {
        $idnovedad = $_POST['idnovedad'];

        DB::table('NOVEDADES')
            ->where('NOV_IDNOVEDAD', $idnovedad)
            ->Update(['NOV_ESTADO' => 1]);

        $datos = DB::table('NOVEDADES')
            ->join('ORDEN_SERVICIOS', 'ORD_IDORDEN', '=', 'NOV_ORD_IDORDEN')
            ->join('users', 'id', '=', 'ORD_USR_ID')
            ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
            ->join('LOOKUP', 'ORD_LOO_TIPOORDEN', '=', 'LOO_IDLOOKUP')
            ->where('LOO_GRUPO', 1)
            ->select('name', 'USR_APELLIDOS', 'INM_DIRECCION')
            ->get();

        
    }
}
