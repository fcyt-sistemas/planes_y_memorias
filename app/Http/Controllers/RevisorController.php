<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Revisor;
use App\Carrera;
use App\Sede;
use App\Docente;
use App\Role;
use App\User;
use Session;
use Redirect;

class RevisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carrera_id = trim($request->get('carrera_id'));
        $sede_id = trim($request->get('sede_id'));
        $docente_id = trim($request->get('docente_id'));
        $anio_academico = trim($request->get('anio_academico'));

        //Permitido solo para administradores
        $request->user()->authorizeRoles(['admin']);
        
        if($request->user()->hasRole('admin')){
            $revisores = Revisor::carrera_search($request->get('carrera_id'))
                        ->sede($request->get('sede_id'))
                        ->docente($request->get('docente_id'))
                        ->orderBy('sede_id','Asc')
                        ->paginate(5);
            
            return view('admin.revisores.index',compact('revisores','anio_academico'));
        }
        else{
            return view('admin.revisores.index',compact('revisores','anio_academico'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $sedes = Sede::pluck('nombre','id');
        $carreras = Carrera::pluck('nombre', 'id');
        $docentes = DB::table('docentes')
                ->select(DB::raw('CONCAT(apellidos," ",nombres) as nombre_completo, id'))
                //->select(DB::raw('count(*) as user_count, status'))
                ->get()->pluck('nombre_completo', 'id');
        //dd($docentes);
        return view('admin.revisores.create', compact('sedes','carreras','docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //Permitido solo para administradores
        $request->user()->authorizeRoles(['admin']);
        
        $revisor = Revisor::create($request->all());
        $revisor->save();
        
        //localizo el usuario y veo si tiene el rol de control
        //si no lo tiene se lo agrego
        $usuario = User::where('docente_id', $revisor->docente_id)->first();
        if(!$usuario->hasRole('control')){
            $usuario->roles()->attach(Role::where('name','control')->first());
        };

        Session::flash('message','Revisor asociado correctamente!');
	    return Redirect::to('/revisores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Revisor  $revisor
     * @return \Illuminate\Http\Response
     */
    public function show(Revisor $revisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revisor  $revisor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revisor = Revisor::find($id);
        $sedes = Sede::pluck('nombre','id');
        $carreras = Carrera::pluck('nombre', 'id');
        $docentes = DB::table('docentes')
                ->select(DB::raw('CONCAT(apellidos," ",nombres) as nombre_completo, id'))
                //->select(DB::raw('count(*) as user_count, status'))
                ->get()->pluck('nombre_completo', 'id');
        return view('admin.revisores.edit', compact('revisor','sedes','carreras','docentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revisor  $revisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $revisor = Revisor::find($id);
	    $revisor->fill($request->all());
	    $revisor->save();
        Session::flash('message','Docente revisor actualizado correctamente!');
  	    return Redirect::to('/revisores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revisor  $revisor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        Revisor::destroy($id);
		Session::flash('message','Docente revisor eliminado/a correctamente!');
		return Redirect::to('/revisores');
    }
   
}
