<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 200px 25px 80px 50px; /** arriba derecha abajo izquierda**/
            }

            header {
                position: fixed;
                top: -150px;
                left: 0px;
            }
            footer{
                position: fixed;
                bottom: -30px;
            }
            #footer .page:after {content: counter(page);}
        </style>
    </head>
    <body>
        <header>
            <img style="width:30%;" src="data:image/png;base64,{{ $image }}">
            <h2 style="text-align: center;">Reporte de Memorias de las Cátedras</h2>
        </header>
        <footer>
            <?php
                if ( isset($pdf) ) {
                    $font = $pdf->get_font();
                    $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(255,0,0));
                }
            ?>
        </footer>
        @if(count($memorias) === 0)
            <div class="alert alert-success" role="alert">
                No hay elementos cargados
            </div>
        @endif  
        <table>
            <?php 
                $c = ""; 
                $m1 = 0; //Materias de la carrera X
                $e=0; //Entregadas de la carrera X;
                $a = 0; //aprobadas de la carrera X;
                $o = 0; // observadas de la carrera x 
            ?>
            @foreach($memo as $m)
                @if($m['anio_academico'].$m['sede'].$m['carrera'] != $c)
                    @if($c != "")
                        <!-- Total por TABLA -->
                        
                            <tr>
                                <td colspan="3">
                                    <table width="100%">
                                        <tr>
                                            <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                                <b>MATERIAS DE LA CARRERA:    </b> {{ $cant_mat[$m['id_carrera']] }}
                                            </td>
                                            <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                                <b>MEMORIAS OBTENIDAS: </b> {{$m1}}
                                                <br><b>ENTREGADAS: </b>{{$e}}
                                                <br><b>APROBADAS: </b>{{$a}}image
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
                        <b>AÑO ACADEMICO:    </b> {{ $m['anio_academico']}}
                        <br><b>CARRERA:   </b> {{$m['carrera']}}
                        <br><b>SEDE:   </b> {{$m['sede']}}
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
                    if($m['estado']=='APROBADO'){
                        $a++;
                    }
                    elseif ($m['estado']=='ENTREGADO') {
                        $e++;
                    }
                    elseif ($m['estado']=='REVISADO') {
                        $o++;
                    }
                ?>
                <tr>
                    <td style="text-align:left; border:1px solid #000; padding: 5px;">{{$m['catedra']}}</td>
                    <td style="text-align:left; border:1px solid #000; padding: 5px;">{{$m['equipo_docente']}}</td>
                    <td style="text-align:center; border:1px solid #000;"> {{$m['estado']}}</td>
                </tr>


                <?php 
                    $c = $m['anio_academico'].$m['sede'].$m['carrera'];
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
                                        <b>MATERIAS DE LA CARRERA:    </b> {{ $cant_mat[$m['id_carrera']] }}
                                    </td>
                                    <td style="text-align:left;  border:1px solid #000; padding: 5px; width:45%;">
                                        <b>MEMORIAS OBTENIDAS: </b> {{$m1}}
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
    </body>
</html>