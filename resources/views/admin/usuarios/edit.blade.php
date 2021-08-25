@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar usuario!</div>
                <div class="card-body">
                {!! Form::model($usuario,['route'=>['usuarios.update',$usuario->id], 'method' => 'PUT'])!!}

                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="name">Nombre de Usuario:</label>
                        </div>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $usuario->name }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="email">EMail:</label>
                        </div>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuario->email }}" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="role">Rol:</label>
                        </div>
                        <select name="role" id="role" required>
                            <option value="{{$rol->name}}" selected disabled hidden>{{$rol->description}}</option>
                            @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-group" role="group">
                        <div class="btn-group">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
                        </div>
                        <div class="btn-group">
                            {!!link_to_route('usuarios', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection