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
        ->paginate(10);
      return view('admin.planificaciones.index', compact('planificaciones', 'sedes', 'carreras', 'anio_academico'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {

      //dd($request->user()->getActualRole());
      foreach ($request->user()->docente->revisorDeCarreras as $carrera) {
        $idcarreras[] = $carrera->id;
        $carreras[$carrera->id] = $carrera->nombre;
      }
      foreach ($request->user()->docente->revisorDeSedes as $sede) {
        $idsedes[] = $sede->id;
        $sedes[$sede->id] = $sede->nombre;
      }
      // $sedes = $request->user()->docente->revisorDeSedes;
      // $carreras = $request->user()->docente->revisorDeCarreras;

      //whereSede se nombro así porque enraba en conficto con la prop Sede 
      $planificaciones = Planificacion::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->entregada($request->get('entregadas'))
        ->aprobada($request->get('aprobadas'))
        ->revisada($request->get('revisadas'))
        //->periodo($request->get('periodo'))
        ->whereIn('carrera_id', $idcarreras)
        ->whereIn('sede_id', $idsedes)
        ->whereRaw('entregado is true and prox_version is null')
        ->paginate(10);

      return view('revisor.planificaciones.index', compact('planificaciones', 'sedes', 'carreras'));
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
      return view('lectura.planificaciones.index', compact('planificaciones', 'sedes', 'carreras', 'anio_academico'));
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');

    return view('usuario.planificaciones.create', compact('catedras', 'planes', 'carreras', 'sedes'));
  }

  /**
   * duplica una planificacion a partir de un id
   *
   * @return Response
   */
  public function duplicar($id)
  {
    $old_plani = Planificacion::find($id);
    $planificacion = $old_plani->replicate();
    $planificacion->observado = null;
    $planificacion->fecha_observado = null;
    $planificacion->prev_version = $old_plani->id;
    $planificacion->push();
    $planificacion->save();
    //dd($planificacion);
    $old_plani->prox_version = $planificacion->id;
    $old_plani->save();
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    return view('usuario.planificaciones.edit', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
  }
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreatePlanificacionRequest $request)
  {
    $plani = Planificacion::create($request->all());
    //$plani->save;
    Session::flash('message', 'Planificación creada correctamente!');
    return Redirect::to('/planificacion');
  }

  /**
   * Poner a disposición del las autoridades
   * para corrección
   *
   * @return Response
   */
  public function entregar($id)
  {
    $planificacion = Planificacion::find($id);
    $planificacion->fecha_entrega = new DateTime;
    $planificacion->entregado = true;
    $planificacion->save();
    Session::flash('message', 'Planificación entregada correctamente!');
    return Redirect::to('/planificacion');
  }


  public function aprobar($id)
  {
    $planificacion = Planificacion::find($id);
    $planificacion->fecha_aprobado = new DateTime;
    $planificacion->aprobado = true;
    //elimino todos las observaciones previas
    $planificacion->anio_academico_obs = null;
    $planificacion->equipo_docente_obs = null;
    $planificacion->anio_carrera_obs = null;
    $planificacion->regimen_materia_obs = null;
    $planificacion->carga_horaria_obs = null;
    $planificacion->fundamentacion_obs = null;
    $planificacion->objetivos_obs = null;
    $planificacion->programa_contenidos_obs = null;
    $planificacion->metodologia_trabajo_obs = null;
    $planificacion->sistema_evaluacion_obs = null;
    $planificacion->programa_practicos_obs = null;
    $planificacion->bibliografia_obs = null;
    $planificacion->requisitos_rendir_obs = null;
    $planificacion->cronograma_trabajo_obs = null;
    $planificacion->funciones_equipo_obs = null;
    $planificacion->cronograma_actividades_obs = null;
    $planificacion->mecanismos_autoeval_obs = null;
    //finalmente grabo
    $planificacion->save();
    Session::flash('message', 'La planificacion ha sido aprobada!');
    return Redirect::to('/planificacion');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $planificacion = Planificacion::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    if (Auth::user()->hasRole('admin')) {
      return view('admin.planificaciones.show', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      return view('revisor.planificaciones.show', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      return view('usuario.planificaciones.show', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
      return view('lectura.planificaciones.show', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
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
    $planificacion = Planificacion::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    if (Auth::user()->hasRole('admin')) {
      return view('admin.planificaciones.review', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      return view('revisor.planificaciones.review', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      return view('usuario.planificaciones.show', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
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
    $planificacion = Planificacion::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');

    return view('usuario.planificaciones.edit', compact('planificacion', 'catedras', 'planes', 'carreras', 'sedes'));
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
    $planificacion = Planificacion::find($id);
    $planificacion->fill($request->all());
    $planificacion->save();
    Session::flash('message', 'Planificacion actualizada correctamente!');
    return Redirect::to('/planificacion');
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
    return Redirect::to('/planificacion');
  }

  public function pdf($id)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificacion = Planificacion::find($id);

    //return view('admin.planificaciones.pdf', compact('planificacion'));
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

    $pdf = PDF::loadView('admin.planificaciones.pdf2', compact('planificacion'));

    return $pdf->download('programa.pdf');
  }
  public function reporte(Request $request)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::whereSede($request->get('sede'))
      ->carrera($request->get('carrera'))
      ->asignatura($request->get('asignatura'))
      ->profesor($request->get('profesor'))
      ->anio($request->get('anio_academico'))
      ->get();
    //dd($request->get('sede'));
    //return view('admin.planificaciones.pdf', compact('planificacion'));
    PDF::setOptions(['defaultFont' => 'sans-serif']);

    $pdf = PDF::loadView('admin.planificaciones.reporte', compact('planificaciones'));

    return $pdf->download('planificaciones.pdf');
  }

  public function impresion($id)
  {
    /**
     * Impresión de versiones impresas completas de planificaciones
     **/
    /**Planificacion
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificacion = Planificacion::find($id);

    //return view('admin.planificaciones.pdf', compact('planificacion'));
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

    $pdf = PDF::loadView('admin.planificaciones.impresion', compact('planificacion'));

    return $pdf->download($planificacion->catedra->nombre . '-' . $planificacion->anio_academico . '.pdf');
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
}
