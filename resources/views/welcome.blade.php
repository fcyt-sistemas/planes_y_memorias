<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registro de memorias de cátedra y planificaciones</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Acceder</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div>
                    <img src="{{ asset('images/logo_full.jpg') }}" class="img-fluid"></img>
                </div>
                
                <div class="title m-b-md">
                    Planificaciones y Memorias de Cátedras
                </div>

                <div class="links">
                    <a href="#">Documentación</a>
                    <a href="#">Ayuda</a>
                    <a href="#">Notificaciones</a>
                    <a href="#">Novedades</a>
                    <a href="#">Institucional</a>
                </div>
            </div>
        </div>
    </body>
</html>
