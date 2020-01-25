<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username = 'USR_DOCUMENTO';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function getCredentials(Request $request)
    {
        $request['USR_ESTADO'] = 1;

        $empresaN = DB::table('EMPRESAS')->where('EMP_IDEMPRESA', $request['empresa'])->select('EMP_NOMBRE')->first();
            
        $nombreEmpresa = $empresaN->EMP_NOMBRE;
        
        $request->session()->put('nombreEmpresa', $nombreEmpresa);
        $request->session()->put('idEmpresa', $request['empresa']);

        return $request->only($this->loginUsername(), 'password', 'USR_ESTADO');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function validaEmpresaUsuario(){
        $i_docusu = $_POST['i_docusu'];
        $empresas = 0;

        $i_idusu = DB::table('users')
            ->select('id')
            ->Where('USR_DOCUMENTO', $i_docusu)
            ->first();

        if($i_idusu){
            $i_idusu = $i_idusu->id;
            $empresas = DB::table('EMPRESAS')
                ->join('USERS_EMPRESAS', 'EMP_IDEMPRESA', '=', 'USE_EMP_IDEMPRESA')
                ->Where('USE_USR_id', $i_idusu)
                ->select('EMP_IDEMPRESA', 'EMP_NOMBRE')
                ->get();
        }
        
        return view('layouts.ajax.show', compact('empresas'));
    }
}
