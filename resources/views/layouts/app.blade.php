<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> <!-- Mi estilo -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles

    @stack('css')

    <style>
    .navbar-button{
        border-radius: 5px;
        background: #065694;
        margin: 5px;
    }

    /* #navbarSupportedContent{
        margin-left: 5px;
        margin-right: 5px;
    } */
</style>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img width="100px" src="{{asset('recursos/logo-makro.svg')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item navbar-button">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown navbar-button">
                                <a id="navbarDropdownEmpresas" class="nav-link dropdown-toggle text-white mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-building"></i> EMPRESAS
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="https://www.constructoramakro.com">
                                        {{ __('Web Makro') }}
                                    </a>
                                    <a class="dropdown-item" href="https://www.magnamaq.com">
                                        {{ __('Web MagnaMaq') }}
                                    </a>
                                    <a class="dropdown-item" href="https://www.trituasfaltos.com">
                                        {{ __('Web TrituAsfaltos') }}
                                    </a>
                                    <a class="dropdown-item" href="https://www.magnamaq.mx">
                                        {{ __('intranet MagnaMaq') }}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown navbar-button">
                                <a id="navbarDropdownCorreo" class="nav-link dropdown-toggle text-white mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-envelope"></i> CORREO
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="https://outlook.office365.com/mail/">
                                        {{ __('Microsoft 365') }}
                                    </a>
                                    <a class="dropdown-item" href="https://host2068.hostmonster.com:2083/">
                                        {{ __('Host Moster (.com.mx)') }}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item navbar-button">
                                <a class="nav-link text-white mx-2" href="{{ route('ckeck') }}"><i class="fa-solid fa-check-to-slot"></i> {{ __('CHECADOR') }}</a>
                            </li>
                            <li class="nav-item dropdown navbar-button">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-uppercase text-white mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Mi perfil') }}
                                    </a>

                                    @can('admin.home')
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            {{ __('Panel de control') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesi贸n') }}
                                    </a> --}}

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

        <main>
            @yield('content')
        </main>
    </div>
    @livewireScripts
    @yield('js')
    @stack('js')
</body>
</html>
