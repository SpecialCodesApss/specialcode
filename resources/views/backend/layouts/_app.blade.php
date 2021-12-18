<!DOCTYPE HTML>
<html>

<?php
$lang = Session::get('applocale');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Dashboard</title>

    <link rel="stylesheet" type="text/css" href="{{url('resources/admin_assets/css/bootstrap.css')}} " media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('resources/admin_assets/css/bootstrap-rtl.css')}} " media="all" />

    <link href="{{url('resources/admin_assets/css/dataTables.bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{url('resources/admin_assets/css/responsive.dataTables.min.css')}} " rel="stylesheet">
    <link href="{{url('resources/admin_assets/css/buttons.dataTables.min.css')}} " rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{url('resources/admin_assets/css/font-awesome.css')}} " media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('resources/admin_assets/css/all.css')}} " media="all" />

    <script src="{{url('resources/admin_assets/js/jquery-1.12.1.js')}} "></script>
    <script src="{{url('resources/admin_assets/js/jquery-migrate-1.2.1.min.js')}} "></script>

    <link rel="stylesheet" href="{{url('resources/admin_assets/css/responsive.css')}} ">

    <!--toaster for Notifications -->
    <link href="{{url('resources/admin_assets/css/toastr.min.css')}} " rel="stylesheet">
    <script src="{{url('resources/admin_assets/js/toastr.min.js')}} "></script>

    <!--Multiple Select-->

<!--    <link href="{{url('resources/admin_assets/css/bootstrap-multiselect.css')}} " rel="stylesheet">-->
<!--    <script src="{{url('resources/admin_assets/js/bootstrap-multiselect.js')}} "></script>-->

    <!--Tag inputs Scripts-->
    <link href="{{url('resources/admin_assets/css/jquery-ui.css')}} " rel="stylesheet">
    <link href="{{url('resources/admin_assets/css/jquery.tagsinput-revisited.css')}} " rel="stylesheet">
    <script src="{{url('resources/admin_assets/js/jquery-ui.min.js')}} "></script>
    <script src="{{url('resources/admin_assets/js/jquery.tagsinput-revisited.js')}} "></script>

    <!-- Html Editor -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('resources/admin_assets/css/richtext.min.css')}} " rel="stylesheet">
<!--{{--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}-->
    <script src="{{url('resources/admin_assets/js/jquery.min.js')}} "></script>
    <script src="{{url('resources/admin_assets/js/jquery.richtext.js')}} "></script>

{{--    <!--nice Selector for selectbox-->--}}
    <link href="{{url('resources/admin_assets/css/nice-select.css')}} " rel="stylesheet">
{{--    <link href="{{url('resources/admin_assets/css/nice-select-style.css')}} " rel="stylesheet">--}}
    <script src="{{url('resources/admin_assets/js/jquery.nice-select.js')}} "></script>


    <!-- chosen selector -->
    <link href="{{url('resources/admin_assets/css/chosen.css')}} " rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{url('resources/admin_assets/css/style.css')}} " media="all" />

<!--[if lt IE 9]>
    <script src="{{url('resources/admin_assets/js/html5shiv.min.js')}} "></script>
    <script src="{{url('resources/admin_assets/js/respond.min.js')}} "></script>
    <![endif]-->

    @yield('header')


</head>
<body  background="{{url('resources/admin_assets/img/a.jpg')}}">


@if ($message = Session::get('success'))
    <script !src="">
        toastr.success('{{$message}}');
    </script>
@elseif ($message = Session::get('error'))
    <script !src="">
        toastr.warning('{{$message}}');
    </script>
@endif


<div class="website_containner">
    <div class="top_block">

        <div class="top-navbar">
            <a data-original-title="Toggle navigation" class="toggle-side-nav pull-right" href="#">
                <i class="icon-reorder"></i>
            </a>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    {{--                    <div class="logo">--}}
                    {{--                        <!----}}
                    {{--                        <a href="#"><img src="assets/img/logo.png"></a>--}}
                    {{--                        -->--}}
                    {{--                    </div><!--logo-->--}}
                </div><!--col-md-4-->
                <div class="col-md-9 col-xs-12">
                    <div class="topblo">
                        <div class="account">
                            <ul class="list_acountdrop list_acountdrop_hsap">


                                <li class="dropup">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<!--                                        المدير-->
                                        {{Auth::user()->fullname}}
                                        <i class="icon-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu_hsap show_drop">
<!--                                        <li>-->
<!--                                            <span>لوحة الادارة</span>-->
<!---->
<!--                                        </li>-->
                                        {{--                                        <li><a href="#">حسابى</a></li>--}}
                                        <li><a href="{{route('changePassword')}}">

                                                {{trans('admin.changePassword')}}
                                            </a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{trans('admin.logout')}}
                                            </a>
                                        </li>
                                    </ul><!--dropdown-menu-->
                                </li>



                                <li class="dropup">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        {{ Config::get('languages')[App::getLocale()] }} <i class="icon-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu_hsap show_drop">
