@extends('backend.layouts.app')



@section('title',trans('tests.Admin - tests'))
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
                        <h5>{{trans('tests.Admin - tests')}}</h5>
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
                            <a href="#">{{trans('tests.tests')}}</a>
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
                                    <h5>{{trans('tests.Admin - tests')}}</h5>
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
                <h4>{{trans('admin_messages.Create')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route('tests.index') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>
    </div>




    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'tests.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">

    <div class="row">


    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("tests.name_ar")}}:</strong>
                            {!! Form::text('name_ar', "", array('placeholder' => trans("tests.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("tests.name_en")}}:</strong>
                            {!! Form::text('name_en', "", array('placeholder' => trans("tests.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("tests.number")}}:</strong>
                            {!! Form::text('number', "", array('placeholder' => trans("tests.number"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">

                            <div class="form-group">
                            <strong>{{trans("tests.image")}}:</strong>
                            <br>
                             <div class="col-md-12  text-center">
                              <img src="{{url('storage/images/noimage.png')}}" class="uploaded_image"
                     alt="image-Image" id="image_image">
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
                            <strong>{{trans("tests.active")}}:</strong>
                               <select class="wide form-control" id="active" name="active">
                                <option value="1" @if(old('active')=="1") selected @endif>
                                    {{trans('admin_messages.active')}}</option>
                                <option value="0" @if(old('active')=="0") selected @endif>
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
                                <strong>{{trans("tests.sort")}}:</strong>
                                {!! Form::number('sort',$sort_number, array('placeholder' => trans("tests.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                




        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans('admin_messages.save')}}</button>
            <button type="button"  onclick="
                $('#save_type').val('save_and_add_new');
                $('form').submit();
                return false
            " class="btn btn-primary">{{trans('admin_messages.save_and_addNew')}}</button>
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
