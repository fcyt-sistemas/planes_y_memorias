<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-12">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/modal.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    
    <!-- Toggles Switch -->
    <link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- TinyMCE -->
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <img src="{{ asset('images/logo-tr.png') }}"></img>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a></li>
                        @else
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Inicio') }}</a>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     {{ Auth::user()->name }} ({{Auth::user()->roles()->where('name', \Session::get('tipoUsuario'))->first()->description}}) <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(\Session::get('tipoUsuario')=='control' && Auth::user()->hasRole('user'))
                                    <a class="dropdown-item" href="{{ url('/perfil/user') }}">
                                         {{ __('Entrar como Docente') }}
                                    </a>  
                                    @endif
                                    @if(\Session::get('tipoUsuario')=='user' && Auth::user()->hasRole('control'))
                                    <a class="dropdown-item" href="{{ url('/perfil/control') }}">
                                         {{ __('Entrar como Controlador') }}
                                    </a>  
                                    @endif
                                    @if(Auth::user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('revisores') }}">
                                         {{ __('Administrar Revisores') }}
                                    </a>  
                                    <a class="dropdown-item" href="{{ route('docentes') }}">
                                         {{ __('Administrar Docentes') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('usuarios') }}">
                                         {{ __('Administrar Usuarios') }}
                                    </a>    
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  
                                    
                                </div>
                                

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>