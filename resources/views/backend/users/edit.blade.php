@extends('backend.layouts.app')




@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('users.Edit User Info')}}</h5>
                        <span>{{trans('users.edit user information easily')}}</span>
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
                            <a href="#">{{trans('users.Edit User')}}</a>
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
                                                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
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
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">{{trans('users.Role')}}</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <select class="form-control" name="roles" id="roles">
                                                                @foreach($roles as $role)
                                                                    <option value="{{$role}}"

                                                                            @if(old('roles') != null)
                                                                            @if(old('roles') == $role) selected @endif
                                                                            @else
                                                                            @if($user->hasRole($role) == $role) selected @endif
                                                                            @endif


                                                                    >{{$role}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">{{trans('users.Active')}}</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <select class="form-control" name="active" id="active">
                                                                <option value="1"

                                                                        @if(old('active') != null)
                                                                        @if(old('active') == '1') selected @endif
                                                                        @else
                                                                        @if($user->active == '1') selected @endif
                                                                        @endif

                                                                >{{trans('users.Active')}}</option>
                                                                <option value="0"

                                                                        @if(old('active') != null)
                                                                        @if(old('active') == '0') selected @endif
                                                                        @else
                                                                        @if($user->active == '0') selected @endif
                                                                        @endif

                                                                >{{trans('users.In Active')}}</option>
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

                                                <form action="{{url('admin/updatepassword/'.$user->id)}}" method="post">
                                                    {{csrf_field()}}

                                                <div class="card-body">
                                                    <h4>{{trans('users.Change Password')}}</h4>
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






    {{--    --}}
{{--    <div class="wrapper_cols">--}}
{{--        <div class="col_page_content">--}}
{{--            <div class="row">--}}

{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-right">--}}
{{--                <h2>تعديل بيانات المستخدم</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-left">--}}
{{--                <a class="btn btn-primary" href="{{ route('users.index') }}"> رجوع</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    @if (count($errors) > 0)--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>خطأ!</strong> خطأ في ادخال البيانات.<br><br>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}


{{--    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}--}}
{{--    <div class="row">--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الاسم :</strong>--}}
{{--                {!! Form::text('fullname', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>البريد الالكتروني:</strong>--}}
{{--                {!! Form::text('email', null, array('placeholder' => 'البريد','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>نوع المستخدم :</strong>--}}
{{--                {!! Form::select('type', ['عميل'=>'عميل','دكتور'=>'دكتور'],$user->type,array('class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>النوع</strong>--}}
{{--                        {!! Form::select('gender', ['male'=>'ذكر','female'=>'انثي'],$user->gender,array('class' => 'form-control')) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الجوال :</strong>--}}
{{--                {!! Form::text('mobile', $user->mobile, array('placeholder' => 'الجوال','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الرقم السري :</strong>--}}
{{--                {!! Form::password('password', array('placeholder' => 'الرقم السري','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>إعادة الرقم السري :</strong>--}}
{{--                {!! Form::password('c_password', array('placeholder' => ' إعادة الرقم السري','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الصلاحية :</strong>--}}
{{--                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--            <button type="submit" class="btn btn-primary">حفظ</button>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    {!! Form::close() !!}--}}



{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
