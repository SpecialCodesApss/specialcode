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

                                                                            <form action="{{url('users/my_account/update_profile_image')}}" method="post" enctype="multipart/form-data">
                                                                                {{csrf_field()}}
                                                                                <input type="file" name="profile_image" id="profile_input" onchange="putImage('profile_input','profile_image','change_profile_btn')" name="image" class="inputfile_file">
                                                                                <button type="button" class="btn btn-outline-primary" onclick="OpenImgUpload('profile_input','change_profile_btn')">{{trans('users.Upload')}}</button>
                                                                                <button type="submit" class="btn btn-primary hidden" style="display: none" id="change_profile_btn">{{trans('users.Save Image')}}</button>


                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>





                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card mb-3">
                                                                <div class="card-body">

                                                                    {{--                                                    <form action="{{route('users.edit',$user->id)}}" method="PATCH">--}}
                                                                    {!! Form::model($user, ['method' => 'Post','route' => ['users_account.update']]) !!}
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.fullname')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="text" name="fullname" class="form-control"
                                                                                   value="{{old('fullname') !=null ? old('fullname') : $user->fullname}}">
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.email')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="text" name="email" class="form-control"
                                                                                   value="{{old('email') !=null ? old('email') : $user->email}}">
                                                                        </div>
                                                                    </div>
                                                                    <hr>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.mobile')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="text" name="mobile" class="form-control"
                                                                                   value="{{old('mobile') !=null ? old('mobile') : $user->mobile}}">
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">{{trans('users.gender')}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <select class="form-control" name="gender" id="gender">
                                                                                <option value="male"
                                                                                        @if(old('gender') != null)
                                                                                        @if(old('gender') == 'male') selected @endif
                                                                                        @else
                                                                                        @if($user->gender == 'male') selected @endif
                                                                                    @endif
                                                                                >Male</option>
                                                                                <option value="female"
                                                                                        @if(old('gender') != null)
                                                                                        @if(old('gender') == 'female') selected @endif
                                                                                        @else
                                                                                        @if($user->gender == 'female') selected @endif
                                                                                    @endif

                                                                                >Female</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>




                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <input type="submit" class="btn btn-primary px-4" value="{{trans('users.change user inforamtion')}}">                                                        </div>
                                                                    </div>

                                                                    {!! Form::close() !!}

                                                                </div>
                                                            </div>



                                                            <div class="card mb-3">

                                                                <form action="{{url('users/my_account/update_password')}}" method="post">
                                                                    {{csrf_field()}}

                                                                    <div class="card-body">
                                                                        <h4>{{trans('users.Change Password')}}</h4>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <h6 class="mb-0">{{trans('users.Old Password')}}</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                <input type="password" name="old_password" class="form-control" value="">
                                                                            </div>
                                                                        </div>

                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <h6 class="mb-0">{{trans('users.New Password')}}</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                <input type="password" name="password" class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <h6 class="mb-0">{{trans('users.Confirm New Password')}}</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                <input type="password" name="c_password" class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <hr>


                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <input type="submit" class="btn btn-primary px-4" value="{{trans('users.change password')}}">                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
