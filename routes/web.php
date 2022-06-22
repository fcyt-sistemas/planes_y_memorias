<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/planificaciones/filter', 'FilterPlaniController@index')->name('planificaciones.filter');
Route::get('/memorias/filter', 'FilterMemoController@index')->name('memorias.filter');
Route::get('/perfil/{perfil}', 'HomeController@cambiarPerfil')->name('perfil');
Route::get('/planificaciones', 'PlanificacionController@index')->name('planificaciones');
//Route::get('/planificaciones/search', 'PlanificacionController@search')->name('planisearch');
Route::get('/planificaciones/{id}/entregar', 'PlanificacionController@entregar');
Route::get('/planificaciones/{id}/revisar', 'PlanificacionController@revisar');
Route::get('/planificaciones/{id}/duplicar', 'PlanificacionController@duplicar');
Route::get('/planificaciones/{id}/aprobar', 'PlanificacionController@aprobar');
Route::get('/planificaciones/{id}/programa', 'PlanificacionController@pdf')->name('programa.pdf');
Route::get('/planificaciones/{id}/impresion', 'PlanificacionController@impresion')->name('planificacion.impresion');
Route::get('/planificaciones/reporte', 'PlanificacionController@reporte')->name('reporte.pdf');
Route::get('/memorias/reporte', 'MemoriaController@reporte')->name('memoria.reporte');
Route::resource('planificaciones','PlanificacionController');
Route::resource('memorias','MemoriaController');
Route::resource('revisores','RevisorController');
Route::resource('docentes','DocenteController');
Route::resource('usuarios','UserController');
Route::get('revisores','RevisorController@index')->name('revisores');
Route::get('docentes','DocenteController@index')->name('docentes');
Route::get('usuarios','UserController@index')->name('usuarios');
Route::get('/memorias', 'MemoriaController@index')->name('memorias');
Route::get('/memorias/{id}/entregar', 'MemoriaController@entregar');
Route::get('/memorias/{id}/revisar', 'MemoriaController@revisar');
Route::get('/memorias/{id}/duplicar', 'MemoriaController@duplicar');
Route::get('/memorias/{id}/aprobar', 'MemoriaController@aprobar');
Route::get('/memorias/{id}/impresion', 'MemoriaController@impresion')->name('memoria.impresion');


//rutas del servicio dinamicas
Route::get('/memorias/carreras/{id}', 'MemoriaController@getCarreras');
Route::get('/memorias/planes/{id}', 'MemoriaController@getPlanes');
Route::get('/memorias/catedras/{id}', 'MemoriaController@getCatedras');
Route::get('/planificaciones/carreras/{id}', 'PlanificacionController@getCarreras');
Route::get('/planificaciones/planes/{id}', 'PlanificacionController@getPlanes');
Route::get('/planificaciones/catedras/{id}', 'PlanificacionController@getCatedras');
Route::get('/carreras/{id}', 'PlanificacionController@getCarreras');
Route::get('/planes/{id}', 'PlanificacionController@getPlanes');
Route::get('/catedras/{id}', 'PlanificacionController@getCatedras');
