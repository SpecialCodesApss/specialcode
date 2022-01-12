<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('themes/web/default/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/web/default/assets/css/app.css') }}" rel="stylesheet">

    <!-- waves.css -->
    <link rel="stylesheet" href="{{url('themes/admin/admindek/assets/css/notification.css')}}" type="text/css" media="all">
    <!-- notification.css -->
    <link rel="stylesheet" href="{{url('themes/admin/admindek/assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{url('themes/admin/admindek/assets/css/animate.css')}}" type="text/css" media="all">



    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/fontawesome5.css')}}">

    <!-- chosen selector -->
    <link href="{{url('themes/admin/admindek/assets/css/chosen.css')}} " rel="stylesheet">


    <!--  Switchery -->
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/switchery.css')}}">
    <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/switchery.js')}}"></script>




    <!-- File Input -->
    <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    @if (Config::get('languages')[App::getLocale()] == "Arabic")
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/fileinput.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/fileinput-rtl.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/fileinput.css')}}">
    @endif



<!-- HTML Editor -->
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/richtext.min.css')}}">
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{url('themes/admin/admindek/assets/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/jquery.richtext.js')}}"></script>



    @if (Config::get('languages')[App::getLocale()] != "Arabic")
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/custom.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/custom_ar.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('themes/web/default/assets/css/custom_ar.css')}}">
    @endif


    @yield('header')

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Framework 1.7 - Specialcode
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else




                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fullname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>



                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown">


                                    @if (Config::get('languages')[App::getLocale()] != "Arabic")
                                        <img src="{{url('themes/admin/admindek/assets/images/usa.png')}}" class="img-radius flagimg" alt="User-Profile-Image">

                                    @else
                                        <img src="{{url('themes/admin/admindek/assets/images/ksa.png')}}" class="img-radius flagimg" alt="User-Profile-Image">

                                    @endif
                                    <span>{{ trans('admin_messages.'.Config::get('languages')[App::getLocale()]) }}</span>

                                    <i class="feather icon-chevron-down"></i>

                                </a>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">


                                    @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())

                                            <li>
                                                <a  class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                                    <i class="feather icon-settings"></i>
                                                    {{ trans('admin_messages.'.$language) }}

                                                </a>
                                            </li>

                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        </li>


                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>
