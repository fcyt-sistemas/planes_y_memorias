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
            'http://10.0.60.27:8088/guarani/3.18/rest/password-uader', 
            ['auth' => ['guarani', 'abc123456'],'body' => json_encode($datos_login)],
        );
        //$nro_documento = Docente::nro_documento($request->get('nro_documento'))->get();
        //$id  = Docente::id($request->get('nro_documento'))->get();
       
        $id_users = User::id($request->get('id'));
        echo $id_users;
        die();
        //dd($id_users);
       //$id=User::id($request->get('id'));
        if($response->getBody()) {
            $entrar = json_decode($response->getBody()->getContents());
            if ($entrar[0]) {
                Auth::loginUsingId($id_users,true);
                return redirect('/home');
                //echo Auth::id();
            }
        }
    }



}
