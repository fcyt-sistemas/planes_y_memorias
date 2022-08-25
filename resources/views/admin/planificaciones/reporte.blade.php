<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 200px 25px 50px 50px; /** arriba derecha abajo izquierda**/
            }

            header {
                position: fixed;
                top: -150px;
                left: 0px;
            }
            </style>
    </head>
    <body>
        <header>
            <img style="width:30%;" src="data:image/png;base64,{{ $image }}"></img>
            <h2 style="text-align: center;">Reporte de Planificaciones de las Cátedras</h2>
        </header>
        <footer>
            {PAGE_NUM} of {PAGE_COUNT}
        </footer>
        <main>
            <table style="width: 700px; padding: 5px;">
                <?php 
                    $c = ""; 
                    $m1 = 0; //Materias de la carrera X
                    $e=0; //Entregadas de la carrera X
                    $a = 0; //aprobadas de la carrera X
                    $o = 0; // observadas de la carrera x 
                ?>
                @foreach ($plani as $p)
                    @if($p['anio_academico'].$p['sede'].$p['carrera'] != $c)
                        @if($c != "")
                        <!-- Total por TABLA -->
                        
                            <tr>
                                <td colspan="3">
                                    <table width="100%">
                                        <tr>
                                            <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                                <b>MATERIAS DE LA CARRERA:    </b> {{ $cant_mat[$p['id_carrera']] }}
                                            </td>
                                            <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                                <b>PLANIFICACIONES OBTENIDAS: </b> {{$m1}}
                                                <br><b>ENTREGADAS: </b>{{$e}}
                                                <br><b>APROBADAS: </b>{{$a}}
                                                <br><b>REVISADAS: </b>{{$o}}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="3" style="text-align:center;">&nbsp;</td></tr>
                            <tr><td colspan="3" style="text-align:center;">&nbsp;</td></tr>
                        @endif
                        <tr>
                            <td colspan="3" style="text-align:center;  border-width:1px;">
                                <b>AÑO ACADEMICO:    </b> {{ $p['anio_academico']}}
                                <br><b>CARRERA:   </b> {{$p['carrera']}}
                                <br><b>SEDE:   </b> {{$p['sede']}}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border:1px solid #000;"><b>MATERIA</b> </td>
                            <td style="text-align:center; border:1px solid #000;"><b>EQUIPO DOCENTE </b></td>
                            <td style="text-align:center; border:1px solid #000;"><b>ESTADO</b> </td>
                        </tr>
                        <?php
                            $m1 = 0; //Materias de la carrera X
                            $e=0; //Entregadas de la carrera X;
                            $a = 0; //aprobadas de la carrera X;
                            $o = 0; // observadas de la carrera x 
                        ?>
                    @endif
                    <?php
                        $m1++;
                        if($p['estado']=='APROBADO'){
                            $a++;
                        }
                        elseif ($p['estado']=='ENTREGADO') {
                            $e++;
                        }
                        elseif ($p['estado']=='REVISADO') {
                            $o++;
                        }
                    ?>
                    <tr>
                        <td style="text-align:left; border:1px solid #000; padding: 5px;">{{$p['catedra']}}</td>
                        <td style="text-align:left; border:1px solid #000; padding: 5px;">{{$p['equipo_docente']}}</td>
                        <td style="text-align:center; border:1px solid #000;"> {{$p['estado']}}</td>
                    </tr>


                    <?php 
                        $c = $p['anio_academico'].$p['sede'].$p['carrera'];
                        
                    ?> 
                
                @endforeach
                    <!-- Total por Sede -->
                    <tr><td colspan="3" style="text-align:center;">&nbsp;</td></tr>
                    <tr><td colspan="3" style="text-align:center;">&nbsp;</td></tr>
                    <tr>
                        <td colspan="3">
                            <table width="100%">
                                <tr>
                                    <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                        <b>MATERIAS DE LA CARRERA:    </b> {{ $cant_mat[$p['id_carrera']] }}
                                    </td>
                                    <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                        <b>PLANIFICACIONES OBTENIDAS: </b> {{$m1}}
                                        <br><b>ENTREGADAS: </b>{{$e}}
                                        <br><b>APROBADAS: </b>{{$a}}
                                        <br><b>REVISADAS: </b>{{$o}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <!-- Total de totales -->
                <tr><td colspan="3" style="text-align:center;">&nbsp;</td></tr>
                <tr><td colspan="3" style="text-align:center;">&nbsp;</td></tr>
                <tr>
                    <td colspan="3" style="text-align:center; padding: 5px;">
                        <br><br><b>TOTALES 
                        <br><b>TOTAL MATERIAS:    </b> {{$materia}}
                        <br><b>TOTAL APROBADAS:   </b> {{$ap}}
                        <br><b>TOTAL REVISADAS:   </b> {{$ob}}
                        <br><b>TOTAL ENTREGADAS:  </b> {{$en}}
                    </td>
                </tr>
            </table>
        </main>
    </body>
</html>