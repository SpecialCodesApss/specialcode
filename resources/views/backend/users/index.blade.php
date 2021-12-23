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



                                            <?php $i=1 ?>
                                            @foreach($users as $user)
                                                <div class="col-md-4">
                                                    <div class="card user-card">
                                                        <div class="card-header">
                                                            <h5>{{trans('users.Code')}} : # {{$user->id}}</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="user-image">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image">
                                                            </div>
                                                            <h6 class="f-w-600 m-t-25 m-b-10">{{$user->fullname}}</h6>
                                                            <p class="text-muted">
                                                                @if($user->type == "admin")
                                                                    {{trans('users.Admin')}}
                                                                @else
                                                                    {{trans('users.User')}}
                                                                @endif
                                                                |
                                                                    @if($user->gender == "female")
                                                                        <span class="Femalegender">
                                                                    {{trans('users.Female')}}
                                                                            </span>
                                                                    @else
                                                                        <span class="Malegender">
                                                                        {{trans('users.Male')}}
                                                                        </span>
                                                                    @endif

                                                                |
                                                                    @if($user->email_verified_at != null ||
                                                                        $user->mobile_verified_at != null )
                                                                        <span class="verified">{{trans('users.Verified')}}</span>
                                                                    @else
                                                                        <span>{{trans('users.Not Verified')}}</span>
                                                                    @endif

                                                            </p>
                                                            <hr>
                                                            <p class="text-muted m-t-15">{{$user->email}}</p>
                                                            <p class="text-muted m-t-15">{{$user->mobile}}</p>
                                                            <ul class="list-unstyled activity-leval">
                                                                <li class="active"></li>
                                                                <li class="active"></li>
                                                                <li class="active"></li>
                                                                <li class="active"></li>
                                                                <li class="active"></li>
                                                            </ul>

                                                            @if($i % 2 == 0)
                                                                <div class="bg-c-green counter-block m-t-10 p-20">
                                                                    @elseif($i % 3 == 0)
                                                                        <div class="bg-c-yellow counter-block m-t-10 p-20">
                                                                            @elseif($i %4 == 0))

                                                                                    <div class="bg-c-blue counter-block m-t-10 p-20">
                                                                                    @elseif($i % 5 == 0))
                                                                                        <div class="bg-c-lite-green counter-block m-t-10 p-20">
                                                                                            @elseif($i % 6 == 0))
                                                                                                <div class="bg-c-orenge counter-block m-t-10 p-20">
                                                                                                    @elseif($i % 7 == 0))
                                                                                                        <div class="bg-c-pink counter-block m-t-10 p-20">
                                                                                                            @elseif($i %8 == 0))
                                                                                                                <div class="bg-c-purple counter-block m-t-10 p-20">
                                                                                                                    @elseif($i % 9 == 0))
                                                                                                                        <div class="bg-c-red counter-block m-t-10 p-20">
                                                                                    @else
                                                                                    <div class="bg-c-blue counter-block m-t-10 p-20">
                                                                                    @endif


                                                                <div class="row">
                                                                    <div class="col-md-12" style="text-align: center">
                                                                        {{trans('users.Registered at')}}
                                                                        <br>
                                                                        <?php
                                                                        echo date('Y/m/d',strtotime($user->created_at))
                                                                        ?>
                                                                        -
                                                                        <?php
                                                                        echo date('h:i A',strtotime($user->created_at))
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row justify-content-center user-social-link">
                                                                <div class="col-auto"><a href="#!">
                                                                        <i class="fa fa-eye text-view"></i>
                                                                    </a>
                                                                </div>

                                                                <div class="col-auto"><a href="{{url('admin/users/'.$user->id.'/edit')}}">
                                                                        <i class="fa fa-pencil text-edit"></i>
                                                                    </a>
                                                                </div>

                                                                <div class="col-auto">
                                                                    <a href="javascript:deleteItem('form_{{$user->id}}')">
                                                                        <i class="fa fa-trash text-delete"></i>
                                                                    </a>
                                                                    <form id="form_{{$user->id}}" method="POST" action="users/'.$user->id.'" style="display:inline">
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                        <input name="_token" type="hidden" value="'.csrf_token().'">
{{--                                                                        <button type="button" onclick="return deleteItem('form_{{$user->id}}')"--}}
{{--                                                                           class="btn" ><i class="fa fa-trash text-delete"></i></button>--}}
                                                                    </form>

                                                                </div>



                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                        <?php $i++; ?>
                                                @endforeach

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
