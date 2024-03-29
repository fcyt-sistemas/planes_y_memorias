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
use Dompdf\Cpdf;
//use DOMPDF\FontMetrics;

class MemoriaController extends Controller
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
      return view('admin.memorias.index', compact('memorias', 'sedes', 'carreras', 'anio_academico'));
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
      return view('revisor.memorias.index', compact('memorias', 'sedes', 'carreras', 'anio_academico','nombre_sede','nombre_carrera'));
    } elseif ($request->user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      //$planificaciones = Planificacion::where('docente_id',$request->user()->docente->id)->get();
      $memorias = Memoria::whereRaw('docente_id =' . $request->user()->docente->id . ' and prox_version is null')
        ->paginate(5);
      return view('usuario.memorias.index', compact('memorias'));
    } elseif ($request->user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
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
        ->paginate(10);
      return view('lectura.memorias.index', compact('memorias', 'sedes', 'carreras', 'anio_academico'));
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
 /* public function create()
  {
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');

    return view('usuario.memorias.create', compact('catedras', 'planes', 'carreras', 'sedes'));
  }*/

  public function create(Request $request){

    
    $sede = trim($request->get('sede'));
    $carrera = trim($request->get('carrera'));
    $asignatura = trim($request->get('asignatura'));
    $anio = trim($request->get('anio_academico'));
    $docentes = trim(Auth::user());
    
    $memorias = Memoria::whereSede($request->get('sede'))
    ->carrera($request->get('carrera'))
    ->asignatura($request->get('asignatura'))
    ->anio($request->get('anio_academico'))
    ->get();

    
      $input = $request->all();
      $catedras = Catedra::find($input['catedra'],['nombre']);
      $planes = Plan::pluck('id','nombre');
      $carreras = Carrera::find($input['carrera'],['nombre']);;
      $sedes = Sede::find($input['sede'],['nombre']);;
      $anios = Memoria::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();
      foreach ($anios as $anio) {
        $anio_academico[$anio] = $anio;
      }
      $plan = Plan::plan($input['carrera'])->get('plan');
      if(!isset($memorias[0])){
        return view('usuario.memorias.create', compact('input','catedras','plan','carreras','sedes','anio_academico'));
      }
  
      else{
        $anios = Memoria::pluck('anio_academico')->unique()->sort();
        $anio_academico = array();
        foreach ($anios as $anio) {
          $anio_academico[$anio] = $anio;
        }
        $sedes = Sede::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $catedras = Catedra::pluck('nombre', 'id');
        Session::flash('message', 'Memoria ya existe!');
        return view('usuario.memorias.filter', compact('memorias','input','catedras','carreras','sedes','anio_academico'));
      }
  }

  public function duplicar($id)
  {
    $old_memo = Memoria::find($id);
    $memoria = $old_memo->replicate();
    $memoria->observado = null;
    $memoria->fecha_observado = null;
    $memoria->prev_version = $old_memo->id;
    $memoria->push();
    $memoria->save();
    //dd($planificacion);
    $old_memo->prox_version = $memoria->id;
    $old_memo->save();
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    return view('usuario.memorias.edit', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateMemoriaRequest $request)
  {
    $memo = Memoria::create($request->all());
    $memo->save;
    Session::flash('message', 'Memoria creada correctamente!');
    return Redirect::to('/memorias');
  }

  /**
   * Poner a disposición del las autoridades 
   * para corrección
   * 
   * @return Response
   */
  public function entregar($id)
  {
    $memoria = Memoria::find($id);
    $memoria->fecha_entrega = new DateTime;
    $memoria->entregado = true;
    $memoria->save();
    Session::flash('message', 'Memoria entregada correctamente!');
    return Redirect::to('/memorias');
  }

  public function aprobar($id)
  {
    $memoria = Memoria::find($id);
    $memoria->fecha_aprobado = new DateTime;
    $memoria->aprobado = true;

    //quito los comentarios de la version final
    $memoria->anio_academico_obs = null;
    $memoria->anio_academico_obs = null;
    $memoria->equipo_docente_obs = null;
    $memoria->anio_carrera_obs = null;
    $memoria->regimen_materia_obs = null;
    $memoria->carga_horaria_obs = null;
    $memoria->ajus_plani_original_obs = null;
    $memoria->org_promo_catedra_obs = null;
    $memoria->regimen_curs_promo_obs = null;
    $memoria->cond_des_esp_curri_obs = null;
    $memoria->cumpl_req_rendir_obs = null;
    $memoria->cumpl_cron_trabajo_obs = null;
    $memoria->cumpl_equipo_catedra_obs = null;
    $memoria->cumpl_mecan_autoeval_obs = null;

    //finalmente salvo los cambios
    $memoria->save();
    Session::flash('message', 'La memoria ha sido aprobada!');
    return Redirect::to('/memorias');
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Memoria  $memoria
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $memoria = Memoria::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    if (Auth::user()->hasRole('admin')) {
      return view('admin.memorias.show', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      return view('revisor.memorias.show', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      return view('usuario.memorias.show', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
      return view('lectura.memorias.show', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
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
    $memoria = Memoria::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');
    if (Auth::user()->hasRole('admin')) {
      return view('admin.memorias.review', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
      return view('revisor.memorias.review', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
      return view('usuario.memorias.show', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
      return view('lectura.memorias.show', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Memoria  $memoria
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $memoria = Memoria::find($id);
    $catedras = Catedra::pluck('nombre', 'id');
    $planes = Plan::pluck('nombre', 'id');
    $carreras = Carrera::pluck('nombre', 'id');
    $sedes = Sede::pluck('nombre', 'id');

    return view('usuario.memorias.edit', compact('memoria', 'catedras', 'planes', 'carreras', 'sedes'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Memoria  $memoria
   * @return \Illuminate\Http\Response
   */
  public function update($id, Request $request)
  {
    $memoria = Memoria::find($id);
    $memoria->fill($request->all());
    $memoria->save();
    Session::flash('message', 'Memoria actualizada correctamente!');
    return Redirect::to('/memorias');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Memoria  $memoria
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Memoria::destroy($id);
    Session::flash('message', 'Memoria eliminada correctamente!');
    return Redirect::to('/memorias');
  }

  public function impresion($id)
  {
    /**
     * Impresión de versiones impresas completas de memorias
     **/
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $memoria = Memoria::find($id);
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    //$page = lastpage();
    $image = base64_encode(file_get_contents(public_path('/images/logo-fcyt.png')));
    $data = array();
    //$pdf = app('dompdf.wrapper');
    $pdf = \App::make('dompdf.wrapper');
    $pdf->getDomPDF()->set_option("enable_php", true); 
    $pdf->setPaper('L', 'landscape');
    return PDF::loadView('admin.memorias.impresion', ['image' => $image], compact('memoria', 'pdf','data'))->stream($memoria->catedra->nombre . '-' . $memoria->anio_academico . '.pdf');
  }

  public function reporte(Request $request)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
     // require_once 'dompdf/autoload.inc.php';
      $memorias = Memoria::whereSede($request->get('sede'))
      ->carrera($request->get('carrera'))
      ->asignatura($request->get('asignatura'))
      ->entregada($request->get('entregadas'))
      ->aprobada($request->get('aprobadas'))
      ->revisada($request->get('revisadas'))
      ->profesor($request->get('profesor'))
      ->anio($request->get('anio_academico'))
      ->orderBy('anio_academico')
      ->orderBy('sede_id')
      ->orderBy('carrera_id')
      ->get();
      
      $ap=0;
      $ob=0;
      $en=0;
      $materia=0;
      
      foreach ($memorias as $m) {
        if($m->aprobado){
          $estado = 'APROBADO';
          $ap++;
        }
        elseif ($m->observado) {
          $estado = 'REVISADO';
          $ob++;
        }
        else{
          $estado = 'ENTREGADO';
          $en++;
        }
  
        $memo[] = array(
          'id_carrera' => $m->carrera_id,
          'anio_academico' => $m->anio_academico,
          'carrera' => $m->carrera->nombre,
          'sede' => $m->sede->nombre,
          'catedra' => $m->catedra->nombre,
          'estado' => $estado,
          'equipo_docente' => html_entity_decode(strip_tags($m->equipo_docente))
        );
        if($m->catedra){
          $materia++;
        } 
        $aux= Plan::cant_materias($m->carrera->id)->get();
        $cant_mat[$m->carrera->id] = $aux[0]->cant_materias;
        
      }

      //$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
      $image = base64_encode(file_get_contents(public_path('/images/logo-fcyt.png')));
      //$pdf = app('dompdf.wrapper');
      //$pdf->getDomPDF()->set_option("enable_php", true);  
      
      return PDF::loadView('admin.memorias.reporte', ['image' => $image], compact('memorias','en','ob','ap','materia','memo','cant_mat'))->stream('reporte.pdf');
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
