@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card container">


                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">
                                    <!-- [ page content ] start -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>{{trans('users.Code')}} : # {{$user->id}}</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                            {{--                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>--}}
                                                            <li><i class="feather close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">



                                                    <div class="row gutters-sm">
                                                        <div class="col-md-4 mb-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-column align-items-center text-center">
                                                                        @if($user->profile_image != null)
                                                                            <img src="{{url($user->profile_image)}}"  class="rounded-circle"
                                                                                 width="150" alt="User-Profile-Image" id="profile_image">
                                                                        @else
                                                                            <img src="{{url('storage/images/users/avatar7.png')}}" class="img-radius" alt="User-Profile-Image" id="profile_image">
                                                                        @endif
                                                                        <div class="mt-3">
                                                                            <h4>{{$user->fullname}}</h4>
                                                                            <p class="text-secondary mb-1">@if($user->type == "admin")
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
                                                                            {{--                                                            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>--}}
                                                                            {{--                                                            <button class="btn btn-primary">Follow</button>--}}

                                                                            <form action="{{url('admin/updateProfileImage/'.$user->id)}}" method="post" enctype="multipart/form-data">
                                                                                {{csrf_field()}}


                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>





                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card mb-3">
                                                                <div class="card-body">

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.fullname')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <span>{{$user->fullname}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.email')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <span>{{$user->email}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.mobile')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <span>{{$user->mobile}}</span>
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.gender')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <span>{{$user->gender}}</span>
                                                                        </div>
                                                                    </div>

                                                                    <hr>



                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.Role')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <span>
                                                                                @foreach($roles as $role)
                                                                                    @if($user->hasRole($role) == $role)
                                                                                        {{$role}}
                                                                                    @endif

                                                                                    @endforeach
                                                                            </span>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.Active')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                                @if($user->active == '1')
                                                                                    {{trans('users.Active')}}
                                                                                @else
                                                                                    {{trans('users.In Active')}}
                                                                                @endif
                                                                        </div>
                                                                    </div>





                                                                </div>
                                                            </div>



                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <a href="{{url('users/my_account/edit')}}" class="btn btn-primary">
                                                                    {{trans('users.edit_information')}}
                                                                    </a>
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

                </div>
            </div>
        </div>
    </div>
@endsection
