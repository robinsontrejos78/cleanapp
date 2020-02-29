<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use \Eventviva\ImageResize;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use DB;

class ordenClienteController extends Controller
{
	public function __construct()
  {
      $this->middleware('auth');
  }


  public function index()
  {
      if (!Auth::user()->hasRole('Cliente')) abort(403);
      $idEmpresa = Session::get('idEmpresa');
      $idusuario=Auth::user()->id;
      $estadosO = DB::table('LOOKUP')->where('LOO_GRUPO', 2)->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->get();

      $ordenServicio = DB::table('ORDEN_SERVICIOS')
          ->join('users', 'ORD_USR_ID', '=', 'users.id')
          ->join('INMUEBLES', 'INM_IDINMUEBLE', '=', 'ORD_INM_IDINMUEBLE')
          ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
          ->join('LOOKUP as a', 'a.LOO_IDLOOKUP', '=', 'ORD_LOO_TIPOORDEN')
          ->join('LOOKUP as b', 'b.LOO_IDLOOKUP', '=', 'INM_LOO_TIPO')
          ->join('LOOKUP as c', 'c.LOO_IDLOOKUP', '=', 'ORD_LOO_ESTADOORDEN')
          ->where('ORD_LOO_ESTADOORDEN', '!=', 4)
          ->where('PRO_EMP_IDEMPRESA', $idEmpresa)
          ->where('ORD_PAGADO', 0)
          ->where('a.LOO_GRUPO', 1)
          ->where('b.LOO_GRUPO', 3)
          ->where('c.LOO_GRUPO', 2)
          ->where('ORD_USR_CLI',$idusuario)
          ->select('ORDEN_SERVICIOS.*', 'users.name', 'email', 'USR_APELLIDOS', 'INM_DIRECCION', 'a.LOO_DESCRIPCION as tipoorden', 'b.LOO_DESCRIPCION as tipoinmueble', 'c.LOO_DESCRIPCION as estado_orden', 'ORD_PAGADO')
          ->orderBy('ORD_FECHAORDEN', 'desc')
          ->take(10)
          ->get();
	// dd($personas);

     $ordencli = DB::table('users')
          ->join('role_user', 'users.id', '=', 'user_id')
          ->join('ORDEN_SERVICIOS', 'users.id', '=', 'ORD_USR_CLI')
          ->where('role_id', 4)
          ->select('users.name', 'USR_APELLIDOS')
          ->get();

      return view('ordenesCliente.index', compact('estadosO', 'ordenServicio'));
  }

  public function create()
  {
      if (!Auth::user()->hasRole('Cliente')) abort(403);

      $idEmpresa = Session::get('idEmpresa');
      $idusuario=Auth::user()->id;

      $inmuebles = DB::table('INMUEBLES')
      	->where('INM_USR_IDUSER',$idusuario)
          ->get();

      $profesionales = DB::table('users')
         ->join('role_user', 'user_id', '=', 'users.id')
          ->where('role_id', 3)
          ->take(5)
          ->get();

      return view('ordenesCliente.create', compact('profesionales','inmuebles'));
  }

  public function store(Request $request)
  {

    if (!Auth::user()->hasRole('Cliente')) return abort(403);

		// $idEmpresa = Session::get('idEmpresa');
    $fechaOrden = strftime('%Y-%m-%d %H:%M:%S', $request->get('fechaOrden'));

    $datosEvento=request()->all();

    DB::table('ORDEN_SERVICIOS')->insert(
        ['ORD_INM_IDINMUEBLE'  => $request->get('inmueble'), 
         'ORD_EMP_IDEMPRESA'   => $request->get('empresa'), 
         'ORD_USR_ID'          => $request->get('usuarioId'), 
         'ORD_USR_CLI'         => $request->get('cliente'), 
         'ORD_LOO_ESTADOORDEN' => $request->get('estadoOrden'), 
         'ORD_LOO_TIPOORDEN'   => $request->get('tipoOrden'),
         'ORD_FECHAORDEN'      => $request->get('fechaOrden'),
         'ORD_INICIOORDEN'     => $request->get('inicioOrden'),
         'ORD_FINORDEN'        => $request->get('finOrden'),
         'ORD_PAGADO'          => 0
    ]);
        
    // return redirect('/empresa')->with('message', 'Empresa creada con exito');

		$persona = DB::table('users')
    	->where('id', $request->get('usuarioId'))
      ->select('email', 'name', 'USR_APELLIDOS')
      ->first();

    $inmueble = DB::table('INMUEBLES')
    	->where('INM_IDINMUEBLE', $request->get('inmueble'))
      ->select('INM_DIRECCION')
      ->first();

    $tipo = DB::table('LOOKUP')
    	->where('LOO_GRUPO', 1)
      ->where('LOO_IDLOOKUP', $request->get('tipoOrden'))
      ->select('LOO_DESCRIPCION')
      ->first();

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

      return redirect('/ordenCliente')->with('message', 'Orden creada con exito. Se ha enviado e-mail de confirmación');
  }

