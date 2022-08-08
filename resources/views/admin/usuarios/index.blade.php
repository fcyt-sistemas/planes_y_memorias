@extends('layouts.app')
@section('content')

<div class="container">
     @include('admin.usuarios.modal')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">Listado de usuarios!
                    {!! Form::open(['route'=>'usuarios','method'=>'GET','class'=>'form-inline','role'=>'search']) !!}
                    <div class="button">
		        		{!!link_to_route('usuarios.create', $title = 'Agregar un usuario...', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
	             	</div>
                    <div class="form-inline">
                        {!! Form::text('name',null,['type'=>'search','class'=>'form-control mr-sm-2','placeholder'=>'Búsqueda por Nombre']) !!}
                        {!! Form::text('email',null,['type'=>'search','class'=>'form-control mr-sm-2','placeholder'=>'Búsqueda por email']) !!}
                        <div class="input-group mb-3">
      
                            <select name="role_user" id="role_user">
                                <option value="" selected disabled hidden>Seleccione un rol...</option>
                                @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->description}}</option>
                                @endforeach
                            </select>
                        </div>    
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
                                  <div class="col"><b>Nombre</b></div>
                                  <div class="col"><b>Email</b></div>
                                  <div class="col"><b>Operacion</b></div>
                            </div> 
		                </li>
                      @foreach($usuarios as $r)
                        <li class="list-group-item"> 
		                    <div class="row">
                              <div class="col">{{$r->name}}</div>
                              <div class="col">{{$r->email}}</div>
                              <div class="col">
                                <div class="btn-group">
                                 {!!link_to_action('UserController@edit', $title = 'Editar', $parameters = $r, $attributes = ['class'=>'btn btn-secondary'])!!}
                                 {!!Form::open(['route'=>['usuarios.destroy',$r['id']],'method'=>'DELETE','class' =>'form-inline form-delete'])!!}
								 {!!Form::submit('Eliminar!',['class'=>'btn btn-danger delete','name' => 'delete_modal'])!!}
				                 {!!Form::close()!!}
                                </div>
                                </div>
                            </div> 
		                </li>
                       @endforeach
                       <li class="list-group-item">{{$usuarios->links()}}</li>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
