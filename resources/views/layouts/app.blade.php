<!doctype html>
<html class="no-js h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(auth()->check())
        <meta name="api-token" content="{{ session('api_token') }}">
    @endif

    <title>@yield('title', config('app.name', 'Twittery'))</title>
    <meta name="description" content="Laravel application for twitter">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0"
          href="{{asset('css/shards-dashboards.1.1.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/extras.1.1.0.min.css')}}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @yield('css')

</head>
<body class="h-100">
<div class="color-switcher animated">
    <h5>Theme Color</h5>
    <ul class="accent-colors">
        <li class="accent-primary active" data-color="primary">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-secondary" data-color="secondary">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-success" data-color="success">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-info" data-color="info">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-warning" data-color="warning">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-danger" data-color="danger">
            <i class="material-icons">check</i>
        </li>
    </ul>
    <div class="close">
        <i class="material-icons">close</i>
    </div>
</div>
<div class="color-switcher-toggle animated pulse infinite">
    <i class="material-icons">settings</i>
</div>
<div class="container-fluid">
    <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                                 src="{{asset('images/shards-dashboards-logo.svg')}}"
                                 alt="{{ config('app.name', 'Twittery') }}">
                            <span class="d-none d-md-inline ml-1">{{ config('app.name', 'Twittery') }}</span>
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                </nav>
            </div>
            <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                           aria-label="Search">
                </div>
            </form>
            <div class="nav-wrapper">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('home')}}">
                            <i class="material-icons">edit</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('user.index')}}">
                            <i class="material-icons">person</i>
                            <span>User Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tweet.index')}}">
                            <i class="material-icons"><img src="https://img.icons8.com/color/24/000000/twitter.png"></i>
                            <span>Tweets</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

            @include('partials.header')
            <div class="main-content-container container-fluid px-4">
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">
                            @yield('subtitle')
                        </span>
                        <h3 class="page-title">
                            @yield('title')
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card card-small mb-4">
                            <div class="card-body p-0 pb-3 text-center">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.footer')

        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="{{asset('js/extras.1.1.0.min.js')}}"></script>
<script src="{{asset('js/shards-dashboards.1.1.0.min.js')}}"></script>
<!-- pages js section -->
@yield('js')
</body>
</html>
