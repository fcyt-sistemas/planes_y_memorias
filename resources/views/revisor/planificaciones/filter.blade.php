@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Todos los contenidos cargados!</div>           
                    <H2>PLANIFICACIONES</H2>
                   <div class="card-header justify-content-between">
                   {!! Form::open(['route'=>'planificaciones.index','method'=>'GET','role'=>'search']) !!}
                      <div class="input-group mb-3">
                         <div class="input-group-prepend">
                          <label class="input-group-text" for="sede_id">Sede:</label>
                        </div>
                            {!! Form::select('sede',$sedes, null,['class'=>'custom-select','id'=>'sedes','placeholder'=>'Seleccione una sede...'] ) !!}
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="carrera_id">Carrera:</label>
                            </div>
                            {!! Form::select('carrera',$carreras, null,['class'=>'custom-select','id'=>'carreras','placeholder'=>'Seleccione una carrera..'] ) !!}
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="anio_academico">Año Academico:</label>
                            </div>
                            {!! Form::select('anio_academico',$anio_academico, null,['class'=>'custom-select','id'=>'anio_academico','placeholder'=>'Seleccione un año academico..'] ) !!}
                          </div>
                
                          <div class="form-inline">
                            {!! Form::text('asignatura',null,['type'=>'search','class'=>'form-control mr-sm-3','placeholder'=>'Asignatura']) !!}
                            {!! Form::text('profesor',null,['type'=>'search','class'=>'form-control mr-sm-3','placeholder'=>'Apellido profesor/a']) !!}
                          </div>
                          <br>
                          <div>
                            <label class="col-2.3">
                              <input type="checkbox" name="entregadas" data-size="sm" data-toggle="toggle" data-on=" TODAS  " data-off=" TODAS " data-offstyle="btm btn-secondary">
                            </label>
                            <label class="col-2.3">
                              <input type="checkbox" name="aprobadas" data-size="sm" data-toggle="toggle" data-on=" APROBADAS " data-off=" APROBADAS " data-offstyle="btn btn-success">
                            </label>
                            <label class="col-2.3">
                              <input type="checkbox" name="revisadas" data-size="sm" data-toggle="toggle" data-on=" REVISDAS " data-off=" REVISADAS " data-offstyle="btn btn-danger">
                            </label>
                            <label class="col-2.3">
                              <input type="checkbox" name="para_revisar" data-size="sm" data-toggle="toggle" data-on=" A REVISAR " data-off=" A REVISAR " data-offstyle="btn btn-info">
                            </label>
                          </div>
                          <div style="text-align: right;">
                            <label> <button class="btn btn-dark my-3 my-sm-0" type="submit">Buscar</button></label>
                          </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection