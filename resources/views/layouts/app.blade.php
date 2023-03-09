<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPP Smakbo') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- assets --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/css2.css')}}"> --}}
    <script src="{{asset('assets/jquery-3.6.0.slim.min.js')}}"></script>
    <script src="{{asset('assets/popper.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}">
    <script src="{{asset('assets/bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/jquery.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/jquery.dataTables.css')}}">
    <script src="{{asset('assets/jquery.dataTables.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/select2.min.css')}}">
    <script src="{{asset('assets/select2.min.js')}}"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background: rgba(164, 159, 172, 0.578)">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand">
                    SPP Smakbo
                </a>
               
                @if (Auth::user()->level =='admin')
                <a class="navbar-brand" href="{{ route('admin.index.siswa') }}">Siswa</a>
                <a class="navbar-brand" href="{{ route('admin.index.petugas') }}">Petugas</a>
                <a class="navbar-brand" href="{{ route('admin.index.kelas') }}">Kelas</a>
                <a class="navbar-brand" href="{{ route('admin.index.spp') }}">Spp</a>
                <a class="navbar-brand" href="{{ route('admin.index.pembayaran') }}">Pembayaran</a>
                <a class="navbar-brand" href="{{ route('admin.index.history') }}">History</a> 
                {{-- <li class="nav-item dropdown navbar-brand">
                <a id="navbarDropdown navbar-brand" style="color: black;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Akun
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> 
                  <a class="dropdown-item" href="{{ route('admin.index.student') }}">Siswa</a>
                    <a class="dropdown-item" href="{{ route('admin.index.employ')}}">Petugas</a>
                    <a class="dropdown-item" href="{{ route('admin.index.admins')}}">Admin</a> 
                </div>
                </li> --}}
                @elseif(Auth::user()->level =='petugas') 
                <a class="navbar-brand" href="{{ route('petugas.index.pembayaran') }}">Pembayaran</a>
                <a class="navbar-brand" href="{{ route('petugas.history.pembayaran') }}">History</a>
                @elseif(Auth::user()->level =='siswa') 
                <a class="navbar-brand" href="{{ route('siswa.index.log') }}">Log Pembayaran Anda</a> 
                @endif  
                 
                

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
</body>
</html>
