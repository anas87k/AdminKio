<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin PC Kiosk') }}</title>

    @include('layouts.css')
</head>
<body>
    <div class="page-main">
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse" style="background-color:#0072b8;">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url(../demo/faces/female/25.jpg)"></span>
                                <span class="ml-2 d-none d-lg-block">
                                <span class="text-white">{{ Auth::user()->name }}</span>
                                <small class="text-white d-block mt-1" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><b>Logout</b></small>
                                </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            {{--  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="dropdown-icon fe fe-log-out"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>  --}}
                        </li>
                        @endguest
                    </ul>
                    <div class="col-lg order-lg-first" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            @if (Auth::check())
                            <li>
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <img height="25px" src="https://ahmadyani-airport.com/frontend/images/material/footLogoBottom.png"/>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{ url('/master') }}" class="nav-link"><i class="fa fa-th-large"></i> Master</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ url('/tenant') }}"></i>Tenant</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ url('/fasilitas') }}">Fasilitas</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ url('/wisata') }}"></i>Wisata</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ url('/selfie') }}"></i>Selfie</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ url('/panduan') }}"></i>Panduan</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ url('/asisten') }}"></i>Asisten</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-4">
            @include('layouts._flash')
            @yield('content')
        </main>
    </div>
    @include('layouts.script')
    @yield('scripts')
</body>
<div style="background-color: #4f9e19; position: fixed; left: 0; bottom: 0; width: 100%; padding: 10px 0;">
    <img style="margin-left:40px;" src="https://ahmadyani-airport.com/frontend/images/material/footLogoBottom.png"/>
</div>
<div style="position: fixed; width: 102px; height: 96px; right: 0; bottom: 0; z-index: 8">
        <img src="https://ahmadyani-airport.com/frontend/images/material/block_float.png"/>
    </div>
</html>
