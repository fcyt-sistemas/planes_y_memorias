<?php

namespace App\Http\Controllers\Auth;

use Auth;
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
    public function index(){
        return view('login');
    }

    public function login()
    {
        if (Auth::attempt(request()->only('nro_documento', 'password'))) {
            return redirect('/home');
        }

        return back()->withErrors([
            'nro_documento' => 'invalid credentials',
        ]);
    }

}
