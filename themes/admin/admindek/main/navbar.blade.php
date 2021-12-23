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


        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
