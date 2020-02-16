<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\createPersonaRequest;
use App\Http\Requests\editUserRequest;
use App\Http\Requests\editPersonaRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Users_empresa;
use App\User;
use Auth;
use DB;

class UserController extends Controller
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
        if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);

        $idUsu = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $users = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->where('id', '!=', $idUsu)
            ->whereNull('USR_LOO_TIPO')
            ->select('id', 'EMP_NOMBRE', 'name', 'USR_APELLIDOS', 'USR_DOCUMENTO', 'USR_TELEFONO', 'USR_DIRECCION', 'email', 'USR_SEXO', 'USR_ESTADO', 'USR_SEXO')
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);

        $idEmpresa = Session::get('idEmpresa');

        $empresas = DB::table('EMPRESAS')
            ->select('EMP_IDEMPRESA', 'EMP_NOMBRE')
            ->where('EMP_IDEMPRESA', '!=', $idEmpresa)
            ->get();

        return view('users.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createUserRequest $request)
    {
        if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);

        $user                    = new User();
        $user->name              = $request->get('nombreUsu');
        $user->USR_APELLIDOS     = $request->get('apellidoUsu');
        $user->USR_DOCUMENTO     = $request->get('USR_DOCUMENTO');
        $user->USR_TELEFONO      = $request->get('telefonoUsu');
        $user->USR_CELULAR       = $request->get('celularUsu');
        $user->USR_DIRECCION     = $request->get('direccionUsu');
        $user->email             = $request->get('emailUsu');
        $user->password          = bcrypt($request->get('passwordUsu'));
        $user->USR_ESTADO        = 1;
        $user->save();



        $userid = DB::table('users')->orderby('id', 'desc')->select('id')->first();
        $id = $userid->id;

        $us = User::where('id', '=', $id)->first();
        $us -> attachRole(2);

        $usuE = new Users_empresa();
        $usuE->USE_EMP_IDEMPRESA = $request->get('empresaUsu');
        $usuE->USE_USR_id = $id;
        $usuE->save();

        return redirect('/user')->with('message', 'Usuario creado con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $idEmpresa = Session::get('idEmpresa');

        $user = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->where('id', $id)
            ->select('users.*', 'EMP_IDEMPRESA')
            ->first();

        if (!$user)
            return redirect('/user')->with('messageE', 'Usuario no encontrada. ERROR');

        $empresas = DB::table('EMPRESAS')
            ->where('EMP_IDEMPRESA', '!=', $idEmpresa)
            ->select('EMP_IDEMPRESA', 'EMP_NOMBRE')
            ->get();

        return view('users.edit', compact('user', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editUserRequest $request, $id)
    {
        if (!Auth::user()->hasRole('SuperAdmin')) return abort(403);

        $user = User::find($id);

        $this->validate($request, [
                'USR_DOCUMENTO'   => 'unique:users,USR_DOCUMENTO,'.$user->id,
            ]);

        $edit = User::where('id', '=', $id)
        ->update(array(
            'name'                => $request['nombreUsu'], 
            'USR_APELLIDOS'       => $request['apellidoUsu'], 
            'USR_DOCUMENTO'       => $request['USR_DOCUMENTO'], 
            'USR_TELEFONO'        => $request['telefonoUsu'],
            'USR_CELULAR'         => $request['celularUsu'],
            'USR_DIRECCION'       => $request['direccionUsu'],
            'email'               => $request['emailUsu']));
            

        return redirect('/user')->with('message', 'Usuario Modificado con exito');
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

    public function buscarUsuario()
    {
        $s_nombreUsuario = $_POST['s_nombreUsuario'];
        $s_apellidoUsuario = $_POST['s_apellidoUsuario'];
        $s_correoElectronico = $_POST['s_correoElectronico'];

        $busqueda = array();

        $s_nombreUsuario     ? $busqueda += array(0 => array('name', 'LIKE', '%'.$s_nombreUsuario.'%')) : null;
        $s_apellidoUsuario   ? $busqueda += array(1 => array('USR_APELLIDOS', 'LIKE', '%'.$s_apellidoUsuario.'%')) : null;
        $s_correoElectronico ? $busqueda += array(2 => array('email', 'LIKE', '%'.$s_correoElectronico.'%')) : null;

        $idUsu = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
            
        $busquedaUsu = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->select('id', 'USR_ESTADO', 'EMP_NOMBRE', 'name', 'USR_APELLIDOS', 'USR_DOCUMENTO', 'USR_TELEFONO', 'USR_DIRECCION', 'email', 'USR_SEXO')
            ->where('id', '<>', $idUsu)
            ->where($busqueda)
            ->whereNull('USR_LOO_TIPO')
            ->get();

        return view('users.ajax.buscar', compact('busquedaUsu'));
    }

    public function cambioEstadoUsuario()
    {
        $id      = $_POST["id"];
        $estado  = $_POST["estado"];

        $cambioE = User::where('id', '=', $id)->update(array('USR_ESTADO' => $estado));
    }

    public function showUsuarios($id)
    {
        $user = DB::table('users')
            ->select('users.*', 'EMP_NOMBRE')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->where('id', $id)
            ->first();

            //dd($user);


        return view('users.ajax.show', compact('user'));
    }

    public function indexPersonas()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        
        $idEmpresa = Session::get('idEmpresa');

        $users = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->join('LOOKUP', 'USR_LOO_TIPO', '=', 'LOO_IDLOOKUP')
            ->select('users.*', 'EMP_NOMBRE', 'LOO_DESCRIPCION')
            ->where('LOO_GRUPO', 1)
            ->where('EMP_IDEMPRESA', $idEmpresa)
            ->wherenotnull('USR_LOO_TIPO')
            ->get();

        return view('users.indexPersonas', compact('users'));
    }

    public function createPer()
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);

        $idEmpresa = Session::get('idEmpresa');

        $ciudades = DB::table('CIUDADES')->where('CIU_EMP_IDEMPRESA', $idEmpresa)->select('CIU_IDCIUDAD', 'CIU_NOMBRE')->get();
        
        return view('users.createPersona', compact('ciudades'));
    }

    public function storePersonas(createPersonaRequest $request)
    {
        if (!Auth::user()->hasRole('Administrador')) abort(403);
        
        $idEmpresa = Session::get('idEmpresa');

        $user                    = new User();
        $user->name              = $request->get('nombrePer');
        $user->USR_APELLIDOS     = $request->get('apellidoPer');
        $user->USR_DOCUMENTO     = $request->get('USR_DOCUMENTO');
        $user->USR_TELEFONO      = $request->get('telefonoPer');
        $user->USR_CELULAR       = $request->get('celularPer');
        $user->USR_DIRECCION     = $request->get('direccionPer');
        $user->email             = $request->get('emailPer');
        $user->USR_LOO_TIPO      = $request->get('tipoPer');
        $user->USR_CIU_IDCIUDAD  = $request->get('ciudadPer');
        $user->USR_SEXO          = $request->get('generoPer');
        $user->password          = bcrypt($request->get('passwordPer'));
        $user->USR_ESTADO        = 1;
        $user->save();


        DB::table('PROFESIONALES')
            ->where('PRO_numdocprof', $request->get('USR_DOCUMENTO'))
            ->update(['PRO_estado' => 1]);


        $userid = DB::table('users')->orderby('id', 'desc')->select('id')->first();
        $id = $userid->id;

        $us = User::where('id', '=', $id)->first();
        $us -> attachRole(3);

        $usuE = new Users_empresa();
        $usuE->USE_EMP_IDEMPRESA = $idEmpresa;
        $usuE->USE_USR_id = $id;
        $usuE->save();

        return redirect('/indexPersona')->with('message', 'Persona creado con exito');
    }

    public function buscarPersona()
    {
        $s_nombreUsuario = $_POST['s_nombreUsuario'];
        $s_apellidoUsuario = $_POST['s_apellidoUsuario'];
        $s_correoElectronico = $_POST['s_correoElectronico'];

        $busqueda = array();

        $s_nombreUsuario     ? $busqueda += array(0 => array('name', 'LIKE', '%'.$s_nombreUsuario.'%')) : null;
        $s_apellidoUsuario   ? $busqueda += array(1 => array('USR_APELLIDOS', 'LIKE', '%'.$s_apellidoUsuario.'%')) : null;
        $s_correoElectronico ? $busqueda += array(2 => array('email', 'LIKE', '%'.$s_correoElectronico.'%')) : null;

        $idUsu = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $idEmpresa = Session::get('idEmpresa');
            
        $busquedaPer = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->join('LOOKUP', 'USR_LOO_TIPO', '=', 'LOO_IDLOOKUP')
            ->where('EMP_IDEMPRESA', $idEmpresa)
            ->where('LOO_GRUPO', 1)
            ->wherenotNull('USR_LOO_TIPO')
            ->where($busqueda)
            ->select('LOO_DESCRIPCION', 'id', 'USR_ESTADO', 'EMP_NOMBRE', 'name', 'USR_APELLIDOS', 'USR_DOCUMENTO', 'USR_CELULAR', 'USR_DIRECCION', 'email', 'USR_SEXO')
            ->get();

        return view('users.ajax.buscarPersona', compact('busquedaPer'));
    }

    public function showPersonas($id)
    {
        $persona = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->join('LOOKUP', 'USR_LOO_TIPO', '=', 'LOO_IDLOOKUP')
            ->where('id', $id)
            ->where('LOO_GRUPO', 1)
            ->select('users.*', 'EMP_NOMBRE', 'LOO_DESCRIPCION')
            ->first();

        return view('users.ajax.showPersonas', compact('persona'));
    }

    public function editPersona($id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $idEmpresa = Session::get('idEmpresa');

        $user = DB::table('users')
            ->join('USERS_EMPRESAS', 'users.id', '=', 'USE_USR_id')
            ->join('EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
            ->where('id', $id)
            ->select('users.*', 'EMP_IDEMPRESA')
            ->first();

        if (!$user)
            return redirect('/indexPersona')->with('messageE', 'Persona no encontrada. ERROR');

        $ciudades = DB::table('CIUDADES')->where('CIU_EMP_IDEMPRESA', $idEmpresa)->get();

        return view('users.editPersona', compact('user', 'ciudades'));
    }

    public function updatePersonas(editPersonaRequest $request, $id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);
        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);
        
        $user = User::find($id);
        
        $this->validate($request, [
                'USR_DOCUMENTO'   => 'unique:users,USR_DOCUMENTO,'.$user->id,
            ]);

        $edit = User::where('id', '=', $id)
        ->update(array(
            'name'                => $request['nombrePer'], 
            'USR_APELLIDOS'       => $request['apellidoPer'], 
            'USR_DOCUMENTO'       => $request['USR_DOCUMENTO'], 
            'USR_TELEFONO'        => $request['telefonoPer'],
            'USR_CELULAR'         => $request['celularPer'],
            'USR_DIRECCION'       => $request['direccionPer'],
            'email'               => $request['emailPer'],
            'USR_SEXO'            => $request['generoPer'],
            'USR_LOO_TIPO'        => $request['tipoPer'],
            'USR_CIU_IDCIUDAD'    => $request['ciudadPer']));

        return redirect('/indexPersona')->with('message', 'Persona Modificada con exito');
    }
}
