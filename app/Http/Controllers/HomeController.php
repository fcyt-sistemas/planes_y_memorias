<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Planificacion;
use App\Docente;
use App\Memoria;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipo = \Session::get('tipoUsuario');

        if ($request->user()->hasRole('admin') && !$tipo) {
            \Session::put('tipoUsuario', 'admin');
        } elseif ($request->user()->hasRole('control') && !$tipo) {
            \Session::put('tipoUsuario', 'control');
        } elseif ($request->user()->hasRole('user') && !$tipo) {
            \Session::put('tipoUsuario', 'user');
        } elseif ($request->user()->hasRole('lectura') && !$tipo) {
            \Session::put('tipoUsuario', 'lectura');
        };

        if (\Session::get('tipoUsuario') == 'admin') {
            $planificaciones = Planificacion::all();
            //$planificaciones = Planificacion::where('docente_id','1')->get();
            $planis = array();
            foreach ($planificaciones as $plani) {
                $planis[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $plani->anio_academico,
                    'equipo_docente' => $plani->equipo_docente,
                ];
            };

            $dashp = [
                'cargadas' => sizeof($planis),
                'entregadas' => DB::table('planificaciones')->where('fecha_entrega', '<>', null)->count(),
                'aprobadas' => DB::table('planificaciones')->where('aprobado', '=', true)->count(),
                'revisadas' => DB::table('planificaciones')->where('observado', '=', true)->count(),
            ];

            $memorias = Memoria::all();
            $memos = array();
            foreach ($memorias as $memo) {
                $memos[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $memo->anio_academico,
                    'equipo_docente' => $memo->equipo_docente,
                ];
            };

            $dashm = [
                'cargadas' => sizeof($memos),
                'entregadas' => DB::table('memorias')->where('fecha_entrega', '<>', null)->count(),
                'aprobadas' => DB::table('memorias')->where('aprobado', '=', true)->count(),
                'revisadas' => DB::table('memorias')->where('observado', '=', true)->count(),
            ];
            return view('admin.home', compact('planis', 'dashp', 'memos', 'dashm'));
        } elseif (\Session::get('tipoUsuario') == 'control') {

            $doc_id = $request->user()->docente->id;

            //dd($request->user()->docente->revisorDe);
            $idcarreras = array();
            $idsedes = array();
            foreach ($request->user()->docente->revisorDeCarreras as $carrera)
                $idcarreras[] = $carrera->id;

            foreach ($request->user()->docente->revisorDeSedes as $sede)
                $idsedes[] = $sede->id;

            $planificaciones = Planificacion::whereIn('carrera_id', $idcarreras)
                ->whereIn('sede_id', $idsedes)
                ->whereRaw('entregado is true and prox_version is null')
                ->get();

            //revisar porque no hace falta este array
            $planis = array();
            foreach ($planificaciones as $plani)
                $planis[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $plani->anio_academico,
                    'equipo_docente' => $plani->equipo_docente,
                ];
            $dashp = [
                'cargadas' => sizeof($planis),
                'entregadas' => Planificacion::whereIn('carrera_id', $idcarreras)
                    ->whereIn('sede_id', $idsedes)
                    ->whereRaw('entregado is true and prox_version is null')
                    ->count(),

                'aprobadas' => Planificacion::whereIn('carrera_id', $idcarreras)
                    ->whereIn('sede_id', $idsedes)
                    ->whereRaw('entregado is true and aprobado is true and prox_version is null')
                    ->count(),
                'revisadas' => Planificacion::whereIn('carrera_id', $idcarreras)
                    ->whereIn('sede_id', $idsedes)
                    ->whereRaw('entregado is true and observado is true and prox_version is null')
                    ->count(),
            ];

            $memorias = Memoria::whereIn('carrera_id', $idcarreras)
                ->whereIn('sede_id', $idsedes)
                ->whereRaw('entregado is true and prox_version is null')
                ->get();
            $memos = array();
            foreach ($memorias as $memo)
                $memos[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $memo->anio_academico,
                    'equipo_docente' => $memo->equipo_docente,
                ];
            $dashm = [
                'cargadas' => sizeof($memos),
                'entregadas' => Memoria::whereIn('carrera_id', $idcarreras)
                    ->whereIn('sede_id', $idsedes)
                    ->whereRaw('entregado is true and prox_version is null')
                    ->count(),

                'aprobadas' => Memoria::whereIn('carrera_id', $idcarreras)
                    ->whereIn('sede_id', $idsedes)
                    ->whereRaw('entregado is true and aprobado is true and prox_version is null')
                    ->count(),
                'revisadas' => Memoria::whereIn('carrera_id', $idcarreras)
                    ->whereIn('sede_id', $idsedes)
                    ->whereRaw('entregado is true and observado is true and prox_version is null')
                    ->count(),
            ];
            $request->user()->authorizeRoles(['control']);

            return view('revisor.home', compact('planis', 'dashp', 'memos', 'dashm'));
        } elseif (\Session::get('tipoUsuario') == 'user') {
            $doc_id = $request->user()->docente->id;
            $planificaciones = Planificacion::where('docente_id', $doc_id)->get();
            $planis = array();
            foreach ($planificaciones as $plani)
                $planis[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $plani->anio_academico,
                    'equipo_docente' => $plani->equipo_docente,
                ];
            $dashp = [
                'cargadas' => sizeof($planis),
                'entregadas' => DB::table('planificaciones')
                    ->where([
                        ['fecha_entrega', '<>', null],
                        ['docente_id', '=', $doc_id],
                        ['prox_version', null]
                    ])->count(),
                'aprobadas' => DB::table('planificaciones')
                    ->where([
                        ['aprobado', '=', true],
                        ['docente_id', '=', $doc_id]
                    ])->count(),
                'revisadas' => DB::table('planificaciones')
                    ->where([
                        ['observado', '=', true],
                        ['docente_id', '=', $doc_id],
                        ['prox_version', null]
                    ])->count(),
            ];

            $memorias = Memoria::where('docente_id', $doc_id)->get();
            //$planificaciones = Planificacion::where('docente_id','1')->get();
            $memos = array();
            foreach ($memorias as $memo)
                $memos[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $memo->anio_academico,
                    'equipo_docente' => $memo->equipo_docente,
                ];
            $dashm = [
                'cargadas' => sizeof($memos),
                'entregadas' => DB::table('memorias')
                    ->where([
                        ['fecha_entrega', '<>', null],
                        ['docente_id', '=', $doc_id],
                        ['prox_version', null]
                    ])->count(),
                'aprobadas' => DB::table('memorias')
                    ->where([
                        ['aprobado', '=', true],
                        ['docente_id', '=', $doc_id]
                    ])->count(),
                'revisadas' => DB::table('memorias')
                    ->where([
                        ['observado', '=', true],
                        ['docente_id', '=', $doc_id],
                        ['prox_version', null]
                    ])->count(),
            ];

            $request->user()->authorizeRoles(['user', 'admin', 'control']);
            return view('usuario.home', compact('planis', 'dashp', 'memos', 'dashm'));
        } elseif (\Session::get('tipoUsuario') == 'lectura') {
            $planificaciones = Planificacion::all();
            $planis = array();
            foreach ($planificaciones as $plani) {
                $planis[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $plani->anio_academico,
                    'equipo_docente' => $plani->equipo_docente,
                ];
            };

            $dashp = [
                'cargadas' => sizeof($planis),
                'entregadas' => DB::table('planificaciones')->where('fecha_entrega', '<>', null)->count(),
                'aprobadas' => DB::table('planificaciones')->where('aprobado', '=', true)->count(),
                'revisadas' => DB::table('planificaciones')->where('observado', '=', true)->count(),
            ];

            $memorias = Memoria::all();
            $memos = array();
            foreach ($memorias as $memo) {
                $memos[] = [
                    'catedra' => 'ninguna',
                    'anio_academico' => $memo->anio_academico,
                    'equipo_docente' => $memo->equipo_docente,
                ];
            };

            $dashm = [
                'cargadas' => sizeof($memos),
                'entregadas' => DB::table('memorias')->where('fecha_entrega', '<>', null)->count(),
                'aprobadas' => DB::table('memorias')->where('aprobado', '=', true)->count(),
                'revisadas' => DB::table('memorias')->where('observado', '=', true)->count(),
            ];
            return view('lectura.home', compact('planis', 'dashp', 'memos', 'dashm'));
        }
    }

    public function cambiarPerfil(Request $request, $perfil)
    {
        //dd($perfil);
        \Session::forget('tipoUsuario');
        \Session::put('tipoUsuario', $perfil);
        return $this->index($request);
    }
}
