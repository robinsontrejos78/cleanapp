<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use \Eventviva\ImageResize;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Collection;

class OrdenClienteController extends Controller
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

      $fechaActualOrden=Carbon::now();

       DB::table('ORDEN_SERVICIOS')
        ->where('ORD_INICIOORDEN','<', $fechaActualOrden)
        ->where('ORD_LOO_ESTADOORDEN', 1)
        ->update(['ORD_LOO_ESTADOORDEN' => 5]);

      $ordenServicio = DB::table('ORDEN_SERVICIOS')
          ->join('users', 'ORD_USR_ID', '=', 'users.id')
          ->join('LOOKUP as c', 'c.LOO_IDLOOKUP', '=', 'ORD_LOO_ESTADOORDEN')
          ->where('ORD_LOO_ESTADOORDEN', '!=', 4)
          ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
          ->where('ORD_PAGADO', 0)
          ->where('c.LOO_GRUPO', 2)
          ->where('ORD_USR_CLI',$idusuario)
          ->select('ORDEN_SERVICIOS.*', 'users.name', 'email', 'USR_APELLIDOS', 'ORD_INM_IDINMUEBLE', 'c.LOO_DESCRIPCION as estado_orden', 'ORD_PAGADO', 'ORD_CLI_CALIFICO')
          ->orderBy('ORD_FECHAORDEN', 'desc')
          ->take(10)
          ->get();

     $ordencli = DB::table('users')
          ->join('role_user', 'users.id', '=', 'user_id')
          ->join('ORDEN_SERVICIOS', 'users.id', '=', 'ORD_USR_CLI')
          ->where('role_id', 4)
          ->select('users.name', 'USR_APELLIDOS')
          ->get();

      $diaSiguiente=Carbon::now()->addDay(1);
      //no esta funcionando
      return view('ordenesCliente.index', compact('estadosO', 'ordenServicio','diaSiguiente'));
  }

  public function create()
  {
      if (!Auth::user()->hasRole('Cliente')) abort(403);

      $idEmpresa = Session::get('idEmpresa');
      $idusuario=Auth::user()->id;
      $direccion=Auth::user()->USR_DIRECCION;

      $profesionales = DB::table('users')
         ->join('role_user', 'user_id', '=', 'users.id')
          ->where('role_id', 3)
          // ->take(5)
          ->get();

      return view('ordenesCliente.create', compact('direccion'));
  }

  public function buscaProf()
  {
      if (!Auth::user()->hasRole('Cliente')) abort(403);

      $idEmpresa = Session::get('idEmpresa');
      $idusuario=Auth::user()->id;

      $fechaActual=carbon::now();

      $plan           = $_POST['plan'];
      $fecha          = $_POST['fecha'];
      $horaInicial    = $_POST['fecha'].' '.$_POST['horaInicial'];
      $horasPlan      = $_POST['horasPlan'];
      $plancha        = $_POST['plancha'];
      $cocina         = $_POST['cocina'];

      $plancha = ($plancha == "true") ? true : false;
      $cocina = ($cocina == "true") ? true : false;

      //dd($plancha);

      $horaInicial = strtotime ( $horaInicial);
      if($horaInicial<=strtotime($fechaActual)){
        return 'false';
      }

      $horaFinal = strtotime ('+'.$horasPlan.' hours', $horaInicial);

      $horaInicial=date("Y-m-d H:i:s ",$horaInicial);
      $horaFinal=date("Y-m-d H:i:s ",$horaFinal);

      $profesionales = DB::table('users')
        ->join('role_user', 'user_id', '=', 'users.id')
        ->whereRaw(" users.id NOT IN ( select users.id from users inner join role_user on user_id=users.id inner join ORDEN_SERVICIOS on user_id=ORD_USR_ID where role_id=3 and ORD_LOO_ESTADOORDEN = 1 and ((ORD_INICIOORDEN - INTERVAL 29 MINUTE) <= '".$horaInicial."' and '".$horaInicial."'<= (ORD_FINORDEN + INTERVAL 29 MINUTE) or (ORD_INICIOORDEN  - INTERVAL 29 MINUTE) <= '".$horaFinal."' and '".$horaFinal."' <= (ORD_FINORDEN + INTERVAL 29 MINUTE) ) )")
        ->whereRaw(" users.id IN ( select users.id from users inner join INDISPONIBILIDADES on users.id=ind_pro_id where (TIMESTAMP(ind_dia,id_horainicio) <= '".$horaInicial."' and '".$horaInicial."'<= TIMESTAMP(ind_dia,id_horafinal) or TIMESTAMP(ind_dia,id_horainicio) <= '".$horaFinal."' and '".$horaFinal."' <= TIMESTAMP(ind_dia,id_horafinal) ) )")
        ->where('role_id', 3)
        // ->where('usr_cocina', $cocina)
        // ->where('usr_plancha', $plancha)
        ->where('USR_ESTADO',1)
        ->take(5)
        ->get();


// dd($profesionales);
      $profesionalesConEstrellas = collect();

      foreach($profesionales as $p){

        $calificacion = DB::table('CALIFICACIONES')
          ->select(DB::raw('CASE when round(sum(cal_calificacion)/count(cal_calificacion),1) is null then 5 else round(sum(cal_calificacion)/count(cal_calificacion),1) end as cal_estrellas') )
          ->where([['cal_idusercliente',$p->id],])
          ->first();
        
          $respuesta='cal_estrellas';
          $p->$respuesta = $calificacion->cal_estrellas;

        $profesionalesConEstrellas->push($p);
      }

      return view('ordenesCliente.ajax.buscaProf', compact ('profesionalesConEstrellas','profesionales'));
  }

  public function store(Request $request)
  {

    if (!Auth::user()->hasRole('Cliente')) return abort(403);

		// $idEmpresa = Session::get('idEmpresa');
    //$fechaOrden = strftime('%Y-%m-%d %H:%M:%S', $request->get('fechaOrden'));

    // $datosEvento=request()->all();

    $FECHAORDEN=Carbon::now();

    $INICIOORDEN = strtotime ( $request->get('inicioOrden').' '.$request->get('horaInicial'));
    if($INICIOORDEN<=strtotime($FECHAORDEN)){
      return 'false';
    }

    $FINORDEN = strtotime ('+'.$request->get('horasplan').' hours', $INICIOORDEN);

    $INICIOORDEN=date("Y-m-d H:i:s ",$INICIOORDEN);
    $FINORDEN=date("Y-m-d H:i:s ",$FINORDEN);

    DB::table('ORDEN_SERVICIOS')->insert(
        ['ORD_INM_IDINMUEBLE'  => $request->get('inmueble'), 
         'ORD_EMP_IDEMPRESA'   => $request->get('empresa'), 
         'ORD_USR_ID'          => $request->get('usuarioId'), 
         'ORD_USR_CLI'         => $request->get('cliente'), 
         'ORD_LOO_ESTADOORDEN' => $request->get('estadoOrden'), 
         'ORD_LOO_TIPOORDEN'   => $request->get('tipoOrden'),
         'ORD_FECHAORDEN'      => $FECHAORDEN,
         'ORD_INICIOORDEN'     => $INICIOORDEN,
         'ORD_FINORDEN'        => $FINORDEN,
         'ORD_PAGADO'          => 0,
         'ORD_DESCRIPCION'     => $request->get('descripcionplan')
    ]);
        
    //return redirect('/empresa')->with('message', 'Empresa creada con exito');

		$persona = DB::table('users')
    	->where('id', $request->get('usuarioId'))
      ->select('email', 'name', 'USR_APELLIDOS')
      ->first();

     $cliente = DB::table('users')
      ->where('id', $request->get('cliente'))
      ->select('USR_TELEFONO', 'name', 'USR_APELLIDOS','USR_CELULAR')
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
      
      $ticket = $persona->email;

      $data= array(
      'detail'    => 'Este mensaje es automático. Por favor no responder', 
      'direccion' => $request->get('inmueble'),
      'tipo'      => $tipo->LOO_DESCRIPCION,
      'fecha'     => $request->get('inicioOrden'), 
      'name'      => $persona->name,
      'cliente'   => $cliente->name.' '.$cliente->USR_APELLIDOS,
      'telcliente'   => $cliente->USR_TELEFONO,
      'celcliente'   => $cliente->USR_CELULAR,
      'surname'   => $persona->USR_APELLIDOS);


       

      Mail::send('emails.nuevaOrden', $data, function ($message) use ($ticket)
      {
      
      $message->from('serviciocleanapps@gmail.com');
      $message->to($ticket)->subject('Nueva orden de servicio');
      });

      return ('Orden creada con exito. Se ha enviado e-mail de confirmación');
      // return redirect('/ordenC');
      // return redirect()->route('/ordenCs'); 

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
            ->join('LOOKUP as c', 'c.LOO_IDLOOKUP', '=', 'ORD_LOO_ESTADOORDEN')
            ->where('ORD_EMP_IDEMPRESA', $idEmpresa)
            ->where('c.LOO_GRUPO', 2)
            ->where($busqueda)
            ->where('ORD_USR_CLI',$idusuario)
            ->select('ORDEN_SERVICIOS.*', 'users.name', 'email', 'USR_APELLIDOS', 'ORD_INM_IDINMUEBLE', 'c.LOO_DESCRIPCION as estado_orden', 'ORD_PAGADO', 'ORD_FECHAORDEN')
            ->orderBy('ORD_FECHAORDEN', 'desc')
            ->get();
        
        return view('ordenesCliente.ajax.buscar', compact('busquedaOrden'));
    }

    public function finalizarOrdenes($idor)
    {
        if (!Auth::user()->hasRole('Cliente')) abort(403);
        if (!filter_var($idor, FILTER_VALIDATE_INT)) abort(404);

        // $fecha = Carbon::now();

        // DB::table('ORDEN_SERVICIOS')->where('ORD_IDORDEN', $idor)->update(['ORD_LOO_ESTADOORDEN' => 3, 'ORD_FINORDEN' => $fecha]);

        // $idPersona = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');


        // $ordenes = DB::table('ORDEN_SERVICIOS')
        //     ->join('INMUEBLES', 'ORD_INM_IDINMUEBLE', '=', 'INM_IDINMUEBLE')
        //     ->join('PROPIEDADES', 'PRO_IDPROPIEDAD', '=', 'INM_PRO_IDPROPIEDAD')
        //     ->where('ORD_USR_ID', $idPersona)
        //     ->whereBetween('ORD_LOO_ESTADOORDEN', [1, 2])
        //     ->get();
        
        // return view('ordenpersona.index', compact('ordenes'));
        return('entro a finalizar orden');
    }

    public function calificaciones()
    
    {
        $idPersona = Auth::user()->id;
   
        $contador = DB::table('CALIFICACIONES')
        ->select(DB::raw('round(AVG(CAL_calificacion),1) AS promedio'))
        ->where('CAL_IDUSERCLIENTE', '=', $idPersona)
        ->get();

        $valoraciones = DB::table('CALIFICACIONES')
         ->join('users', 'CAL_IDUSERPROF', '=', 'users.id')
         ->where('CAL_IDUSERCLIENTE', $idPersona)
         ->orderby('CAL_fecharegistro', 'desc')
         ->get();

        return view('ordenesCliente.vercalificacion', compact('valoraciones','contador'));
    }

    public function comenzarOrden($ido)
    {
        if (!Auth::user()->hasRole('Cliente')) abort(403);
        if (!filter_var($ido, FILTER_VALIDATE_INT)) abort(404);

        $idEmpresa = Session::get('idEmpresa');
        $fecha = Carbon::now();
        

        $orden = DB::table('ORDEN_SERVICIOS')
            ->join('LOOKUP', 'ORD_LOO_TIPOORDEN', '=', 'LOO_IDLOOKUP')
            ->where('LOO_GRUPO', 1)
            ->where('ORD_IDORDEN', $ido)
            ->first();

        $tipo = $orden->ORD_LOO_TIPOORDEN;

        return view('ordenesCliente.atenderOrden', compact('orden', 'tipo', 'inventarios'));
    }


    public function calificarorden()
    {
        if (!Auth::user()->hasRole('Cliente')) abort(403);
        $idPersona = Auth::user()->id;

         $calif    = $_POST['calif'];
         $obser    = $_POST['obser'];
         $dataord  = $_POST['dataord'];
         $cliente = $_POST['cliente'];

        $fecha   = Carbon::now();

            DB::table('CALIFICACIONES')->insert(
            ['CAL_IDUSERPROF'    => $idPersona,
             'CAL_IDUSERCLIENTE' => $cliente,
             'CAL_observacion'   => $obser, 
             'CAL_calificacion'  => $calif, 
             'CAL_fecharegistro' => $fecha,
             'CAL_ORD_IDORDEN'   => $dataord
             ]
            ); 

             DB::table('ORDEN_SERVICIOS')->where('ORD_IDORDEN', $dataord)
             ->update(['ORD_CLI_CALIFICO' => 1]);
       
        // $ordenes = DB::table('ORDEN_SERVICIOS')
        //     ->join('users', 'ORD_USR_CLI', '=', 'users.id')
        //     ->where('ORD_USR_ID', $idPersona)
        //     ->whereBetween('ORD_LOO_ESTADOORDEN', [1, 2])
        //     ->get();

        // return ('listo');
      return('entro a calificar');
    }

}
