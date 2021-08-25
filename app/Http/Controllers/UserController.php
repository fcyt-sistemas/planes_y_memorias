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
        $request->user()->authorizeRoles(['admin']);

        if ($request->user()->hasRole('admin')) {
            $usuarios = User::orderBy('name')->paginate(20);
            return view('admin.usuarios.index', compact('usuarios'));
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
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
           
        ];

        $messages = [
            'name.required' => 'El campo nombre de usuario no puede ser vacio.',
            'name.max' =>'El nombre de usuario no puede ser mayor a :max caracteres.',
            'name.unique' => 'El nombre de usuario ya está en uso.',
            'email.required' => 'El campo correo electrónico no puede ser vacio.',
            'email.max' =>'El correo electrónico no puede ser mayor a :max caracteres.',
            'password.required' => 'El campo contraseña no puede ser vacio.',
            'password.min' => 'La contraseña debe ser mayor a :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];

        $this->validate($request, $rules, $messages);
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        
        $usuario->roles()->attach(Role::where('name',$request->role)->first());
        
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
        $rol_user->role_id = $rol->id;
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
