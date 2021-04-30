@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Contenidos cargados por el docente {{ Auth::user()->docente->apellidos}}, {{ Auth::user()->docente->nombres}}!</div>
                  <div class="card-body">
                      Planificaciones: {{sizeof($planis)}} {!!link_to_action('PlanificacionController@index', $title = 'Revisar', $parameters = [], $attributes = ['class'=>'btn btn-primary'])!!}
                      
                    <p>
                    <div class="card-deck">
                    <div class="card text-white bg-secondary mb-3">
                      <div class="card-header">{{$dashp['cargadas']}} Cargadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones Cargadas por Ud.</h5>
                        <p class="card-text">Cantidad de planificaciones cargadas por un docente.</p>
                      </div>
                    </div>                      
                    <div class="card text-white bg-primary mb-3" >
                      <div class="card-header">{{$dashp['entregadas']}} Entregadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones entregadas</h5>
                        <p class="card-text">Entregadas por los docentes y puestas a consideración.</p>
                      </div>
                    </div>
                    <div class="card text-white bg-success mb-3">
                      <div class="card-header">{{$dashp['aprobadas']}} Aprobadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones aprobadas</h5>
                        <p class="card-text">Entregadas y aprobadas por una autoridad revisora.</p>
                      </div>
                    </div>
                    <div class="card text-white bg-danger mb-3">
                      <div class="card-header">{{$dashp['revisadas']}} Revisadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones revisadas</h5>
                        <p class="card-text">Fueron entregadas por los docentes, pero fueron observadas por un revisor.</p>
                      </div>
                    </div>

                    </div>
                      Memorias de cátedra: {{sizeof($memos)}} {!!link_to_action('MemoriaController@index', $title = 'Revisar', $parameters = [], $attributes = ['class'=>'btn btn-primary'])!!}
                      <p>
                    <div class="card-deck">
                    <div class="card text-white bg-secondary mb-3">
                      <div class="card-header">{{$dashm['cargadas']}} Cargadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones Cargadas por Ud.</h5>
                        <p class="card-text">Cantidad de planificaciones cargadas por un docente.</p>
                      </div>
                    </div>                      
                    <div class="card text-white bg-primary mb-3" >
                      <div class="card-header">{{$dashm['entregadas']}} Entregadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones entregadas</h5>
                        <p class="card-text">Entregadas por los docentes y puestas a consideración.</p>
                      </div>
                    </div>
                    <div class="card text-white bg-success mb-3">
                      <div class="card-header">{{$dashm['aprobadas']}} Aprobadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones aprobadas</h5>
                        <p class="card-text">Entregadas y aprobadas por una autoridad revisora.</p>
                      </div>
                    </div>
                    <div class="card text-white bg-danger mb-3">
                      <div class="card-header">{{$dashm['revisadas']}} Revisadas</div>
                      <div class="card-body bg-light text-dark">
                        <h5 class="card-title">Planificaciones revisadas</h5>
                        <p class="card-text">Fueron entregadas por los docentes, pero fueron observadas por un revisor.</p>
                      </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