<!--                                        <li>-->
<!--                                            <span>{{ Config::get('languages')[App::getLocale()] }}</span>-->
<!---->
<!--                                        </li>-->

                                        @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                        <li><a href="{{ route('lang.switch', $lang) }}">{{$language}}</a></li>
                                        @endif
                                        @endforeach

                                    </ul><!--dropdown-menu-->
                                </li>

<!---->
<!--                                <li class="nav-item dropdown">-->
<!--                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                                        {{ Config::get('languages')[App::getLocale()] }}-->
<!--                                    </a>-->
<!--                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
<!--                                        @foreach (Config::get('languages') as $lang => $language)-->
<!--                                        @if ($lang != App::getLocale())-->
<!--                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>-->
<!--                                        @endif-->
<!--                                        @endforeach-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                -->


                            </ul><!--list_acountdrop-->
                        </div><!--account-->

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        {{--                        <div class="notifications">--}}
                        {{--                            <div class="notiblog">--}}
                        {{--                                <ul class="list_acountdrop list_acountdrop_noti list_acountdrop_hsap">--}}
                        {{--                                    <li class="dropup">--}}
                        {{--                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                            <i class="icon-user"></i><span>5</span>--}}
                        {{--                                        </a>--}}
                        {{--                                        <ul class="dropdown-menu dropdown-menu_hsap show_drop">--}}
                        {{--                                            <li><a href="#">حسابى</a></li>--}}
                        {{--                                            <li><a href="#">طلباتى</a></li>--}}
                        {{--                                            <li><a href="#">قائمتى</a></li>--}}
                        {{--                                            <li><a href="#">مقارنة</a></li>--}}
                        {{--                                            <li><a href="#">تغيير كلمة السر</a></li>--}}
                        {{--                                            <li><a href="#">خروج</a></li>--}}
                        {{--                                            <li><a href="#">الأدمن</a></li>--}}
                        {{--                                        </ul><!--dropdown-menu-->--}}
                        {{--                                    </li>--}}
                        {{--                                </ul><!--list_acountdrop-->--}}
                        {{--                            </div><!--notiblog-->--}}
                        {{--                            <div class="notiblog">--}}
                        {{--                                <ul class="list_acountdrop list_acountdrop_noti list_acountdrop_hsap">--}}
                        {{--                                    <li class="dropup">--}}
                        {{--                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                            <i class="icon-tasks"></i><span>5</span>--}}
                        {{--                                        </a>--}}
                        {{--                                        <ul class="dropdown-menu dropdown-menu_hsap show_drop">--}}
                        {{--                                            <li><a href="#">حسابى</a></li>--}}
                        {{--                                            <li><a href="#">طلباتى</a></li>--}}
                        {{--                                            <li><a href="#">قائمتى</a></li>--}}
                        {{--                                            <li><a href="#">مقارنة</a></li>--}}
                        {{--                                            <li><a href="#">تغيير كلمة السر</a></li>--}}
                        {{--                                            <li><a href="#">خروج</a></li>--}}
                        {{--                                            <li><a href="#">الأدمن</a></li>--}}
                        {{--                                        </ul><!--dropdown-menu-->--}}
                        {{--                                    </li>--}}
                        {{--                                </ul><!--list_acountdrop-->--}}
                        {{--                            </div><!--notiblog-->--}}
                        {{--                            <div class="notiblog">--}}
                        {{--                                <ul class="list_acountdrop list_acountdrop_noti list_acountdrop_hsap">--}}
                        {{--                                    <li class="dropup">--}}
                        {{--                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                            <i class="icon-bell"></i><span>5</span>--}}
                        {{--                                        </a>--}}
                        {{--                                        <ul class="dropdown-menu dropdown-menu_hsap show_drop">--}}
                        {{--                                            <li><a href="#">حسابى</a></li>--}}
                        {{--                                            <li><a href="#">طلباتى</a></li>--}}
                        {{--                                            <li><a href="#">قائمتى</a></li>--}}
                        {{--                                            <li><a href="#">مقارنة</a></li>--}}
                        {{--                                            <li><a href="#">تغيير كلمة السر</a></li>--}}
                        {{--                                            <li><a href="#">خروج</a></li>--}}
                        {{--                                            <li><a href="#">الأدمن</a></li>--}}
                        {{--                                        </ul><!--dropdown-menu-->--}}
                        {{--                                    </li>--}}
                        {{--                                </ul><!--list_acountdrop-->--}}
                        {{--                            </div><!--notiblog-->--}}
                        {{--                        </div><!--notifications-->--}}
                        {{--                        <div class="search_block">--}}
                        {{--                            <form>--}}
                        {{--                                <div class="in_form_search">--}}
                        {{--                                    <input type="text" name="name" placeholder="إبحث هنا">--}}
                        {{--                                    <button>بحث</button>--}}
                        {{--                                    <ul class="auto_complete2 show_drop">--}}
                        {{--                                        <li>بعض من عملاء التحة لدينا</li>--}}
                        {{--                                        <li>بعض من عملاء التسويق الرائحة لدينا</li>--}}
                        {{--                                        <li>بعض من عملاء ارائحة لدينا</li>--}}
                        {{--                                        <li>بعض من عملاء التسويق الرائحة لدينا</li>--}}
                        {{--                                        <li>بعض من ويق الرائحة لدينا</li>--}}
                        {{--                                        <li>بعض من عملاء التسويق الراحة لدينا</li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div><!--in_form_search-->--}}
                        {{--                            </form>--}}
                        {{--                        </div><!--search_block-->--}}

                    </div><!--topblo-->
                </div><!--col-md-4 col-xs-12-->
            </div><!--row-->
        </div><!--container-->
    </div><!--top_block-->

    @yield('content')


    <div class="footer">
        {{trans('admin.footerMessage')}}
    </div><!--copy_site-->


    <div class="col_side_nav">
        <div id="side-nav">
            <ul id="nav">

                <img class="img-responsive logo" src="{{url('storage/images/logo.png')}}" alt="">

                <?php
                $lang = Session::get('applocale');
                ?>


                @foreach($admin_sections as $admin_section)
                    @if( $admin_section['active']==1)
                    <li
                        @if(preg_match('/\b'.$admin_section['section_flag'].'\b/',
                $_SERVER['REQUEST_URI']))  class="current" @endif>

                <a
                    @if( $admin_section['is_drop_menu']==1)
                href="#"
                @else
                    href="{{url('admin/'.$admin_section['section_flag'])}}"
                @endif

                > <i class="{{$admin_section['section_icon']}}"></i>
                            @if(isset($admin_section['notificatios_count']) && $admin_section['is_notification_able']==1 )
                                <span class="label label-info pull-left">{{$admin_section['notificatios_count']}}</span>
                            @endif




                @if($lang == "en")
                {{$admin_section['section_name_en']}}
                @else
                {{$admin_section['section_name_ar']}}
                @endif




                            @if( $admin_section['is_drop_menu']==1)
                                <i class="arrow icon-angle-right"></i>
                            @endif
                        </a>

                        @if( $admin_section['is_drop_menu']==1)

                            @foreach($admin_section['sub_sections'] as $sub_section)
                                @if($sub_section['active'] == 1)
                                <ul class="sub-menu">
                                    <li> <a href="{{url('admin/'.$sub_section['section_flag'])}}"> <i class="icon-angle-left"></i>
                                            @if(isset($sub_section['notificatios_count']) && $sub_section['is_notification_able']==1 )
                                                <span class="label label-info pull-left">{{$sub_section['notificatios_count']}}</span>
                                            @endif

                                            @if($lang == "en")
                                            {{$sub_section['section_name_en']}}
                                            @else
                                            {{$sub_section['section_name_ar']}}
                                            @endif


                                        </a>
                                    </li>
                                </ul>
                                @endif
                            @endforeach
                        @endif
                    </li>
                    @endif
                @endforeach



            </ul>
        </div>
        <!--side-nav-->
    </div>
    <!--col_side_nav-->

