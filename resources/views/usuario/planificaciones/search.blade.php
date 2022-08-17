@extends('layouts.app')
@section('content')

<div class="container">
     @include('usuario.planificaciones.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header form-inline">
			        <h4 class="col-md-9">Listado de planificaciones cargadas!</h4>
				</div>
				<div class="card-header justify-content-between">
                    {!! Form::open(['route'=>'planisearch','method'=>'GET','class'=>'form-inline','role'=>'search']) !!}
                     <div class="form-inline">
                        {!! Form::text('asignatura',null,['type'=>'search','class'=>'form-control mr-sm-3','placeholder'=>'Asignatura']) !!}
                        {!! Form::text('profesor',null,['type'=>'search','class'=>'form-control mr-sm-3','placeholder'=>'Apellido profesor']) !!}
                        <button class="btn btn-default my-3 my-sm-0"type="submit">Buscar</button>
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
                      @if(count($planificaciones) === 0)
                          <div class="alert alert-success" role="alert">
                            No hay elementos cargados
                          </div>
                      @endif  
                      @foreach($planificaciones as $p)
                        <li class="list-group-item"> 
                               @if($p->observado) {!!link_to_action('PlanificacionController@show', $title = 'REVISADA', $parameters = $p['id'], $attributes = ['class'=>'rev'])!!} @endif
                               @if($p->aprobado) {!!link_to_action('PlanificacionController@show', $title = 'APROBADA', $parameters = $p['id'], $attributes = ['class'=>'aprob'])!!} @endif
                               Docente: <b><i>{{$p->docente->apellidos}}, {{$p->docente->nombres}}</i></b></br>
                               <b>{{$p->carrera->nombre}}</b> (Plan {{$p->plan->nombre}}, Resol {{$p->plan->nro_resolucion}})</br>
                               <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b></br>
                               {{strip_tags($p->equipo_docente)}}</br>
                                <div align="right">
                                <div class="btn-group" role="group">
  			                       <div class="btn-group">
                                     {!!link_to_action('PlanificacionController@show', $title = 'Ver', $parameters = $p['id'], $attributes = ['class'=>'btn btn-secondary'])!!}
			                       </div>
		                        </div>
		                      </div>
		                </li>
                       @endforeach
                        <li class="list-group-item">{{$planificaciones->appends(Request::only(['asignatura','profesor']))->links()}}</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
