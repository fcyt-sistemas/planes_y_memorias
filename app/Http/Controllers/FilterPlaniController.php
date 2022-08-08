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

class FilterPlaniController extends Controller
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
      return view('admin.planificaciones.filter', compact('planificaciones', 'sedes', 'carreras', 'anio_academico'));
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
        // $carreras = $request->user()->docente->revisorDeCarreras;

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

        return view('revisor.planificaciones.filter', compact('planificaciones', 'sedes', 'carreras', 'anio_academico'));
    
       }
    }
}
