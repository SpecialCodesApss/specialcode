@extends('backend.layouts.app')


@section('title',trans('products.Admin - products'))
@section('header')
@endsection

@section('content')

<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="empty bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('products.Admin - products')}}</h5>
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
                            <a href="#">{{trans('products.products')}}</a>
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
                                    <h5>{{trans('products.Admin - products')}}</h5>
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
                <a class="btn btn-primary" href="{{ route('products.index') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>


 </div>




    <div class="row">
        
            
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.id")}}:</strong>
                            <div>{{$Product->id}}</div>
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("products.type_selector")}}:</strong>

                            <div>
                {{trans("products.{$Product->type_selector}")}}
                </div>
                        </div>

                        <br><br>
                    </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.user_id")}}:</strong>
<div>{{$Product->user_id}}</div>                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.is_checkbox")}}:</strong>
                            <br>
                            <input disabled type="checkbox" name="is_checkbox"  class="js-switch"

                            @if(old('is_checkbox') != null)
                               @if(old('is_checkbox')=="on")
                               checked
                               @endif
                           @else
                                @if($Product->is_checkbox==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>
            
            
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("products.week_check")}}:</strong>
<div>{{$Product->week_check}}</div>
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.week_select")}}:</strong>
<div>{{$Product->week_select}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.name_ar")}}:</strong>
<div>{{$Product->name_ar}}</div>                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.name_en")}}:</strong>
<div>{{$Product->name_en}}</div>                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">

                            <div class="form-group">
                                <strong>{{trans("products.product_file")}}:</strong><br>
                                <div class="col-12">
                                <a href="{{url($Product->product_file)}}">
                                <u>{{trans('admin_messages.Download')}}</u></a>
                                </div>
                               </div>
                        </div>
            
            
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("products.description_ar")}}:</strong>
<div>{{$Product->description_ar}}</div>
                        </div>
                    </div>
            
            
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("products.description_en")}}:</strong>
<div>{{$Product->description_en}}</div>
                        </div>
                    </div>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.html_text_ar")}}:</strong>
                            <textarea name="html_text_ar" id="html_text_ar" >
                            @if(old('html_text_ar') != null)
                            {{ old('html_text_ar') }}
                            @else
                            {{$Product->html_text_ar}}
                            @endif
                            </textarea>
                        </div>
                    </div>
                     <script>
                        $('#html_text_ar').richText({});
                    </script>
                    
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.html_text_en")}}:</strong>
                            <textarea name="html_text_en" id="html_text_en" >
                            @if(old('html_text_en') != null)
                            {{ old('html_text_en') }}
                            @else
                            {{$Product->html_text_en}}
                            @endif
                            </textarea>
                        </div>
                    </div>
                     <script>
                        $('#html_text_en').richText({});
                    </script>
                    
            
             <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("products.sort")}}:</strong>
                                {!! Form::number('sort',$Product->sort, array('placeholder' => trans("products.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>{{trans("products.active")}}:</strong>

                                <div>
                                @if($Product->active=="1")
                                {{trans('admin_messages.active')}}
                                @else
                                {{trans('admin_messages.inactive')}}
                                @endif
                                </div>

                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.created_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Product->created_at))  , array('placeholder' => trans("products.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.created_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Product->created_at)), array('placeholder' => trans("products.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.updated_at")}}  {{trans("admin_messages.date")}} :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Product->updated_at))  , array('placeholder' => trans("products.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.updated_at")}}   {{trans("admin_messages.time")}}  :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Product->updated_at)), array('placeholder' => trans("products.updated_at "),'class' => 'form-control','disabled')) !!}
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
