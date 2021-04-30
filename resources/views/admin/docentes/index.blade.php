@extends('layouts.app')
@section('content')

<div class="container">
     @include('admin.docentes.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header justify-content-between">Listado de docentes!
                    {!! Form::open(['route'=>'docentes','method'=>'GET','class'=>'form-inline','role'=>'search']) !!}
                    <div class="button">
		        		{!!link_to_route('docentes.create', $title = 'Agregar un docente...', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
	             	</div>
                    <div class="form-inline">
                        {!! Form::text('nombre',null,['type'=>'search','class'=>'form-control mr-sm-2','placeholder'=>'Búsqueda por nombre']) !!}    
                        <button class="btn btn-default my-2 my-sm-0"type="submit">Buscar</button>
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
                        <li class="list-group-item"> 
                             <div class="row">
                                  <div class="col"><b>Apellidos</b></div>
                                  <div class="col"><b>Nombres</b></div>
                                  <div class="col"><b>Nº documento</b></div>
                                  <div class="col"><b>Localidad</b></div>
                                  <div class="col"><b>Operación</b></div>
                            </div> 
		                </li>
                      @foreach($docentes as $r)
                        <li class="list-group-item"> 
		                    <div class="row">
                              <div class="col">{{$r->apellidos}}</div>
                              <div class="col">{{$r->nombres}}</div>
                              <div class="col">{{$r->nro_documento}}</div>
                              <div class="col">{{$r->localidad}}</div>
                              <div class="col">
                                <div class="btn-group">
                                 {!!link_to_action('DocenteController@edit', $title = 'Editar', $parameters = $r, $attributes = ['class'=>'btn btn-secondary'])!!}
                                 {!!Form::open(['route'=>['docentes.destroy',$r['id']],'method'=>'DELETE','class' =>'form-inline form-delete'])!!}
								 {!!Form::submit('Eliminar!',['class'=>'btn btn-danger delete','name' => 'delete_modal'])!!}
				                 {!!Form::close()!!}
                                </div>
                                </div>
                            </div> 
		                </li>
                       @endforeach
                       <li class="list-group-item">{{$docentes->links()}}</li>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
