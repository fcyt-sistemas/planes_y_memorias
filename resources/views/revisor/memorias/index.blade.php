@extends('layouts.app')
@section('content')

<div class="container">
     @include('revisor.memorias.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header form-inline">
				        <h3 class="col-md-9">Memorias de Cátedra (revisión)</h3>
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
                               @if($m->observado) {!!link_to_action('MemoriaController@show', $title = 'REVISADA', $parameters = $m['id'], $attributes = ['class'=>'rev'])!!} @endif
                               @if($m->aprobado) {!!link_to_action('MemoriaController@show', $title = 'APROBADA', $parameters = $m['id'], $attributes = ['class'=>'aprob'])!!} @endif
                               </br>
                               Docente: <b><i>{{$m->docente->apellidos}}, {{$m->docente->nombres}}</i></b></br>
                               <b>{{$m->carrera->nombre}}</b> (Plan {{$m->plan->nombre}}, Resol {{$m->plan->nro_resolucion}})</br>
                               <b>{{$m->catedra->nombre}}, {{$m->anio_academico}}</b></br>
                               {{strip_tags($m['equipo_docente'])}}</br>
                                <div align="right">
                                <div class="btn-group" role="group">
  			                       <div class="btn-group">
                                     {!!link_to_action('MemoriaController@show', $title = 'Ver', $parameters = $m['id'], $attributes = ['class'=>'btn btn-secondary'])!!}
                                     @if(!$m->aprobado){!!link_to_action('MemoriaController@revisar', $title = 'Revisar!', $parameters = $m['id'], $attributes = ['class'=>'btn btn-success'])!!} @endif
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
