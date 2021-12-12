<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="{{url('developer/assets/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />

    <script src="{{url('developer/assets/js/jquery-1.12.1.js')}} "></script>
    <!--toaster for Notifications -->
    <link href="{{url('developer/assets/css/toastr.min.css')}} " rel="stylesheet">
    <script src="{{url('developer/assets/js/toastr.min.js')}} "></script>


    @yield('header')

</head>

<body>


<script !src="">
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>


@if ($message = Session::get('success'))
    <script !src="">
        toastr.success('{{$message}}');
    </script>
@elseif ($message = Session::get('error'))
    <script !src="">
        toastr.warning('{{$message}}');
    </script>
@endif


<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
        <div class="logo">
            <a href="http://www.saudi-app.com" class="simple-text logo-normal">
                <img src="{{url('developer/assets/img/log.png')}}" alt="" width="250">
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/home')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/extensions')}}">
                        <i class="material-icons">extension</i>
                        <p>Extensions</p>
                    </a>
                </li>

                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/install_extension')}}">
                        <i class="material-icons">backup</i>
                        <p>Install extension</p>
                    </a>
                </li>


                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/create_extension_table')}}">
                        <i class="material-icons">add_task</i>
                        <p>Create extension</p>
                    </a>
                </li>

                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/start_project')}}">
                        <i class="material-icons">developer_mode</i>
                        <p>Start New Project</p>
                    </a>
                </li>

                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/customize_theme_url')}}">
                        <i class="material-icons">rss_feed</i>
                        <p>Customize theme Urls</p>
                    </a>
                </li>

                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/home')}}">
                        <i class="material-icons">rss_feed</i>
                        <p>Change Project Website</p>
                    </a>
                </li>
                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/home')}}">
                        <i class="material-icons">palette</i>
                        <p>Change Project Colors</p>
                    </a>
                </li>


                <li class="nav-item active  ">
                    <a class="nav-link" href="{{url('developer/deployment')}}">
                        <i class="material-icons">palette</i>
                        <p>Deployment Project</p>
                    </a>
                </li>



                <!-- your sidebar here -->
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:;">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;">
                                <i class="material-icons">notifications</i> Notifications
                            </a>
                        </li>
                        <!-- your navbar here -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <!-- your content here -->

                @yield('content')


            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="http://www.saudi-app.com">
                                Saudi App
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i> by
                    <a href="http://www.saudi-app.com" target="_blank">Saudi App</a> for a better web.
                </div>
                <!-- your footer here -->
            </div>
        </footer>
    </div>
</div>

    @yield('footer')

</body>

</html>