</div><!--website_containner-->

<script src="{{url('resources/admin_assets/js/bootstrap.min.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/index.js')}} "></script>


{{--<!-- jQuery -->--}}
{{--<script src="//code.jquery.com/jquery.js')}} "></script>--}}
{{--<script type="text/javascript" src="{{url('resources/admin_assets/js/jquery.js')}} "></script>--}}
{{--<!-- DataTables -->--}}

<script type="text/javascript" src="{{url('resources/admin_assets/js/jquery.dataTables.min.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/dataTables.bootstrap.min.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/dataTables.responsive.min.js')}} "></script>

<script type="text/javascript" src="{{url('resources/admin_assets/js/dataTables.buttons.min.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/buttons.print.min.js')}} "></script>

<script type="text/javascript" src="{{url('resources/admin_assets/js/jszip.min.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/pdfmake.min.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/vfs_fonts.js')}} "></script>
<script type="text/javascript" src="{{url('resources/admin_assets/js/buttons.html5.min.js')}} "></script>


<!-- chosen selector -->
<link href="{{url('resources/admin_assets/css/chosen.css')}} " rel="stylesheet">
<script src="{{url('resources/admin_assets/js/chosen.jquery.js')}} "></script>
<script src="{{url('resources/admin_assets/js/chosen_init.js')}} "></script>


<script !src="">

    toastr.options = {
        "closeButton": true,
        "progressBar": false,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


    function deleteItem(form_id){
        if (confirm("هل انت متأكد من حذف هذا العنصر ؟ ")) {
            document.getElementById(form_id).submit();
        }
        return false;
    }
</script>

@yield('footer')
</body>
</html>
