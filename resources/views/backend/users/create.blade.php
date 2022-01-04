@extends('backend.layouts.app')




@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('users.Create User Info')}}</h5>
                        <span>{{trans('users.Create user information easily')}}</span>
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
                            <a href="#">{{trans('users.Create User')}}</a>
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
{{--                                    <h5>{{trans('users.Code')}} : # {{$user->id}}</h5>--}}
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

                                     <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    <div class="row gutters-sm">
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column align-items-center text-center">

                                                            <img src="{{url('storage/images/noimage.png')}}" class="img-radius" alt="User-Profile-Image" id="profile_image">

                                                        <div class="mt-3">
                                                            <h4 id="usernameView">
                                                            </h4>
                                                            <p class="text-secondary mb-1">
                                                                <span id="roleView">{{trans('Users.user')}}</span>
                                                                |
                                                                    <span class="Femalegender" style="display: none">
                                                                   <span id="genderView">Female</span>
                                                                            </span>

                                                                    <span class="Malegender">
                                                                        <span id="genderView">Male</span>
                                                                        </span>
                                                                |

                                                                <span class="verified">{{trans('users.Verified')}}</span>
                                                                <span class="notverified" style="display: none">{{trans('users.Not Verified')}}</span>

                                                            </p>


                                                                <input type="file" name="profile_image" id="profile_input" onchange="putImage('profile_input','profile_image','change_profile_btn')" name="image" class="inputfile_file">
                                                                <button type="button" class="btn btn-outline-primary" onclick="OpenImgUpload('profile_input','change_profile_btn')">{{trans('users.Upload')}}</button>


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
                                                            <input type="text" id="fullname" name="fullname" class="form-control"  value="{{old('fullname')}}">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">{{trans('users.email')}}</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="text" name="email" class="form-control" value="{{old('email')}}">
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">{{trans('users.mobile')}}</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}">
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">{{trans('users.gender')}}</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <select class="form-control" name="gender" id="gender">
                                                                <option value="male" @if(old('gender') == "male") selected @endif>Male</option>
                                                                <option value="female"  @if(old('gender') == "female") selected @endif>Female</option>
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
                                                                                @if($role == "user") selected @endif
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
                                                                <option value="1"  @if(old('active') == "1") selected @endif>{{trans('users.Active')}}</option>
                                                                <option value="0"  @if(old('active') == "0") selected @endif>{{trans('users.In Active')}}</option>
                                                            </select>
                                                        </div>
                                                    </div>


{{--                                                    <hr>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-sm-12">--}}
{{--                                                            <input type="submit" class="btn btn-primary px-4" value="{{trans('users.change user inforamtion')}}">                                                        </div>--}}
{{--                                                    </div>--}}


                                                </div>
                                            </div>



                                            <div class="card mb-3">


                                                    <div class="card-body">
                                                        <h4>{{trans('users.Password')}}</h4>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">{{trans('users.Password')}}</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                <input type="password" name="password" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">{{trans('users.Confirm Password')}}</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                <input type="password" name="c_password" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                        <hr>


                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <input type="submit" class="btn btn-primary px-4" value="{{trans('users.Create Account')}}">                                                        </div>
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


@endsection






@section('footer')

    <script type="application/javascript">

        $("#fullname").change(function(){
            var fullname = $("#fullname").val();
                $("#usernameView").html(fullname);
        });

        $("#gender").change(function(){
            var gender = $("#gender").val();
            if(gender == "female"){
                $(".Malegender").hide();
                $(".Femalegender").show();
            }else{
                $(".Malegender").show();
                $(".Femalegender").hide();
            }
        });

        $("#roles").change(function(){
            var roles = $("#roles").val();
            $("#roleView").html(roles);
        });


        $("#active").change(function(){
            var active = $("#active").val();
            if(active == "1"){
                $(".notverified").hide();
                $(".verified").show();
            }else{
                $(".notverified").show();
                $(".verified").hide();
            }
        });


    </script>
@endsection





{{--@extends('backend.layouts.app')--}}


{{--@section('content')--}}
{{--    <div class="wrapper_cols">--}}
{{--        <div class="col_page_content">--}}
{{--            <div class="row">--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-right">--}}
{{--                <h2>إضافة مستخدم جديد</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-left">--}}
{{--                <a class="btn btn-primary" href="{{ route('users.index') }}"> رجوع</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--        @if (count($errors) > 0)--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>خطأ!</strong> خطأ في البيانات.<br><br>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        @endif--}}



{{--    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}--}}
{{--    <div class="row">--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الاسم :</strong>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>نوع المستخدم :</strong>--}}
{{--                {!! Form::select('type', ['عميل'=>'عميل','دكتور'=>'دكتور'],'مندوب توصيل',array('class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>النوع</strong>--}}
{{--                        {!! Form::select('gender', ['male'=>'ذكر','female'=>'انثي'],'مندوب توصيل',array('class' => 'form-control')) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>البريد :</strong>--}}
{{--                {!! Form::text('email', null, array('placeholder' => 'البريد','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الجوال :</strong>--}}
{{--                {!! Form::text('mobile', null, array('placeholder' => 'الجوال','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الرقم السري :</strong>--}}
{{--                {!! Form::password('password', array('placeholder' => 'الرقم السري ','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>اعادة الرقم السري :</strong>--}}
{{--                {!! Form::password('c_password', array('placeholder' => ' إعادة الرقم السري','class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>الصلاحيات :</strong>--}}
{{--                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}--}}
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
{{--@endsection--}}
