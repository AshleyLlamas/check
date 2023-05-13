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

    <style type="text/css">

        .navbar-button{
                border-radius: 5px;
                background: #065694;
                margin: 5px;
            }

    /* ============ desktop view ============ */
        @media all and (min-width: 992px) {
        /* @media all and (min-width: 1492px) { */

            .dropdown-menu li{
                position: relative;
            }
            .dropdown-menu .submenu{
                display: none;
                position: absolute;
                left:100%; top:-7px;
            }
            .dropdown-menu .submenu-left{
                right:100%; left:auto;
            }

            .dropdown-menu > li:hover{ background-color: #f1f1f1 }
            .dropdown-menu > li:hover > .submenu{
                display: block;
            }
        }
        /* ============ desktop view .end// ============ */

        /* ============ small devices ============ */
        @media (max-width: 991px) {
        /* @media (max-width: 1491px) { */

        .dropdown-menu .dropdown-menu{
                margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
        }

        }
        /* ============ small devices .end// ============ */

    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
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



                        @if(\Auth::guard('device')->user())

                            <li class="nav-item dropdown navbar-button">
                                <a id="navbarDropdownDivace" class="nav-link dropdown-toggle text-uppercase text-white mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-mobile-screen-button"></i> {{\Auth::guard('device')->user()->name}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownDivace">

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

                        @else
                            @guest
                                <li class="nav-item navbar-button">
                                    <a class="nav-link text-white" href="{{ route('deviceLogin') }}"><i class="fa-solid fa-mobile-screen-button"></i> INGRESAR COMO DISPOSITIVO</a>
                                </li>

                                @if (Route::has('login'))
                                    <li class="nav-item navbar-button">
                                        <a class="nav-link text-white" href="{{ route('login') }}"><i class="fa-solid fa-user"></i> INGRESAR COMO USUARIO</a>
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
                                        <i class="fa-solid fa-handshake-angle"></i> SOPORTE PARA EMPLEADOS
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="https://anydesk.com/es/downloads/windows?dv=win_exe" target="_blank">
                                            {{ __('Descargar Any Desk') }}
                                        </a>
                                        <a class="dropdown-item" href="https://makroti.zohodesk.com/portal/es/signin" target="_blank">
                                            {{ __('Help Desk - Mesa de ayuda') }}
                                        </a>
                                        <a class="dropdown-item" href="https://api.whatsapp.com/send?phone=526648055283" target="_blank">
                                            {{ __('Whatsapp') }}
                                        </a>
                                    </div>
                                </li>

                                {{-- EMPRESAS --}}
                                {{-- <li class="nav-item dropdown navbar-button">
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
                                            {{ __('Sistema MagnaMaq') }}
                                        </a>
                                    </div>
                                </li> --}}

                                {{-- EMPRESAS --}}
                                <li class="nav-item dropdown navbar-button">
                                    <a class="nav-link dropdown-toggle text-white mx-2" href="#" data-bs-toggle="dropdown">
                                        <i class="fas fa-building"></i> EMPRESAS
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#"> Sitio Oficial Grupo Makro  &raquo; </a>
                                            <ul class="submenu dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="www.constructoramakro.com">
                                                        {{ __('Constructora Makro') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="www.magnamaq.com">
                                                        {{ __('Magnamaq ') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="www.trituasfaltos.com">
                                                        {{ __('Trituasfaltos ') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="www.gusa.us">
                                                        {{ __('GUSA ') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="www.civsa.com">
                                                        {{ __('CIVSA') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <a class="dropdown-item" target="_blank" href="https://constructoramakro111-my.sharepoint.com/:f:/g/personal/unidad_constructoramakro_com/Ep2VxGkAeYlOtMhlPOPrAtABTnyA0Ql9eq0-1j2S-TwpQA?e=hZa7lg">
                                            {{ __('Contexto de Makro') }}
                                        </a>
                                        <a class="dropdown-item" target="_blank" href="https://constructoramakro111-my.sharepoint.com/:f:/g/personal/unidad_constructoramakro_com/El-wFFx2HIxDlp8ejw4nEzAB0Vce44ZNoZzeX_UvjoGagA?e=IFVTH6">
                                            {{ __('Misión y Visión') }}
                                        </a>
                                        <a class="dropdown-item" target="_blank" href="https://www.trituasfaltos.com">
                                            {{ __('Valores, principios y filosofia') }}
                                        </a>
                                        <a class="dropdown-item" target="_blank" href="https://constructoramakro111-my.sharepoint.com/:f:/g/personal/unidad_constructoramakro_com/EqV8GxTlc1NMn64x4a1LGH8B_tlf2XQURNbk0GwyKf_kGA?e=cqj2yf">
                                            {{ __('Sistema MagnaMaq') }}
                                        </a>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown navbar-button">
                                    <a id="navbarDropdownSolicitud" class="nav-link dropdown-toggle text-white mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa-solid fa-circle"></i> SERVICIOS
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="https://www.magnamaq.mx/" target="_blank">
                                            {{ __('Sistema Magnamaq') }}
                                        </a>

                                        <a class="dropdown-item" href="https://forms.office.com/pages/responsepage.aspx?id=MfLHHrZcwEu6f6adwbQM-cVOG8dGiAhLhAEYTDag-rtUMDVFTlk4V01MMVU1UzdZUUlHOFBZQzMwUCQlQCN0PWcu" target="_blank">
                                            {{ __('Solicitud de Servicio Técnico') }}
                                        </a>

                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Solicitud de Vacaciones / Ausencia') }}
                                        </a>

                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Solicitudes de RH') }}
                                        </a>

                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Solicitudes de CO') }}
                                        </a>

                                        <a class="dropdown-item" href="https://constructoramakro111-my.sharepoint.com/:f:/g/personal/unidad_constructoramakro_com/EgT7jeYGkYpFvnLtd0F_XRAB1A2CnBz8Z3dsBQCJQkouEg?e=fZHrgx" target="_blank">
                                            {{ __('Procedimientos y formatos') }}
                                        </a>

                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Makro en la Nube') }}
                                        </a>
                                    </div>
                                </li>

                                {{-- USUARIOS --}}
                                <li class="nav-item dropdown navbar-button">
                                    <a class="nav-link dropdown-toggle text-white mx-2" href="#" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-users"></i> USUARIOS
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('ckeck') }}">Checador </a></li>
                                        <li><a class="dropdown-item" href="#"> Correos &raquo; </a>
                                            <ul class="submenu dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="https://outlook.office365.com/mail/">
                                                        {{ __('Microsoft 365') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="https://host2068.hostmonster.com:2083/">
                                                        {{ __('Host Moster (.com.mx)') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="https://onedrive.live.com/about/en-us/signin/" target="_blank">
                                                {{ __('Mi unidad - OneDrive') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- MANUALES --}}
                                <li class="nav-item dropdown navbar-button">
                                    <a class="nav-link dropdown-toggle text-white mx-2" href="#" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-users"></i> GRUPO MAKRO
                                    </a>
                                    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="https://constructoramakro111-my.sharepoint.com/personal/unidad_constructoramakro_com/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Funidad%5Fconstructoramakro%5Fcom%2FDocuments%2FSistema%20de%20Gesti%C3%B3n%2F4%2E%20Pol%C3%ADticas%2FP%C3%BAblico&ga=1" target="_blank">
                                            {{ __('Politicas') }}
                                        </a>
                                        
                                        <a class="dropdown-item" href="https://constructoramakro111-my.sharepoint.com/:f:/g/personal/unidad_constructoramakro_com/EuzIqw-PgoxDiYBsN9ECdakBGp5p9qhZIYXPqUhEDpfOGg?e=Uc1Erw" target="_blank">
                                            {{ __('Objetivos') }}
                                        </a>
                                        
                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Organigramas') }}
                                        </a>

                                        <a class="dropdown-item" href="https://constructoramakro111-my.sharepoint.com/:f:/g/personal/unidad_constructoramakro_com/Eu1WQ2sl4YVDutipZ76IaLkBeJB5bxTktZlnUSfNzcTWQA?e=tDlE0n" target="_blank">
                                            {{ __('Perfiles de Puesto') }}
                                        </a>

                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Noticias') }}
                                        </a>

                                        <a class="dropdown-item" href="https://constructoramakro111-my.sharepoint.com/personal/ustecnicos_constructoramakro_com/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fustecnicos%5Fconstructoramakro%5Fcom%2FDocuments%2FNueva%20Unidad%20Servicios%20T%C3%A9cnicos&ga=1" target="_blank">
                                            {{ __('Obras y Proyectos Técnicos') }}
                                        </a>

                                        <a class="dropdown-item" href="#" target="_blank">
                                            {{ __('Seguridad e Higiene') }}
                                        </a>
                                    </div>
                                    
                                </li>

                                {{-- PERFIL / PANEL ADM / CERRAR SESIÓN --}}
                                <li class="nav-item dropdown navbar-button">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-uppercase text-white mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa-solid fa-user"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        <div class="text-center border-bottom pb-2 text-primary">
                                            <b>{{ Auth::user()->name }}</b>
                                        </div>

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
                        @endif
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

<script type="text/javascript">
    //	window.addEventListener("resize", function() {
    //		"use strict"; window.location.reload();
    //	});


        document.addEventListener("DOMContentLoaded", function(){


            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function(element){
                element.addEventListener('click', function (e) {
                  e.stopPropagation();
                });
            })



            // make it as accordion for smaller screens
            if (window.innerWidth < 992) {

                // close all inner dropdowns when parent is closed
                document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
                    everydropdown.addEventListener('hidden.bs.dropdown', function () {
                        // after dropdown is hidden, then find all submenus
                          this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                              // hide every submenu as well
                              everysubmenu.style.display = 'none';
                          });
                    })
                });

                document.querySelectorAll('.dropdown-menu a').forEach(function(element){
                    element.addEventListener('click', function (e) {

                          let nextEl = this.nextElementSibling;
                          if(nextEl && nextEl.classList.contains('submenu')) {
                              // prevent opening link if link needs to open dropdown
                              e.preventDefault();
                              console.log(nextEl);
                              if(nextEl.style.display == 'block'){
                                  nextEl.style.display = 'none';
                              } else {
                                  nextEl.style.display = 'block';
                              }

                          }
                    });
                })
            }
            // end if innerWidth

        });
        // DOMContentLoaded  end
    </script>
