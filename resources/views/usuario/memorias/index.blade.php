@extends('layouts.app')
@section('content')

<div class="container">
     @include('usuario.memorias.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header form-inline">
				        <h3 class="col-md-9">Memorias de Cátedra</h3>
    					<div>
        		        	{!!link_to_route('filtertwo', $title = 'Agregar memoria...', $parameters = null, $attributes = ['class'=>'btn btn-secondary', 'id'=>'agregar_memoria'])!!}
        	            </div>
    				</div>
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                  {{Session::get('message')}}
                </div>
                @endif
                <div class="card-body" data-form="deleteForm">
                      <ul class="list-group list-group-flush">
                      @if(count($memorias) == 0)
                      <div class="alert alert-success" role="alert">
                        No hay elementos cargados
                      </div>
                      @endif
                      @foreach($memorias as $m)
                        <li class="list-group-item">
                            @if($m->prev_version<>null & !$m->aprobado) {!!link_to_action('MemoriaController@show', $title = 'PREVIA', $parameters = $m['prev_version'], $attributes = ['class'=>'rev'])!!} @endif
                            @if($m->fecha_entrega<>null & !$m->aprobado) {!!link_to_action('MemoriaController@show', $title = 'ENTREGADA', $parameters = $m['id'], $attributes = ['class'=>'entreg'])!!} @endif
                            @if($m->observado & !$m->aprobado) {!!link_to_action('MemoriaController@show', $title = 'REVISADA', $parameters = $m['id'], $attributes = ['class'=>'rev'])!!} @endif
                            @if($m->aprobado) {!!link_to_action('MemoriaController@show', $title = 'APROBADA', $parameters = $m['id'], $attributes = ['class'=>'aprob'])!!} @endif
                               
                               <b>{{$m->carrera->nombre}}</b> (Plan {{$m->plan->nombre}}, Resol {{$m->plan->nro_resolucion}})</br>
                               <b>{{$m->catedra->nombre}}, {{$m->anio_academico}}</b></br>
                               {{strip_tags($m->equipo_docente)}}</br>
                                <div align="right">
                                <div class="btn-group" role="group">
                                   <div class="btn-group">
                                      @if ($m->observado and !$m->aprobado) {!!link_to_action('MemoriaController@duplicar', $title = 'Nueva Versión', $parameters = $m->id, $attributes = ['class'=>'btn btn-secondary'])!!} @endif
                                      {!!link_to_action('MemoriaController@show', $title = 'Ver', $parameters = $m->id, $attributes = ['class'=>'btn btn-secondary'])!!}
  				                      @if((!($m->observado))and((!($m->aprobado))) ){!!link_to_action('MemoriaController@edit', $title = 'Editar', $parameters = $m->id, $attributes = ['class'=>'btn btn-secondary'])!!} @endif
                                      @if(!$m->observado and!$m->aprobado and !($m->fecha_entrega<>null)){!!link_to_action('MemoriaController@entregar', $title = 'Entregar!', $parameters = $m->id, $attributes = ['class'=>'btn btn-secondary'])!!} @endif
			  	                      @if((!($m->observado))and((!($m->aprobado)))){!!Form::open(['route'=>['memorias.destroy',$m->id],'method'=>'DELETE','class' =>'form-inline form-delete'])!!}
								         {!!Form::submit('Eliminar!',['class'=>'btn btn-danger delete','name' => 'delete_modal'])!!}
				                         {!!Form::close()!!}
				                     @endif
         
			                       </div>
			                      
		                        </div>
 
		                      </div>
		                </li>
                       @endforeach
                       <li class="list-group-item">{{$memorias->links()}}</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
