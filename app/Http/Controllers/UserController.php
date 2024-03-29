<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Role;
use Illuminate\Database\Events\QueryExecuted;
use Session;
use Redirect;
use DB;
use App\Ḑocente;
use App\Role_User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $name = trim($request->get('name'));
        $email = trim($request->get('email'));

        $request->user()->authorizeRoles(['admin']);

        if ($request->user()->hasRole('admin')) {
            $usuarios = User::name($request->get('name'))->email($request->get('email'))->dni($request->get('nro_documento'))->role_user($request->get('role_user'))->orderBy('users.name', 'DESC')
            ->paginate(5);
            $roles = Role::all();
           // $nro_documento = Docente::all();
            return view('admin.usuarios.index', compact('usuarios','roles'));
        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nro_documento' => 'required|string|max:10|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required',
           
        ];

        $messages = [
            'name.required' => 'El campo nombre de usuario no puede ser vacio.',
            'name.max' =>'El nombre de usuario no puede ser mayor a :max caracteres.',
            'name.unique' => 'El nombre de usuario ya está en uso.',
            'nro_documento.required' => 'El campo DNI no puede ser vacio.',
            'nro_documento.max' =>'El DNI no puede ser mayor a :max caracteres.',
            'email.required' => 'El campo Email de usuario no puede ser vacio',
            'email.max' => 'El email de usuario no puede ser mayor a :max caracteres',
            'email.unique' => 'El mail ingresado ya está en uso',
            'password.required' => 'El campo contraseña no puede ser vacio.',
            'password.min' => 'La contraseña debe ser mayor a :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
       $usuario = User::create($request->all());
        //$this->validate($request, $rules, $messages);
       /* $usuario = new User;
        $usuario->name = $request->name;
        $usuario->nro_documento = $request->nro_documento;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);*/
       /* $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        
        $user->roles()->attach(Role::where('name','user')->first());*/
        //$usuario->save;
        
        //$usuario->roles()->attach(Role::where('name',$request->role)->first());
        
        Session::flash('message', 'Usuario creado correctamente!');
        return Redirect::to('/usuarios');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        $rol = $usuario->roles()->first();
        return view('admin.usuarios.edit', compact('usuario', 'roles', 'rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $usuario = User::find($id);
        $usuario->fill($request->all());
        $usuario->save();
        $rol_user = Role_User::where('user_id', $id)->first();
        $rol = Role::where('name', $request->role)->first();
        //$rol_user->role_id = $rol->id;
        $rol_user->save();
        Session::flash('message', 'Usuario actualizado correctamente!');
        return Redirect::to('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('message', 'Usuario eliminado correctamente!');
        return Redirect::to('/usuarios');
    }
}
