<?php

namespace App\Http\Controllers\Auth;

use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\User;
use App\Docente;
use App\Role_User;
use Session;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $client = new Client(['headers' => ['Content-Type' => 'application/json']]);
        $datos_login = ['usuario' => $request->get('nro_documento'), 'clave' => $request->get('password')];
        $response=$client->post(
            'http://g3testing.uader.edu.ar/guarani/3.18/rest/password-uader',
            ['auth' => ['sicer1', 'vfr4%TGB'],'body' => json_encode($datos_login)],
        );
       
        $usuarios = User::id($request->get('nro_documento'))->get();
        //dd($usuarios);
        //dd($id_users);
        if(sizeof($usuarios) == 0){
            // If User not logged in, then Throw exception
            Session::flash('message', 'Credenciales incorrectas o usuario inexistente!');
            return Redirect::to('login');
        }   
        $id_users = $usuarios[0]->id;
        $password = 'fcytadmin1234';
        $login = [$id_users,$password];
        //dd($id_users);
        $role_user = Role_User::Rol($id_users)->get(); //dd($role_user[0]->role_id);
        $type_users= $role_user[0]->role_id;// dd($type_users);

        if ($type_users == 1 ){
            Auth::loginUsingId($id_users,true);
            return Redirect::to('/home');
        }
        if($response->getBody()) {
            $entrar = json_decode($response->getBody()->getContents());
            if ($entrar[0]) {
                Auth::loginUsingId($id_users,true);
                return Redirect::to('/home');             
                //return view('/home');
                //return redirect('home');
            }
            else{
                Session::flash('message', 'Credenciales incorrectas o usuario inexistente!');
                return Redirect::to('login');
            }
        }
        else{
            Session::flash('message', 'Credenciales incorrectas o usuario inexistente!');
            return Redirect::to('login');
        }
    }
}
