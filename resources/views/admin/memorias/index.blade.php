@extends('layouts.app')
@section('content')
<div class="container">
  @include('admin.memorias.modal')
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header form-inline">
          <h3 class="col-md-9">Memorias de Cátedra</h3>
        </div>
        <div class="card-header justify-content-between">
          {!! Form::open(['route'=>'memorias','method'=>'GET','role'=>'search']) !!}
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
              <input type="checkbox" name="entregadas" data-size="sm" data-toggle="toggle" data-on=" ENTREGADAS  " data-off=" ENTREGADAS " data-offstyle="btm btn-secondary">
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
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
          {{Session::get('message')}}
        </div>
        @endif
        <div class="card-body" data-form="deleteForm">
          <ul class="list-group list-group-flush">
            @if(count($memorias) === 0)
            <div class="alert alert-success" role="alert">
              No hay elementos cargados
            </div>
            @endif
            @foreach($memorias as $m)
            <li class="list-group-item">
              @if($m->entregado) {!!link_to_action('MemoriaController@show', $title = 'ENTREGADA', $parameters = $m->id, $attributes = ['class'=>'entreg'])!!} @endif
              @if($m->observado) {!!link_to_action('MemoriaController@show', $title = 'REVISADA', $parameters = $m['id'], $attributes = ['class'=>'rev'])!!} @endif
              @if($m->aprobado) {!!link_to_action('MemoriaController@show', $title = 'APROBADA', $parameters = $m['id'], $attributes = ['class'=>'aprob'])!!} @endif
              </br>
              Docente: <b><i>{{$m->docente->apellidos}}, {{$m->docente->nombres}}</i></b></br>
              <b>{{$m->carrera->nombre}}</b> Resol {{$m->plan->nro_resolucion}})</br>
              <b>{{$m->catedra->nombre}}, {{$m->anio_academico}}</b></br>
              {{strip_tags($m->equipo_docente)}}
              </br>
              <div align="right">
                <div class="btn-group" role="group">
                  <div class="btn-group">
                    {!!link_to_action('MemoriaController@show', $title = 'Ver', $parameters = $m['id'], $attributes = ['class'=>'btn btn-secondary'])!!}
                    {!!link_to_action('MemoriaController@revisar', $title = 'Revisar!', $parameters = $m['id'], $attributes = ['class'=>'btn btn-success'])!!}
                  </div>
                </div>
              </div>
            </li>
            @endforeach
            <li class="list-group-item">{{$memorias->appends(Request::only(['sede','carrera','asignatura','profesor','entregadas','aprobadas','revisadas','anio_academico']))->links()}}
              <div align="right">
                <div class="btn">
                  {!!link_to_route('memoria.reporte', $title = 'Reporte para Impresión', $parameters = Request::only(['sede','carrera','asignatura','profesor','anio_academico']), $attributes = ['class'=>'btn btn-secondary'])!!}
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection