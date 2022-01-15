@extends('backend.layouts.app')


@section('title',trans('admin_notifications.Admin - admin_notifications'))
@section('header')
@endsection

@section('content')

<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-bell bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('admin_notifications.Admin - admin_notifications')}}</h5>
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
                            <a href="#">{{trans('admin_notifications.admin_notifications')}}</a>
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
                                    <h5>{{trans('admin_notifications.Admin - admin_notifications')}}</h5>
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
                <h4>{{trans('admin_messages.viewModule')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route('admin_notifications.index') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>


 </div>




    <div class="row">
        
            
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.id")}}:</strong>
                            <div>{{$Admin_notification->id}}</div>
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("admin_notifications.notification_id")}}:</strong>
                                {!!Form::select('notification_id', $notifications_texts,  $Admin_notification->notification_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("admin_notifications.model_id")}}:</strong>
                                {!!Form::select('model_id', $users,  $Admin_notification->model_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.is_marked_as_readed")}}:</strong>
                            <br>
                            <input disabled type="checkbox" name="is_marked_as_readed"  class="js-switch"

                            @if(old('is_marked_as_readed') != null)
                               @if(old('is_marked_as_readed')=="on")
                               checked
                               @endif
                           @else
                                @if($Admin_notification->is_marked_as_readed==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.is_marked_as_deleted")}}:</strong>
                            <br>
                            <input disabled type="checkbox" name="is_marked_as_deleted"  class="js-switch"

                            @if(old('is_marked_as_deleted') != null)
                               @if(old('is_marked_as_deleted')=="on")
                               checked
                               @endif
                           @else
                                @if($Admin_notification->is_marked_as_deleted==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.created_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Admin_notification->created_at))  , array('placeholder' => trans("admin_notifications.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.created_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Admin_notification->created_at)), array('placeholder' => trans("admin_notifications.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.updated_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Admin_notification->updated_at))  , array('placeholder' => trans("admin_notifications.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("admin_notifications.updated_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Admin_notification->updated_at)), array('placeholder' => trans("admin_notifications.updated_at "),'class' => 'form-control','disabled')) !!}
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
