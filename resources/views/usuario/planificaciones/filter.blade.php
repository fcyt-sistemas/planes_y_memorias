@extends('layouts.app')
@section('content')
<script>
    tinymce.init({
        selector:'textarea', 
        menubar: false,
        language: 'es',
        branding: false,
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">La Planificación que desea crear es para:</div>
                    <div class="card-body">
                        @include('errors')
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-danger" role="alert">
                                <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        {!! Form::open(['action' => 'FilterPlaniController@store','method' => 'POST'])!!}
                        {!! Form::hidden('docente_id', Auth::user()->docente->id) !!}
                        
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sede_id">Sede:</label>
                        </div>
                        {!! Form::select('sede_id',$sedes, null,['id'=>'sedes','placeholder'=>'Seleccione una sede...'] ) !!}
                        </div>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sede_id">Carrera:</label>
                        </div>
                        {!! Form::select('carrera_id',$carreras, null,['id'=>'carreras','placeholder'=>'Seleccione una carrera'] ) !!}
                        </div>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sede_id">Catedra:</label>
                        </div>
                        {!! Form::select('catedra_id', $catedras,null, ['id'=>'catedras', 'placeholder'=>'Seleccione una cátedra']) !!}
                        </div>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sede_id">Año académico:</label>
                        </div>
                        {!! Form::number('anio_academico',date('Y'), ['class'=>'form-control']) !!}
                        </div>
                        <div class="btn-group" role="group">
                            <div class="btn-group">
                                {!!link_to_route('create', $title = 'Aceptar y Continuar', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                          </div>
                          <div class="btn-group">
                                {!!link_to_route('planificaciones.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
                          </div>
                      </div>
                        {!! Form::close() !!}
				    </div>
            </div>
        </div>
    </div>
</div>
@endsection
