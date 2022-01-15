@extends('layouts.app')


@section('title',trans('faqs.faqs'))
@section('header')
@endsection

@section('content')

<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-question bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('faqs.faqs')}}</h5>
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
                            <a href="#">{{trans('faqs.faqs')}}</a>
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
                                    <h5>{{trans('faqs.faqs')}}</h5>
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
                <a class="btn btn-primary" href="{{ url('faqs') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>


 </div>




    <div class="row">
        
            
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.id")}}:</strong>
                            <div>{{$Faq->id}}</div>
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.question_ar")}}:</strong>
<div>{{$Faq->question_ar}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.question_en")}}:</strong>
<div>{{$Faq->question_en}}</div>                        </div>
                    </div>
            
            
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("faqs.answer_ar")}}:</strong>
<div>{{$Faq->answer_ar}}</div>
                        </div>
                    </div>
            
            
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("faqs.answer_en")}}:</strong>
<div>{{$Faq->answer_en}}</div>
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>{{trans("faqs.active")}}:</strong>

                                <div>
                                @if($Faq->active=="1")
                                {{trans('admin_messages.active')}}
                                @else
                                {{trans('admin_messages.inactive')}}
                                @endif
                                </div>

                            </div>
                        </div>
            
             <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("faqs.sort")}}:</strong>
                                {!! Form::number('sort',$Faq->sort, array('placeholder' => trans("faqs.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.created_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Faq->created_at))  , array('placeholder' => trans("faqs.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.created_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Faq->created_at)), array('placeholder' => trans("faqs.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.updated_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Faq->updated_at))  , array('placeholder' => trans("faqs.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("faqs.updated_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Faq->updated_at)), array('placeholder' => trans("faqs.updated_at "),'class' => 'form-control','disabled')) !!}
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
