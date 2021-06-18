<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Programa de contenidos extraído de las Memorias de cátedra</title>
    </head>
<body>

<div class="container">
    <img src="{{ asset('images/logo-tr.png') }}"></img>
    &nbsp;&nbsp;&nbsp;{{ config('app.name', 'Laravel') }}
    <br><br>
    <div class="card">    
        <div class="card-body" data-form="deleteForm">
                     <ul class="list-group list-group-flush">
                      @if(count($memorias) === 0)
                          <div class="alert alert-success" role="alert">
                            No hay elementos cargados
                          </div>
                      @endif  
                      @foreach($memorias as $m)
                        <li class="list-group-item"> 
                               Docente: <b><i>{{$m->docente->apellidos}}, {{$m->docente->nombres}}</i></b></br>
                               <b>{{$m->carrera->nombre}}</b> (Plan {{$m->plan->nombre}}, Resol {{$m->plan->nro_resolucion}})</br>
                               <b>{{$m->catedra->nombre}}, {{$m->anio_academico}}</b></br>
                               {{strip_tags($m->equipo_docente)}}</br>
		                </li>
                       @endforeach
                    </ul>
            </div>
    </div>
</div>
</body>
</html>
