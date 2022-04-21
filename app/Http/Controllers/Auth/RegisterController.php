<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Docente;
use App\Revisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
            
            $doc = Docente::where('nro_documento',$data['nro_documento'])->first();
            if($doc){
                $data['docente_id']=$doc->id;
            };
            return Validator::make($data, [
            // se puede validar contra la nomina de docentes o bien
            // hacer un registro completo con todo el perfil del docente
            'nro_documento' => 'required|string|exists:docentes,nro_documento',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'docente_id'=>'unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
   
       //dd($data);
       $docente = Docente::where('nro_documento',$data['nro_documento'])->first();
       $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'docente_id' => $docente->id,
        ]);
        
        $user->roles()->attach(Role::where('name','user')->first());
        
        /* Veo si el docente fue asignado 
        para controlar la carga de una carrera*/
        $revisor = Revisor::where('docente_id', $docente->id)->first();
        if($revisor){
            $user->roles()->attach(Role::where('name','control')->first());
        }
        return $user;
        
    }
}
