@extends('layouts.app')
@section('content')

<div class="container">
     @include('admin.revisores.modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuarios Revisores!
                    <div class="button">
		        		{!!link_to_route('revisores.create', $title = 'Agregar usuario revisor...', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
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
                         <li class="list-group-item"> 
                             <div class="row">
                                  <div class="col"><b>Sede</b></div>
                                  <div class="col"><b>Carrera</b></div>
                                  <div class="col"><b>Profesor</b></div>
                                  <div class="col"><b>Acción</b></div>
                            </div> 
                         </li>
                      @foreach($revisores as $r)
                        <li class="list-group-item"> 
		                    <div class="row">
                              <div class="col">{{$r->sede->nombre}}</div>
                              <div class="col">{{$r->carrera->nombre}}</div>
                              @if (empty($r->docente))
                                    @php echo $r->id @endphp
                                @else
                              <div class="col">{{$r->docente->apellidos}}, {{$r->docente->nombres}}</div>
                              @endif
                              <div class="col">
                                <div class="btn-group">
                                 {!!link_to_action('RevisorController@edit', $title = 'Editar', $parameters = $r, $attributes = ['class'=>'btn btn-secondary'])!!}
                                 {!!Form::open(['route'=>['revisores.destroy',$r['id']],'method'=>'DELETE','class' =>'form-inline form-delete'])!!}
								 {!!Form::submit('Eliminar!',['class'=>'btn btn-danger delete','name' => 'delete_modal'])!!}
				                 {!!Form::close()!!}
                                </div>
                                </div>
                            </div> 
		                </li>
                       @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
