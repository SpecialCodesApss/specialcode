<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">{{trans('admin_messages.Navigation')}}</div>
            <ul class="pcoded-item pcoded-left-item">


                <li class="">
                    <a href="{{url('admin/dashboard')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">{{trans('admin_messages.Dashboard')}}</span>
                    </a>
                </li>


                <li class="">
                    <a href="{{url('admin/users')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">{{trans('users.Users')}}</span>
                    </a>
                </li>

{{--                <li class="">--}}
{{--                    <a href="{{url('admin/pages')}}" class="waves-effect waves-dark">--}}
{{--                        <span class="pcoded-micon"><i class="feather icon-file"></i></span>--}}
{{--                        <span class="pcoded-mtext">{{trans('pages.Pages')}}</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                @foreach($admin_sections as $section)
                    @if($section->active == 1)
                        <li class="">
                            <a href="{{url('admin/'.$section->section_flag)}}" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="fa {{$section->section_icon}}"></i></span>
                                <span class="pcoded-mtext">{{trans($section->section_flag.'.'.$section->section_name_en)}}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach


        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
