<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Memoria;
use App\Catedra;
use App\Plan;
use App\Carrera;
use App\Sede;
use Session;
use Redirect;
use DateTime;
use App\Http\Requests\CreateMemoriaRequest;
use Barryvdh\DomPDF\Facade as PDF;
class FilterMemoController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $request->user()->authorizeRoles(['user', 'admin', 'control', 'lectura']);

    if ($request->user()->hasRole('admin')) {
      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
      $anios = Memoria::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      $memorias = Memoria::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->entregada($request->get('entregadas'))
        ->aprobada($request->get('aprobadas'))
        ->revisada($request->get('revisadas'))
        ->anio($request->get('anio_academico'))
        ->para_revisar($request->get('para_revisar'))
        ->paginate(10);
      return view('admin.memorias.filter', compact('memorias', 'sedes', 'carreras', 'anio_academico'));
    } elseif ($request->user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
      $anios = Memoria::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      //dd($request->user()->carreras);
      foreach ($request->user()->docente->revisorDeCarreras as $carrera)
        $idcarreras[] = $carrera->id;

      foreach ($request->user()->docente->revisorDeSedes as $sede)
        $idsedes[] = $sede->id;


      $nombre_sede = $sede->nombre;
      $nombre_carrera = $carrera->nombre;
      $memorias = Memoria::whereSede($request->get('sede'))
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
        ->paginate(5);
      return view('revisor.memorias.filter', compact('memorias', 'sedes', 'carreras', 'anio_academico', 'nombre_sede','nombre_carrera'));
    }
  }
}
