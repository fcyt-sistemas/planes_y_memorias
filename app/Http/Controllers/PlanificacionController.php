<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Planificacion;
use App\Catedra;
use App\Plan;
use App\Carrera;
use App\Sede;
use App\Http\Requests\CreatePlanificacionRequest;
use Session;
use Redirect;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;
use dompdf;


class PlanificacionController extends Controller
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

    $request->user()->authorizeRoles(['user', 'admin', 'control', 'lectura']);

    if ($request->user()->hasRole('admin')) {
      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
      //whereSede se nombro así porque enraba en conficto con la prop Sede 
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      $planificaciones = Planificacion::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->entregada($request->get('entregadas'))
        ->aprobada($request->get('aprobadas'))
        ->revisada($request->get('revisadas'))
        ->anio($request->get('anio_academico'))
        ->para_revisar($request->get('para_revisar'))
        ->paginate(10);
      return view('admin.planificaciones.index', compact('planificaciones', 'sedes', 'carreras', 'anio_academico'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
      //whereSede se nombro así porque enraba en conficto con la prop Sede 
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      //dd($request->user()->getActualRole());
      foreach ($request->user()->docente->revisorDeCarreras as $carrera) {
        $idcarreras[] = $carrera->id;
        $carreras[$carrera->id] = $carrera->nombre;
      }
      foreach ($request->user()->docente->revisorDeSedes as $sede) {
        $idsedes[] = $sede->id;
        $sedes[$sede->id] = $sede->nombre;
      }
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      // $sedes = $request->user()->docente->revisorDeSedes;
        $nombre_sede = $sede->nombre;
        //dd($sede->nombre);
        
        $nombre_carrera = $carrera->nombre;
        

      //whereSede se nombro así porque enraba en conficto con la prop Sede 
      $planificaciones = Planificacion::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->entregada($request->get('entregadas'))
        ->aprobada($request->get('aprobadas'))
        ->revisada($request->get('revisadas'))
        ->anio($request->get('anio_academico'))
        ->para_revisar($request->get('para_revisar'))
        ->whereIn('carrera_id', $idcarreras)
        ->whereIn('sede_id', $idsedes)
        ->whereRaw('entregado is true and prox_version is null')
        ->paginate(10);

      return view('revisor.planificaciones.index', compact('planificaciones', 'sedes', 'carreras', 'anio_academico', 'nombre_sede','nombre_carrera'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      //dd(Auth::user()->hasRole('user'),Auth::user()->getActualRole());
      //$planificaciones = Planificacion::where('docente_id',$request->user()->docente->id)->get();
      
      $planificaciones = Planificacion::whereRaw('docente_id =' . $request->user()->docente->id . ' and prox_version is null')
        ->paginate(10);
      return view('usuario.planificaciones.index', compact('planificaciones'));
    } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      //whereSede se nombro así porque enraba en conficto con la prop Sede 
      $planificaciones = Planificacion::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->entregada($request->get('entregadas'))
        ->aprobada($request->get('aprobadas'))
        ->revisada($request->get('revisadas'))
        ->anio($request->get('anio_academico'))
        ->paginate(10);
      return view('lectura.planificaciones.index', compact('planificaciones', 'sedes->id', 'carreras->id', 'anio_academico'));
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   * *
   * */
/*
  public function create()
  {
     $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    $input = $request->all();
    $input = ['sede'=>'','carrera'=>'','catedra'=>'','anio_academico'=>''];
    $plan = Plan::plan(1)->get('plan');
    Session::flash('message', 'Validado correctamente');
    return view('usuario.planificaciones.create', compact('input','catedras', 'plan', 'carreras', 'sedes'));
  }
*/
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  
  public function store(CreatePlanificacionRequest $request)
  {
   // dd($reuqest);
    $plani = Planificacion::create($request->all());
    //$plani = Planificacion::control($request->all());

    $plani->save;
    Session::flash('message', 'Planificación creada correctamente!');
    return Redirect::to('/planificaciones');
  }

  public function create(Request $request){
   
    $sede = trim($request->get('sede'));
    $carrera = trim($request->get('carrera'));
    $asignatura = trim($request->get('asignatura'));
    $anio = trim($request->get('anio_academico'));
    $docentes = trim(Auth::user());
    
    $planificaciones = Planificacion::whereSede($request->get('sede'))
    ->carrera($request->get('carrera'))
    ->asignatura($request->get('asignatura'))
    ->anio($request->get('anio_academico'))
    ->get();

    
      $input = $request->all();
      //dd(isset($planificaciones[0]));
     // dd($input['catedra'],['nombre']);
      $catedras = Catedra::find($input['catedra'],['nombre']);
      $planes = Plan::pluck('id','nombre');
      $carreras = Carrera::find($input['carrera'],['nombre']);;
      $sedes = Sede::find($input['sede'],['nombre']);;
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      $plan = Plan::plan($input['carrera'])->get('plan');
      //dd($input['anio_academico']);
      if(!isset($planificaciones[0])){
        return view('usuario.planificaciones.create', compact('input','catedras','plan','carreras','sedes','anio_academico'));
      }
  
      else{
        $anios = Planificacion::pluck('anio_academico')->unique()->sort();
        $anio_academico = array();
        foreach ($anios as $anio) {
          $anio_academico[$anio] = $anio;
        }
        $sedes = Sede::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $catedras = Catedra::pluck('nombre', 'id');
        Session::flash('message', 'Planificación ya existe!');
        return view('usuario.planificaciones.filter', compact('planificaciones','input','catedras','carreras','sedes','anio_academico'));
      }
  }

  /**
   * duplica una planificacion a partir de un id
   *
   * @return Response
   */
  public function duplicar($id)
  {
    $old_plani = Planificacion::find($id);
    $planificaciones = $old_plani->replicate();
    $planificaciones->observado = null;
    $planificaciones->fecha_observado = null;
    $planificaciones->prev_version = $old_plani->id;
    $planificaciones->push();
    $planificaciones->save();
    //dd($planificaciones);
    $old_plani->prox_version = $planificaciones->id;
    $old_plani->save();
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    return view('usuario.planificaciones.edit', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
  }


  /**
   * Poner a disposición del las autoridades
   * para corrección
   *
   * @return Response
   */
  public function entregar($id)
  {
    $planificaciones = Planificacion::find($id);
    $planificaciones->fecha_entrega = new DateTime;
    $planificaciones->entregado = true;
    $planificaciones->save();
    Session::flash('message', 'Planificación entregada correctamente!');
    return Redirect::to('/planificaciones');
  }


  public function aprobar($id)
  {
    $planificaciones = Planificacion::find($id);
    $planificaciones->fecha_aprobado = new DateTime;
    $planificaciones->aprobado = true;
    //elimino todos las observaciones previas
    $planificaciones->anio_academico_obs = null;
    $planificaciones->equipo_docente_obs = null;
    $planificaciones->anio_carrera_obs = null;
    $planificaciones->regimen_materia_obs = null;
    $planificaciones->carga_horaria_obs = null;
    $planificaciones->fundamentacion_obs = null;
    $planificaciones->objetivos_obs = null;
    $planificaciones->programa_contenidos_obs = null;
    $planificaciones->metodologia_trabajo_obs = null;
    $planificaciones->sistema_evaluacion_obs = null;
    $planificaciones->programa_practicos_obs = null;
    $planificaciones->bibliografia_obs = null;
    $planificaciones->requisitos_rendir_obs = null;
    $planificaciones->cronograma_trabajo_obs = null;
    $planificaciones->funciones_equipo_obs = null;
    $planificaciones->cronograma_actividades_obs = null;
    $planificaciones->mecanismos_autoeval_obs = null;
    //finalmente grabo
    $planificaciones->save();
    Session::flash('message', 'La planificaciones ha sido aprobada!');
    return Redirect::to('/planificaciones');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $planificaciones = Planificacion::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    if (Auth::user()->hasRole('admin')) {
      return view('admin.planificaciones.show', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      return view('revisor.planificaciones.show', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      return view('usuario.planificaciones.show', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
      return view('lectura.planificaciones.show', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function revisar($id)
  {
    $planificaciones = Planificacion::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    if (Auth::user()->hasRole('admin')) {
      return view('admin.planificaciones.review', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      return view('revisor.planificaciones.review', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      return view('usuario.planificaciones.show', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
    }
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $planificaciones = Planificacion::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');

    return view('usuario.planificaciones.edit', compact('planificaciones', 'catedras', 'planes', 'carreras', 'sedes'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
    //dd($request->all());
    $planificaciones = Planificacion::find($id);
    $planificaciones->fill($request->all());
    $planificaciones->save();
    Session::flash('message', 'Planificacion actualizada correctamente!');
    return Redirect::to('/planificaciones');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Planificacion::destroy($id);
    Session::flash('message', 'Planificación eliminada correctamente!');
    return Redirect::to('/planificaciones');
  }

  public function pdf($id)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::find($id);

    //return view('admin.planificaciones.pdf', compact('planificaciones'));
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

    $image = base64_encode(file_get_contents(public_path('/images/logo-tr.png')));
    return PDF::loadView('admin.planificaciones.pdf2', ['image' => $image], compact('planificaciones'))->stream('programa.pdf');
  }

  public function reporte(Request $request)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::anio($request->get('anio_academico'))
      ->carrera($request->get('carrera'))
      ->whereSede($request->get('sede'))
      ->asignatura($request->get('asignatura'))
      ->profesor($request->get('profesor'))
      ->orderBy('anio_academico')
      ->orderBy('sede_id')
      ->orderBy('carrera_id')
      ->get(['anio_academico','equipo_docente', 'carrera_id', 'catedra_id', 'sede_id','entregado','aprobado','observado','docente_id']);
    
    $ap=0;
    $ob=0;
    $en=0;
    $materia=0;
    
    foreach ($planificaciones as $p) {
      if($p->aprobado){
        $estado = 'APROBADO';
        $ap++;
      }
      elseif ($p->observado) {
        $estado = 'REVISADO';
        $ob++;
      }
      else{
        $estado = 'ENTREGADO';
        $en++;
      }

      $plani[] = array(
        'id_carrera' => $p->carrera_id,
        'anio_academico' => $p->anio_academico,
        'carrera' => $p->carrera->nombre,
        'sede' => $p->sede->nombre,
        'catedra' => $p->catedra->nombre,
        'estado' => $estado,
        'equipo_docente' => html_entity_decode(strip_tags($p->equipo_docente))
      );
      if($p->catedra){
        $materia++;
      } 
      $aux= Plan::cant_materias($p->carrera->id)->get();
      
      $cant_mat[$p->carrera->id] = 1;// $aux[0]['cant_materias'];
      
    }
    
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    $image = base64_encode(file_get_contents(public_path('/images/logo-fcyt.png'))); 
    return PDF::loadView('admin.planificaciones.reporte', ['image' => $image], compact('planificaciones','plani','cant_mat','materia','ap','ob','en'))->stream('reporte.pdf');

  }


  public function impresion($id)
  {
    /**
     * Impresi  n de versiones impresas completas de planificaciones
     **/
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::find($id);

    //return view('admin.planificaciones.pdf', compact('planificaciones'));
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

    $image = base64_encode(file_get_contents(public_path('/images/logo-tr.png')));
    return PDF::loadView('admin.planificaciones.impresion', ['image' => $image], compact('planificaciones'))->stream($planificaciones->catedra->nombre . '-' . $planificaciones->anio_academico . '.pdf');

//    $pdf = PDF::loadView('admin.planificaciones.impresion', compact('planificaciones'));
//   return PDF::loadView('admin.planificaciones.impresion', compact('planificaciones'))->stream($planificaciones->catedra->n$
//    return PDF::loadView('admin.planificaciones.impresion', ['image' => $image], compact('planificaciones'))->stream('plani$
//    return $pdf->download($planificaciones->catedra->nombre . '-' . $planificaciones->anio_academico . '.pdf');
  }

  
  public function getCarreras($id)
  {
    return Sede::where('id', '=', $id)->first()->carreras;
  }
  public function getPlanes($id)
  {
    return Carrera::where('id', '=', $id)->first()->planes;
  }
  public function getCatedras($id)
  {
    return Plan::where('id', '=', $id)->first()->catedras;
  }


  //Id que viene es de carrera
  public function getCatedrasPlan($id)
  {
    return Plan::where('carrera_id', '=', $id)->where('estado', '=', 'V')->first()->catedras;
  }
}