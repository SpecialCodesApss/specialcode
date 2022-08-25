@extends('backend.layouts.app')


@section('title',trans('admin_messages.Admin - admin_messages'))
@section('header')
@endsection

@section('content')

<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="far fa-envelope-open bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('admin_messages.Admin - admin_messages')}}</h5>
                        <span>{{trans('admin.manage and control all system sides')}}
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
                            <a href="#">{{trans('admin_messages.admin_messages')}}</a>
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
                                    <h5>{{trans('admin_messages.Admin - admin_messages')}}</h5>
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

    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="col-lg-12">
           <br>
                <h4>{{trans('admin.viewModule')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route('admin_messages.index') }}">
                {{trans('admin.back')}}</a>
            </div>
        </div>


 </div>




    <div class="row">
        
            
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.id")}}:</strong>
                            <div>{{$Admin_message->id}}</div>
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("admin_messages.user_id")}}:</strong>
                                {!!Form::select('user_id', $users,  $Admin_message->user_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.fullname")}}:</strong>
<div>{{$Admin_message->fullname}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.email")}}:</strong>
<div>{{$Admin_message->email}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.mobile")}}:</strong>
<div>{{$Admin_message->mobile}}</div>                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("admin_messages.message_type")}}:</strong>

                            <div>
                {{trans("admin_messages.{$Admin_message->message_type}")}}
                </div>
                        </div>

                        <br><br>
                    </div>
                        </div>
            
            
                       <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("admin_messages.image")}}:</strong>
                                <div class="col-12">
                                @if(isset($Admin_message->image))
                                    <img class="img-responsive" src="{{url($Admin_message->image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div>
            
            
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.messages_text")}}:</strong>
<div>{{$Admin_message->messages_text}}</div>
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("admin_messages.open_status")}}:</strong>

                            <div>
                {{trans("admin_messages.{$Admin_message->open_status}")}}
                </div>
                        </div>

                        <br><br>
                    </div>
                        </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.marked_as_readed")}}:</strong>
                            <br>
                            <input disabled type="checkbox" name="marked_as_readed"  class="js-switch"

                            @if(old('marked_as_readed') != null)
                               @if(old('marked_as_readed')=="on")
                               checked
                               @endif
                           @else
                                @if($Admin_message->marked_as_readed==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.marked_as_deleted")}}:</strong>
                            <br>
                            <input disabled type="checkbox" name="marked_as_deleted"  class="js-switch"

                            @if(old('marked_as_deleted') != null)
                               @if(old('marked_as_deleted')=="on")
                               checked
                               @endif
                           @else
                                @if($Admin_message->marked_as_deleted==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.created_at")}}  {{trans("admin.date")}} :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Admin_message->created_at))  , array('placeholder' => trans("admin_messages.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.created_at")}}   {{trans("admin.time")}}  :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Admin_message->created_at)), array('placeholder' => trans("admin_messages.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.updated_at")}}  {{trans("admin.date")}} :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Admin_message->updated_at))  , array('placeholder' => trans("admin_messages.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.updated_at")}}   {{trans("admin.time")}}  :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Admin_message->updated_at)), array('placeholder' => trans("admin_messages.updated_at "),'class' => 'form-control','disabled')) !!}
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
    </div>
    </div>
    </div>

@endsection


@section('footer')
    
@endsection
