@extends('layouts.app')

@section('title',trans('abtests.abtests'))
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
                        <h5>{{trans('abtests.abtests')}}</h5>
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
                            <a href="#">{{trans('abtests.abtests')}}</a>
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
                                    <h5>{{trans('abtests.abtests')}}</h5>
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
                <h4>{{trans('admin_messages.EditModule')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ url('abtests') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>


 </div>



    {!! Form::model($Abtest, ['method' => 'PATCH','enctype'=>'multipart/form-data','url' => ['abtests', $Abtest->id]]) !!}
    <div class="row">


        
                
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("abtests.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Abtest->name_ar, array('placeholder' => trans("abtests.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("abtests.name_en")}}:</strong>
                            {!! Form::text('name_en', $Abtest->name_en, array('placeholder' => trans("abtests.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("abtests.number")}}:</strong>
                            {!! Form::text('number', $Abtest->number, array('placeholder' => trans("abtests.number"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                            <div class="form-group">
                            <strong>{{trans("abtests.image")}}:</strong>
                            <br>
                             <div class="col-md-12  text-center">

                             @if(isset($Abtest->image))
                                <img  src="{{url($Abtest->image)}}"  class="uploaded_image"
                     alt="image-Image" id="image_image">
                            @else
                            <img  src="{{url('storage/images/noimage.png')}}"  class="uploaded_image"
                     alt="image-Image" id="image_image">
                            @endif


                <input type="file" name="image" id="image_input"
                onchange="putImage('image_input','image_image',
                'change_image_btn')"
                name="image" class="inputfile_file">
                </div>

                 <div class="col-md-12  text-center top-marging-15">
                <button type="button" class="btn btn-outline-primary"
                onclick="OpenImgUpload('image_input','change_image_btn')">
                {{trans('admin_messages.Upload')}}
                </button>
                </div>
                        </div></div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("abtests.active")}}:</strong>
                            <select class="wide form-control" id="active" name="active">
                                <option value="1" @if($Abtest->active=="1") selected @endif>
                                    {{trans('admin_messages.active')}}</option>
                                <option value="0" @if($Abtest->active !="1") selected @endif>
                                    {{trans('admin_messages.inactive')}}
                                </option>
                                </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#active:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
                 <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("abtests.sort")}}:</strong>
                                {!! Form::number('sort',$Abtest->sort, array('placeholder' => trans("abtests.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                

        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans('admin_messages.Save')}}</button>
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
