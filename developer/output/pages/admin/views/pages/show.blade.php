@extends('backend.layouts.app')


@section('title',trans('pages.Admin - pages'))
@section('header')
@endsection

@section('content')

<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-bookmark bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('pages.Admin - pages')}}</h5>
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
                            <a href="#">{{trans('pages.pages')}}</a>
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
                                    <h5>{{trans('pages.Admin - pages')}}</h5>
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
                <a class="btn btn-primary" href="{{ route('pages.index') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>


 </div>




    <div class="row">
        
            
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.id")}}:</strong>
                            <div>{{$Page->id}}</div>
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.page_key")}}:</strong>
<div>{{$Page->page_key}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.title_ar")}}:</strong>
<div>{{$Page->title_ar}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.title_en")}}:</strong>
<div>{{$Page->title_en}}</div>                        </div>
                    </div>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.html_page_ar")}}:</strong>
                            <textarea name="html_page_ar" id="html_page_ar" >
                            @if(old('html_page_ar') != null)
                            {{ old('html_page_ar') }}
                            @else
                            {{$Page->html_page_ar}}
                            @endif
                            </textarea>
                        </div>
                    </div>
                     <script>
                        $('#html_page_ar').richText({});
                    </script>
                    
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.html_page_en")}}:</strong>
                            <textarea name="html_page_en" id="html_page_en" >
                            @if(old('html_page_en') != null)
                            {{ old('html_page_en') }}
                            @else
                            {{$Page->html_page_en}}
                            @endif
                            </textarea>
                        </div>
                    </div>
                     <script>
                        $('#html_page_en').richText({});
                    </script>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.created_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Page->created_at))  , array('placeholder' => trans("pages.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.created_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Page->created_at)), array('placeholder' => trans("pages.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.updated_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Page->updated_at))  , array('placeholder' => trans("pages.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("pages.updated_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Page->updated_at)), array('placeholder' => trans("pages.updated_at "),'class' => 'form-control','disabled')) !!}
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
