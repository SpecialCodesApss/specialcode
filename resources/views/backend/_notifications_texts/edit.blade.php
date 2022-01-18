@extends('backend.layouts.app')

@section('title',trans('notifications_texts.Admin - notifications_texts'))
@section('header')
@endsection

@section('content')


<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fab fa-accusoft bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('notifications_texts.Admin - notifications_texts')}}</h5>
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
                            <a href="#">{{trans('notifications_texts.notifications_texts')}}</a>
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
                                    <h5>{{trans('notifications_texts.Admin - notifications_texts')}}</h5>
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
                <h4>{{trans('admin.EditModule')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route('notifications_texts.index') }}">
                {{trans('admin.back')}}</a>
            </div>
        </div>


 </div>



    {!! Form::model($Notifications_text, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['notifications_texts.update', $Notifications_text->id]]) !!}
    <div class="row">




                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("notifications_texts.description_text_en")}}:</strong>
                            {!! Form::textarea('description_text_en',$Notifications_text->description_text_en, array('placeholder' => trans("notifications_texts.description_text_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>


                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("notifications_texts.description_text_ar")}}:</strong>
                            {!! Form::textarea('description_text_ar',$Notifications_text->description_text_ar, array('placeholder' => trans("notifications_texts.description_text_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>

                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("notifications_texts.trarget_url")}}:</strong>
                            {!! Form::text('trarget_url', $Notifications_text->trarget_url, array('placeholder' => trans("notifications_texts.trarget_url"),'class' => 'form-control')) !!}
                        </div>
                    </div>

                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("notifications_texts.icon")}}:</strong>
                            {!! Form::text('icon', $Notifications_text->icon, array('placeholder' => trans("notifications_texts.icon"),'class' => 'form-control')) !!}
                        </div>
                    </div>



        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans('admin.Save')}}</button>
        </div>
    </div>
    {!! Form::close() !!}
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


     <script>
                                $(document).ready(function() {
                                    $("input").keydown(function(event){
                                        if(event.keyCode == 13) {
                                            event.preventDefault();
                                            $("form").submit();
                                            // return false;
                                        }
                                    });
                                });
                            </script>


@endsection


@section('footer')

@endsection
