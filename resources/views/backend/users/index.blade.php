@extends('backend.layouts.app')

@section('title',trans('users.Admin - Users'))
@section('header')

@endsection


@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-watch bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('users.Admin - Users')}}</h5>
                        <span>{{trans('admin_messages.manage and control all system sides')}}
                             </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('admin/dashboard')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{trans('users.Users')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{trans('users.Users')}}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <p>
{{--                                        {{trans('admin_messages.Welcome to Admin Dashboard')}}--}}
                                    </p>


                                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
                                    <div class="container">
                                        <div class="row">

                                            @



                                            <div class="col-md-4">
                                                <div class="card user-card">
                                                    <div class="card-header">
                                                        <h5>Code : #123</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="user-image">
                                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image">
                                                        </div>
                                                        <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                                                        <p class="text-muted">User |
                                                            <span class="Malegender"> Male </span>
                                                            |
                                                            <span class="verified">Verified</span></p>
                                                        <hr>
                                                        <p class="text-muted m-t-15">abdullah@gmail.com</p>
                                                        <p class="text-muted m-t-15">0123456789</p>
                                                        <ul class="list-unstyled activity-leval">
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                        </ul>
                                                        <div class="bg-c-blue counter-block m-t-10 p-20">
                                                            <div class="row">
                                                                <div class="col-md-12" style="text-align: center">
                                                                    Registered at
                                                                    <br>
                                                                    01/01/2020 - 12:00 AM
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row justify-content-center user-social-link">
                                                            <div class="col-auto"><a href="#!">
                                                                    <i class="fa fa-eye text-view"></i>
                                                                </a>
                                                            </div>

                                                            <div class="col-auto"><a href="#!">
                                                                    <i class="fa fa-pencil text-edit"></i>
                                                                </a>
                                                            </div>

                                                            <div class="col-auto"><a href="#!">
                                                                    <i class="fa fa-trash text-delete"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                            <div class="card user-card">
                                                <div class="card-header">
                                                    <h5>Code : #123</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="user-image">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-radius" alt="User-Profile-Image">
                                                    </div>
                                                    <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                                                    <p class="text-muted">User |
                                                        <span class="Femalegender"> Female </span>
                                                        |
                                                        <span class="verified">Verified</span></p>
                                                    <hr>
                                                    <p class="text-muted m-t-15">abdullah@gmail.com</p>
                                                    <p class="text-muted m-t-15">0123456789</p>
                                                    <ul class="list-unstyled activity-leval">
                                                        <li class="active"></li>
                                                        <li class="active"></li>
                                                        <li class="active"></li>
                                                        <li class="active"></li>
                                                        <li class="active"></li>
                                                    </ul>
                                                    <div class="bg-c-green counter-block m-t-10 p-20">
                                                        <div class="row">
                                                            <div class="col-md-12" style="text-align: center">
                                                                Registered at
                                                                <br>
                                                                01/01/2020 - 12:00 AM
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row justify-content-center user-social-link">
                                                        <div class="col-auto"><a href="#!">
                                                                <i class="fa fa-eye text-view"></i>
                                                            </a>
                                                        </div>

                                                        <div class="col-auto"><a href="#!">
                                                                <i class="fa fa-pencil text-edit"></i>
                                                            </a>
                                                        </div>

                                                        <div class="col-auto"><a href="#!">
                                                                <i class="fa fa-trash text-delete"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                        <div class="card user-card">
                                            <div class="card-header">
                                                <h5>Code : #123</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="user-image">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-radius" alt="User-Profile-Image">
                                                </div>
                                                <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                                                <p class="text-muted">User |
                                                    <span class="Malegender"> Male </span>
                                                    |
                                                    <span class="verified">Verified</span></p>
                                                <hr>
                                                <p class="text-muted m-t-15">abdullah@gmail.com</p>
                                                <p class="text-muted m-t-15">0123456789</p>
                                                <ul class="list-unstyled activity-leval">
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                </ul>
                                                <div class="bg-c-yellow counter-block m-t-10 p-20">
                                                    <div class="row">
                                                        <div class="col-md-12" style="text-align: center">
                                                            Registered at
                                                            <br>
                                                            01/01/2020 - 12:00 AM
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row justify-content-center user-social-link">
                                                    <div class="col-auto"><a href="#!">
                                                            <i class="fa fa-eye text-view"></i>
                                                        </a>
                                                    </div>

                                                    <div class="col-auto"><a href="#!">
                                                            <i class="fa fa-pencil text-edit"></i>
                                                        </a>
                                                    </div>

                                                    <div class="col-auto"><a href="#!">
                                                            <i class="fa fa-trash text-delete"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ page content ] end -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

@endsection