	public function edit($id)
    {
        if (!Auth::user()->hasRole('Cliente')) abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $idusuario=Auth::user()->id;

        $orden = DB::table('ORDEN_SERVICIOS')
            ->where('ORD_IDORDEN', $id)
            ->first();

        $idEmpresa = Session::get('idEmpresa');

        $inmuebles = DB::table('INMUEBLES')
            ->where('INM_USR_IDUSER', $idusuario)
            ->select('INM_IDINMUEBLE', 'INM_DIRECCION')
            ->get();

        $temporal = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'id', '=', 'ORD_USR_ID')
            ->select('ORD_LOO_TIPOORDEN', 'USR_CIU_IDCIUDAD')
            ->where('ORD_IDORDEN', $id)
            ->first();

        $personas = DB::table('users')
            ->where('USR_CIU_IDCIUDAD', $temporal->USR_CIU_IDCIUDAD)
            ->where('USR_LOO_TIPO', $temporal->ORD_LOO_TIPOORDEN)
            ->select('id', 'name', 'USR_APELLIDOS')
            ->get();

        $tipoOrden = DB::table('LOOKUP')->where('LOO_GRUPO', 1)->select('LOO_IDLOOKUP', 'LOO_DESCRIPCION')->get();

        return view('ordenesCliente.edit', compact('orden', 'inmuebles'));
        // ,'personas', 'tipoOrden'
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

	public function buscarOrdenes()
    {
        $idEmpresa = Session::get('idEmpresa');
        $idusuario=Auth::user()->id;
        $i_estadoOrden      = $_POST['i_estadoOrden'];

        $busqueda = array();

        $i_estadoOrden ? $busqueda += array(2 => array('ORD_LOO_ESTADOORDEN', '=', $i_estadoOrden)) : null;

        $busquedaOrden = DB::table('ORDEN_SERVICIOS')
            ->join('users', 'ORD_USR_ID', '=', 'users.id')
            ->join('INMUEBLES', 'INM_IDINMUEBLE', '=', 'ORD_INM_IDINMUEBLE')
            ->join('PROPIEDADES', 'INM_PRO_IDPROPIEDAD', '=', 'PRO_IDPROPIEDAD')
            ->join('LOOKUP as a', 'a.LOO_IDLOOKUP', '=', 'ORD_LOO_TIPOORDEN')
            ->join('LOOKUP as b', 'b.LOO_IDLOOKUP', '=', 'INM_LOO_TIPO')
            ->join('LOOKUP as c', 'c.LOO_IDLOOKUP', '=', 'ORD_LOO_ESTADOORDEN')
            ->where('PRO_EMP_IDEMPRESA', $idEmpresa)
            ->where('a.LOO_GRUPO', 1)
            ->where('b.LOO_GRUPO', 3)
            ->where('c.LOO_GRUPO', 2)
            ->where($busqueda)
            ->where('ORD_USR_CLI',$idusuario)
            ->select('ORDEN_SERVICIOS.*', 'users.name', 'email', 'USR_APELLIDOS', 'INM_DIRECCION', 'a.LOO_DESCRIPCION as tipoorden', 'b.LOO_DESCRIPCION as tipoinmueble', 'c.LOO_DESCRIPCION as estado_orden', 'ORD_PAGADO', 'ORD_FECHAORDEN')
            ->get();
        
        return view('ordenes.ajax.buscar', compact('busquedaOrden'));
    }
}