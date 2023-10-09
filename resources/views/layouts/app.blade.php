<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/arroyave/AVAPP2-02.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    {{-- <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script> --}} 
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css"> --}}
  
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script> --}}

    
</head>
<body>
    <div id="app">
    @if (Auth::check())
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        @endif    
            
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{-- <img src="{{ asset('/images/arroyave/logo.png') }}" class="logo"  style="height: 80px"/> --}}
            {{ config('app.name', 'Laravel') }}
        </a>
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @if (Auth::check())
                    

                    <ul class="navbar-nav mr-auto">
                        <a class="btn btn-primary btn-sm" href="{{ route('testigos.index') }}"> {{ __('Gestion de Testigos') }}</a>  

                        
                        @if (Auth::user()->perfil != 3)
                            {{-- <a class="nav-link" href="{{ route('afiliados.index') }}">{{ __('Listado') }}</a>  
                            <a class="nav-link" href="{{ route('reportes') }}">{{ __('Reportes') }}</a> --}}
                        @endif
                        
                        @if(Auth::user()->perfil == 1 or Auth::user()->perfil == 14)  
                        
                        {{-- <a class="nav-link" href="{{ route('lidere.index') }}">{{ __('Lideres') }}</a>
                        <a class="nav-link" href="{{ route('usuarios.index') }}">{{ __('Activar Usuario') }}</a> --}}
                        @endif  

                        @if (Auth::user()->perfil == 3)
                        {{-- <a class="nav-link" href="{{ route('lidere.index') }}">{{ __('Lideres') }}</a>
                        <a class="nav-link" href="{{ route('reportes') }}">{{ __('Reportes') }}</a>
                        <a class="nav-link" href="{{ route('mapa.index') }}">{{ __('Mapas') }}</a> --}}
                        @endif

                        {{-- @if (Auth::user()->testigo_V == 1)
                        <a class="nav-link" href="{{ route('escrutinio.index') }}">{{ __('Testigo Electoral') }}</a>
                        @endif --}}

                        {{-- <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Eventos
                            </a>

                            @if (Auth::user()->perfil == 14 or Auth::user()->perfil == 24)

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('validador') }}">
                                        {{ __('Validar Asistentes') }}
                                    </a>
                                    @if (Auth::user()->perfil == 1 or Auth::user()->perfil == 14)
                                    <a class="dropdown-item" href="{{ route('asistencia-eventos.index') }}">
                                        {{ __('Reporte de Evento') }}
                                    </a>
                                    @endif
                                    @if (Auth::user()->testigo_V == 1)
                                    <a class="dropdown-item" href="{{ route('escrutinio.index') }}">
                                        {{ __('Testigo Electoral') }}
                                    </a>
                                    @endif
                                </div>
                            <a class="nav-link" href="{{ route('validador') }}">{{ __('Validar asistentes') }}</a>
                            @endif
                        </li> --}}
                    </ul>    
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                        <li class="nav-item">
                            {{-- <a class="navbar-brand">{{ 'Credito: '. number_format(Auth::user()->credito, 0) }}</a> --}}
                        </li>
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif
                            @if (Auth::check())
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                                </li>
                            @endif
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="{{ route('afiliados.show', ['afiliado' => Auth::user()->usuario]) }}">
                                        {{ __('Atualizar mis datos') }}
                                    </a> --}}
                                    
                                    <a class="dropdown-item">{{ 'Credito: '. number_format(Auth::user()->credito, 0) }}</a>
                                    {{-- <a class="dropdown-item" href="{{ route('usuarios.edit', ['usuario' => Auth::user()->id]) }}">
                                        {{ __('Cambiar contraseña') }}
                                    </a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
        @yield('js')
</body>
</html>
