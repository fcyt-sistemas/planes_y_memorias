@extends('layouts.app')
@section('content')

<div class="container">
     @include('usuario.planificaciones.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="utf8">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="col-md-9">Listado de planificaciones!</h4>
                        <div class="button push-right">
                            {!!link_to_route('planificaciones.create', $title = 'Agregar planificación..', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
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
                        @if(count($planificaciones) === 0)
                            <div class="alert alert-success" role="alert">
                                No hay elementos cargados
                            </div>
                        @endif
                        @foreach($planificaciones as $p)
                            <li class="list-group-item">
                                @if($p->prev_version<>null & !$p->aprobado) {!!link_to_action('PlanificacionController@show', $title = 'PREVIA', $parameters = $p['prev_version'], $attributes = ['class'=>'rev'])!!} @endif
                                @if($p->fecha_entrega<>null & !$p->aprobado) {!!link_to_action('PlanificacionController@show', $title = 'ENTREGADA', $parameters = $p['id'], $attributes = ['class'=>'entreg'])!!} @endif
                                @if($p->observado & !$p->aprobado) {!!link_to_action('PlanificacionController@show', $title = 'REVISADA', $parameters = $p['id'], $attributes = ['class'=>'rev'])!!} @endif
                                @if($p->aprobado) {!!link_to_action('PlanificacionController@show', $title = 'APROBADA', $parameters = $p['id'], $attributes = ['class'=>'aprob'])!!} @endif
                                <b>{{$p->carrera->nombre}}</b> Resol {{$p->plan->nro_resolucion}}</br>
                                <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b></br>
                                {{strip_tags($p['equipo_docente'])}}</br>
                                    <div align="right">
                                    <div class="btn-group" role="group">
                                    <div class="btn-group">
                                        @if ($p->observado and !$p->aprobado) {!!link_to_action('PlanificacionController@duplicar', $title = 'Nueva Versión', $parameters = $p->id, $attributes = ['class'=>'btn btn-secondary'])!!} @endif
                                        {!!link_to_action('PlanificacionController@show', $title = 'Ver', $parameters = $p['id'], $attributes = ['class'=>'btn btn-secondary'])!!}
                                        @if((!($p->observado))and((!($p->aprobado))) ){!!link_to_action('PlanificacionController@edit', $title = 'Editar', $parameters = $p['id'], $attributes = ['class'=>'btn btn-secondary'])!!} @endif
                                        @if(!$p->observado and!$p->aprobado and !($p->fecha_entrega<>null)){!!link_to_action('PlanificacionController@entregar', $title = 'Entregar!', $parameters = $p->id, $attributes = ['class'=>'btn btn-secondary'])!!} @endif
                                        @if((!($p->observado))and((!($p->aprobado)))){!!Form::open(['route'=>['planificaciones.destroy',$p['id']],'method'=>'DELETE','class' =>'form-inline form-delete'])!!}
                                            {!!Form::submit('Eliminar!',['class'=>'btn btn-danger delete','name' => 'delete_modal'])!!}
                                            {!!Form::close()!!}
                                        @endif
            
                                    </div>
                                    
                                    </div>
    
                                </div>
                            </li>
                        @endforeach
                        <li class="list-group-item">{{$planificaciones->links()}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
