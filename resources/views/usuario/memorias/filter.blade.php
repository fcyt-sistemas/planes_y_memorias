@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                   <div class="card-header justify-content-between">
                    <div class="card-header">La Memoria que desea crear es para:</div>
                    {!! Form::open(['action' => 'MemoriaController@control','method' => 'POST'])!!}
                        @if(Session::has('message'))
                            <div class="alert alert-danger alert-danger" role="alert">
                                <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <label class="input-group-text" for="sede_id">Sede:</label>
                            </div>
                            {!! Form::select('sede',$sedes, null,['style'=>'width: 700px', 'class'=>'custom-select','id'=>'sedes','placeholder'=>'Seleccione una sede...'] ) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <label class="input-group-text" for="carreras_seleccion">Carrera:</label>
                            </div>
                            {!! Form::select('carrera',$carreras, null,['style'=>'width: 700px', 'class'=>'custom-select','id'=>'carreras_seleccion','placeholder'=>'Seleccione una carrera..'] ) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="sede_id">Catedra:</label>
                            </div>
                            {!! Form::select('catedra', $catedras,null, ['style'=>'width: 800px', 'id'=>'catedras', 'placeholder'=>'Seleccione una cátedra']) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <label class="input-group-text" for="anio_academico">Año Academico:</label>
                            </div>
                            {!! Form::select('anio_academico',$anio_academico, null,['style'=>'width: 700px', 'class'=>'custom-select','id'=>'anio_academico','placeholder'=>'Seleccione un año academico..'] ) !!}
                        </div>
                
                        <br>                    
                            <div><button class="btn btn-primary" type="submit">Aceptar y Continuar</button>
                                <div class="btn-group">
                                    {!!link_to_route('memorias', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
