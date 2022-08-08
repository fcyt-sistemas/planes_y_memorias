@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                  <div class="card-body">
                    <!DOCTYPE html>
                      <html lang="en" style="height: auto;">
                      <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <link rel="stylesheet" href="/AdminLte/plugins/fontawesome-free/css/all.min.css">
                        <link rel="stylesheet" href="/AdminLte/css/adminlte.min.css">
                        <label><H2>PLANIFICACIONES<a href="{{ route('planificaciones.filter') }}" class="small-box-footer">  Ver <i class="fas fa-arrow-circle-right"></i></a></H2></label>
                      </head>  
                        <body>
                          <div class="row">
                            <div class="col-lg-3 col-6">
                            
                              <div class="small-box bg-info">
                              <div class="inner">
                                <h3>{{$dashp['entregadas']}}</h3>
                                <p>Todas las Entregadas</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                            </div>
                          </div>
                              
                          <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                              <div class="inner">
                                <h3>{{$dashp['aprobadas']}}<sup style="font-size: 20px"></sup></h3>
                                <p>Aprobadas</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                              </div>
                            </div>
                          </div>
                              
                            <div class="col-lg-3 col-6">
                              <div class="small-box bg-warning">
                                <div class="inner">
                                  <h3>{{$dashp['norevis']}}</h3>
                                  <p>A Revisar</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-person-add"></i>
                                </div>
                              </div>
                            </div>
                              
                            <div class="col-lg-3 col-6">
                              <div class="small-box bg-danger">
                                <div class="inner">
                                  <h3>{{$dashp['revisadas']}}</h3>
                                  <p>Revisadas</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-pie-graph"></i>
                                </div>
                                </div>
                              </div>
                            </div>

                            <label><H2>MEMORIAS<a href="{{ route('memorias.filter') }}" class="small-box-footer" style="align: center;"> Ver <i class="fas fa-arrow-circle-right"></i></a></H2></label>
                            <div class="row">
                              <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                  <h3>{{$dashm['entregadas']}}</h3>
                                  <p>Todas las Entregadas</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-bag"></i>
                                </div>
                               
                              </div>
                            </div>
                                
                            <div class="col-lg-3 col-6"> 
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3>{{$dashm['aprobadas']}}<sup style="font-size: 20px"></sup></h3>
                                  <p>Aprobadas</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-stats-bars"></i>
                                </div>
                                
                              </div>
                            </div>
                                
                              <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                  <div class="inner">
                                  <h3>{{$dashm['norevis']}}</h3>
                                    <p>A Revisar</p>
                                  </div>
                                  <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                  </div>
                                  
                                </div>
                              </div>
                                
                              <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                  <div class="inner">
                                    <h3>{{$dashm['revisadas']}}</h3>
                                    <p>Revisadas</p>
                                  </div>
                                  <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                  </div>
                                   
                                  </div>
                                </div>
                              
                              </div>
                          
                        </body>
                    </html>
                 </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

