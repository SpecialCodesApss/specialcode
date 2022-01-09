<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/sample-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Dec 2021 18:01:54 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>@yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{url('themes/admin/admindek/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{url('themes/admin/admindek/assets/css/notification.css')}}" type="text/css" media="all">
    <!-- notification.css -->
    <link rel="stylesheet" href="{{url('themes/admin/admindek/assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{url('themes/admin/admindek/assets/css/animate.css')}}" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/icon/feather/css/feather.css')}}">
    <!-- Style.css -->



    {{--    <!-- Font Awesome CDN -->--}}
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/fontawesome5.css')}}">

    {{--    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">--}}
{{--        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}




{{--<!-- Html Editor -->--}}
{{--    <link href="{{url('admin/assets/css/richtext.min.css')}} " rel="stylesheet">--}}
{{--    <script src="{{url('admin/assets/js/jquery.richtext.js')}} "></script>--}}

{{--    --}}{{--    <!--nice Selector for selectbox-->--}}
{{--    <link href="{{url('themes/admin/admindek/assets/css/nice-select.css')}} " rel="stylesheet">--}}
{{--    <script src="{{url('themes/admin/admindek/assets/js/jquery.nice-select.js')}} "></script>--}}
{{--    <!-- chosen selector -->--}}
{{--    <link href="{{url('themes/admin/admindek/assets/css/chosen.css')}} " rel="stylesheet">--}}

{{--    <!--Multiple Select-->--}}
{{--    <link href="{{url('themes/admin/admindek/assets/css/bootstrap-multiselect.css')}} " rel="stylesheet">--}}
{{--    <script src="{{url('themes/admin/admindek/assets/js/bootstrap-multiselect.js')}} "></script>--}}


{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
{{--    <link href="{{url('themes/admin/admindek/assets/css/editor.css')}}" type="text/css" rel="stylesheet"/>--}}


<!-- chosen selector -->
    <link href="{{url('themes/admin/admindek/assets/css/chosen.css')}} " rel="stylesheet">




@if (Config::get('languages')[App::getLocale()] != "Arabic")
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/custom.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('themes/admin/admindek/assets/css/custom_ar.css')}}">
        @endif

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


    @yield('header')





</head>

<body>

<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-bar"></div>
</div>
<!-- [ Pre-loader ] end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <!-- [ Header ] start -->
        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="{{url('/')}}">
                        <img class="img-fluid img-logo" src="{{url('themes/admin/admindek/assets/images/logo.png')}}" alt="Theme-Logo" />
                    </a>
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu icon-toggle-right"></i>
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
											<span class="input-group-prepend search-close">
												<i class="feather icon-x input-group-text"></i>
											</span>
                                    <input type="text" class="form-control" placeholder="{{trans('admin_messages.Enter Keyword')}}">
                                    <span class="input-group-append search-btn">
												<i class="feather icon-search input-group-text"></i>
											</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    <span class="badge bg-c-red">5</span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            @if(Auth::user()->profile_image != null)
                                                <img class="img-radius" src="{{url(Auth::user()->profile_image)}}" alt="Generic placeholder image">
                                            @else
                                            <img class="img-radius" src="{{url('themes/admin/admindek/assets/images/avatar-4.jpg')}}" alt="Generic placeholder image">
                                            @endif
                                                <div class="media-body">
                                                <h5 class="notification-user">{{Auth::user()->fullname}}</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="img-radius" src="{{url('themes/admin/admindek/assets/images/avatar-3.jpg')}}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="img-radius" src="{{url('themes/admin/admindek/assets/images/avatar-4.jpg')}}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-message-square"></i>
                                    <span class="badge bg-c-green">3</span>
                                </div>
                            </div>
                        </li>

                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    @if(Auth::user()->profile_image != null)
                                    <img src="{{url(Auth::user()->profile_image)}}" class="img-radius" alt="User-Profile-Image">
                                    @else
                                    <img src="{{url('themes/admin/admindek/assets/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                    @endif
                                        <span>{{Auth::user()->fullname}}</span>



                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="#!">
                                            <i class="feather icon-settings"></i> Settings

                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('admin/my_profile')}}">
                                            <i class="feather icon-user"></i> Profile

                                        </a>
                                    </li>
                                    <li>
                                        <a href="email-inbox.html">
                                            <i class="feather icon-mail"></i> My Messages

                                        </a>
                                    </li>
                                    <li>
                                        <a href="auth-lock-screen.html">
                                            <i class="feather icon-lock"></i> Lock Screen

                                        </a>
                                    </li>
                                    <li>

                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="feather icon-log-out"></i>Logout
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>


                                    </li>
                                </ul>
                            </div>
                        </li>





                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">

                                    @if (Config::get('languages')[App::getLocale()] != "Arabic")
                                                                            <img src="{{url('themes/admin/admindek/assets/images/usa.png')}}" class="img-radius flagimg" alt="User-Profile-Image">

                                    @else
                                        <img src="{{url('themes/admin/admindek/assets/images/ksa.png')}}" class="img-radius flagimg" alt="User-Profile-Image">

                                    @endif
                                    <span>{{ trans('admin_messages.'.Config::get('languages')[App::getLocale()]) }}</span>

                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">


                                    @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())

                                            <li>
                                                <a href="{{ route('lang.switch', $lang) }}">
                                                    <i class="feather icon-settings"></i>
                                                    {{ trans('admin_messages.'.$language) }}

                                                </a>
                                            </li>

                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        </li>




                    </ul>
                </div>
            </div>
        </nav>
        <!-- [ Header ] end -->

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">


                @include('themes::admin.admindek.main.navbar')

                <div class="pcoded-content">

                    @yield('content')


                </div>
                <!-- [ style Customizer ] start -->
                <div id="styleSelector">
                </div>
                <!-- [ style Customizer ] end -->
            </div>
        </div>
    </div>
</div>
