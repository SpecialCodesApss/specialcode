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
                    <i class="feather icon-user bg-c-blue"></i>
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


                                    <div class="container">
                                        <div class="row">

                                            <div class="col-md-12 ">
                                                <div class="align_btn_end">
                                                    <a href="{{url('admin/users/create')}}" class="btn btn-primary">{{trans('users.Create User Account')}}</a>
                                                </div>
                                                <br>

                                            </div>



                                            <?php $i=1 ?>
                                            @foreach($users as $user)
                                                <div class="col-md-4">
                                                    <div class="card user-card">
                                                        <div class="card-header">
                                                            <h5>{{trans('users.Code')}} : # {{$user->id}}</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="user-image">
                                                                @if($user->profile_image != null)
                                                                <img src="{{url($user->profile_image)}}" class="img-radius" alt="User-Profile-Image">
                                                                @else
                                                                <img src="{{url('storage/images/users/avatar7.png')}}" class="img-radius" alt="User-Profile-Image">
                                                                @endif
                                                            </div>
                                                            <h6 class="f-w-600 m-t-25 m-b-10">{{$user->fullname}}</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                $roles = \App\Role::pluck('name')->toArray();
                                                                ?>

                                                                @if($user->hasAnyRole($roles) == true)
{{--                                                                    {{trans('users.Admin')}}--}}
                                                                    {{trans('users.'.$user->getRoleNames()->first())}}
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
                                                                            @elseif($i %4 == 0)

                                                                                    <div class="bg-c-blue counter-block m-t-10 p-20">
                                                                                    @elseif($i % 5 == 0)
                                                                                        <div class="bg-c-lite-green counter-block m-t-10 p-20">
                                                                                            @elseif($i % 6 == 0)
                                                                                                <div class="bg-c-orenge counter-block m-t-10 p-20">
                                                                                                    @elseif($i % 7 == 0)
                                                                                                        <div class="bg-c-pink counter-block m-t-10 p-20">
                                                                                                            @elseif($i %8 == 0)
                                                                                                                <div class="bg-c-purple counter-block m-t-10 p-20">
                                                                                                                    @elseif($i % 9 == 0)
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


                                                                <div class="col-auto"><a href="#"  data-toggle="modal" data-target="#user_{{$user->id}}">
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
                                                                    <form id="form_{{$user->id}}" method="POST" action="{{url('admin/users/'.$user->id)}}" style="display:inline">
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                        <input name="_token" type="hidden" value="{{csrf_token()}}">
{{--                                                                        <button type="button" onclick="return deleteItem('form_{{$user->id}}')"--}}
{{--                                                                           class="btn" ><i class="fa fa-trash text-delete"></i></button>--}}
                                                                    </form>

                                                                </div>



                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                        <?php $i++; ?>

                                                                                                <!--Modal Form Login with Avatar Demo-->
                                                                                                    <div class="modal fade" id="user_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                                                         aria-hidden="true">
                                                                                                        <div class="modal-dialog cascading-modal modal-avatar modal-lg" role="document">
                                                                                                            <!--Content-->
                                                                                                            <div class="modal-content withImageModleContent">

                                                                                                                <!--Header-->
                                                                                                                <div class="modal-header withImageModleheader">
                                                                                                                    @if($user->profile_image != null)
                                                                                                                    <img
                                                                                                                        src="{{url($user->profile_image)}}" class="rounded-circle img-responsive"
                                                                                                                         alt="Avatar photo">
                                                                                                                    @else
                                                                                                                        <img
                                                                                                                            src="#" class="rounded-circle img-responsive"
                                                                                                                            alt="Avatar photo">
                                                                                                                        @endif

                                                                                                                </div>
                                                                                                                <!--Body-->
                                                                                                                <div class="modal-body text-center mb-1">

                                                                                                                    <h5 class="mt-1 mb-2">{{$user->fullname}}</h5>

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
{{--                                                                                                                    <hr>--}}


{{--                                                                                                                    <div class="container">--}}
{{--                                                                                                                        <div class="row">--}}
{{--                                                                                                                            <div class="col">Column</div>--}}
{{--                                                                                                                            <div class="col">Column</div>--}}
{{--                                                                                                                            <div class="w-100"></div>--}}
{{--                                                                                                                            <div class="col">Column</div>--}}
{{--                                                                                                                            <div class="col">Column</div>--}}
{{--                                                                                                                        </div>--}}
{{--                                                                                                                    </div>--}}

                                                                                                                    <table class="table">
                                                                                                                        <tr>
                                                                                                                            <th>{{trans('users.email')}}</th>
                                                                                                                            <td>{{$user->email}}</td>
                                                                                                                            <th>{{trans('users.mobile')}}</th>
                                                                                                                            <td>{{$user->mobile}}</td>
                                                                                                                        </tr>

                                                                                                                        <tr>
                                                                                                                            <th>{{trans('users.Registered at')}}</th>
                                                                                                                            <td>
                                                                                                                                <?php
                                                                                                                                echo date('Y/m/d',strtotime($user->created_at))
                                                                                                                                ?>
                                                                                                                                -
                                                                                                                                <?php
                                                                                                                                echo date('h:i A',strtotime($user->created_at))
                                                                                                                                ?>
                                                                                                                            </td>

                                                                                                                        </tr>


                                                                                                                    </table>



                                                                                                                    <div class="text-center mt-4">
                                                                                                                        <button class="btn btn-primary"  data-dismiss="modal">{{trans('users.Close')}}
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                            <!--/.Content-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!--Modal Form Login with Avatar Demo-->




                                                @endforeach

                                        </div>


                                                                                                {{$users->links()}}





{{--                                                                                                {{$users->links()}}--}}
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
