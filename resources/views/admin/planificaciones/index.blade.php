@extends('layouts.app')
@section('content')

<div class="container">
     @include('admin.planificaciones.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header form-inline">
			        <h4 class="col-md-9">Listado de planificaciones cargadas!</h4>
				</div>
				<div class="card-header justify-content-between">
                    {!! Form::open(['route'=>'planificaciones','method'=>'GET','class'=>'form-inline','role'=>'search']) !!}
                    <div class="row">
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
        					        <label class="input-group-text" for="sede_id">Sede:</label>
        					    </div>
        				      {!! Form::select('sede',$sedes, null,['class'=>'custom-select','id'=>'sedes','placeholder'=>'Seleccione una sede...'] ) !!}
        					</div>
    					</div>

    					<div class="col-2">
    			            <input type="checkbox" name="entregadas" data-size="sm" data-toggle="toggle" data-on="ENTREG" data-off="ENTREG" data-onstyle="secondary" data-offstyle="outline-secondary">
    					</div>
    					<div class="col-2">
    			            <input type="checkbox" name="aprobadas" data-size="sm" data-toggle="toggle" data-on="APROB" data-off="APROB" data-onstyle="success" data-offstyle="outline-success">
    					</div>
    					<div class="col-2">
    			            <input type="checkbox" name="revisadas" data-size="sm" data-toggle="toggle" data-on="REVIS" data-off="REVIS" data-onstyle="danger" data-offstyle="outline-danger">
    					</div>

					</div>
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera',$carreras, null,['class'=>'custom-select','id'=>'carreras','placeholder'=>'Seleccione una carrera..'] ) !!}
					</div>
                    
                     <div class="form-inline">
                        {!! Form::text('asignatura',null,['type'=>'search','class'=>'form-control mr-sm-3','placeholder'=>'Asignatura']) !!}
                        {!! Form::text('profesor',null,['type'=>'search','class'=>'form-control mr-sm-3','placeholder'=>'Apellido profesor']) !!}
                        <button class="btn btn-default my-3 my-sm-0" type="submit">Buscar</button>
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
                               @if($p->entregado) {!!link_to_action('PlanificacionController@show', $title = 'ENTREGADA', $parameters = $p->id, $attributes = ['class'=>'entreg'])!!} @endif
                               @if($p->observado) {!!link_to_action('PlanificacionController@show', $title = 'REVISADA', $parameters = $p->id, $attributes = ['class'=>'rev'])!!} @endif
                               @if($p->aprobado) {!!link_to_action('PlanificacionController@show', $title = 'APROBADA', $parameters = $p->id, $attributes = ['class'=>'aprob'])!!} @endif
                               <br>
                               Docente: <b><i>{{$p->docente->apellidos}}, {{$p->docente->nombres}}</i></b></br>
                               <b>{{$p->carrera->nombre}}</b> (Plan {{$p->plan->nombre}}, Resol {{$p->plan->nro_resolucion}})</br>
                               <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b></br>
                               {{strip_tags($p->equipo_docente)}}</br>
                                <div align="right">
                                <div class="btn-group" role="group">
  			                       <div class="btn-group">
                                     {!!link_to_action('PlanificacionController@show', $title = 'Ver', $parameters = $p->id, $attributes = ['class'=>'btn btn-secondary'])!!}
                                     {!!link_to_action('PlanificacionController@revisar', $title = 'Revisar!', $parameters = $p->id, $attributes = ['class'=>'btn btn-success'])!!}
			                       </div>
		                        </div>
		                      </div>
		                </li>
                       @endforeach
                      <li class="list-group-item">{{$planificaciones->appends(Request::only(['sede','carrera','asignatura','profesor','entregadas','aprobadas','revisadas']))->links()}}
                          <div align="right">
                          <div class="btn">
  				        	{!!link_to_route('reporte.pdf', $title = 'Reporte para Impresión', $parameters = Request::only(['sede','carrera','asignatura','profesor']), $attributes = ['class'=>'btn btn-secondary'])!!}
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
