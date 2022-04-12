<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
use App\Planificacion;
use App\Docente;
use App\Memoria;
use Illuminate\Http\Request;
use Redirect;

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

    public function login(Request $request){
        $client = new Client(['headers' => ['Content-Type' => 'application/json']]);
        $datos_login = ['usuario' => $request->get('usuario'), 'clave' => $request->get('clave')];
        $response=$client->post(
            'http://10.0.60.27:8088/guarani/3.18/rest/password-uader', 
            [
 
                'auth' => ['guarani', 'abc123456'],
                'body' => json_encode($datos_login),
            ]
        );
        echo $request;
        echo $response->getStatusCode();
        echo $response->getBody();
        echo '<pre>';
        print_r($response);
        echo '</pre>';
        
        //return Redirect::to('home');
    }
}
