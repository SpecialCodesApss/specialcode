@extends('layouts.app')



@section('title',trans('products.products'))
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
                        <h5>{{trans('products.products')}}</h5>
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
                                    <h5>{{trans('products.products')}}</h5>
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
                <a class="btn btn-primary" href="{{ url('products') }}">
                {{trans('admin_messages.back')}}</a>
            </div>
        </div>
    </div>




    {!! Form::open(array('enctype'=>'multipart/form-data','url' => 'products','method'=>'POST','id'=>'form')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">

    <div class="row">


    
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("products.type_selector")}}:</strong>
                            <select class="wide form-control" id="type_selector" name="type_selector">
                                
                        <option value="active"
                        @if(old('type_selector')=="active")!=null)
                            @if(old('type_selector')=="active")
                            selected
                            @endif
                        @endif
                        >{{trans('products.active')}}</option>
                        
                        <option value="inactive"
                        @if(old('type_selector')=="inactive")!=null)
                            @if(old('type_selector')=="inactive")
                            selected
                            @endif
                        @endif
                        >{{trans('products.inactive')}}</option>
                        
                        <option value="submit"
                        @if(old('type_selector')=="submit")!=null)
                            @if(old('type_selector')=="submit")
                            selected
                            @endif
                        @endif
                        >{{trans('products.submit')}}</option>
                        
                        <option value="role"
                        @if(old('type_selector')=="role")!=null)
                            @if(old('type_selector')=="role")
                            selected
                            @endif
                        @endif
                        >{{trans('products.role')}}</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#type_selector:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("products.type_selector")}}:</strong>
                            <select class="wide form-control" id="type_selector" name="type_selector">
                                
                        <option value="active"
                        @if(old('type_selector')=="active")!=null)
                            @if(old('type_selector')=="active")
                            selected
                            @endif
                        @endif
                        >{{trans('products.active')}}</option>
                        
                        <option value="inactive"
                        @if(old('type_selector')=="inactive")!=null)
                            @if(old('type_selector')=="inactive")
                            selected
                            @endif
                        @endif
                        >{{trans('products.inactive')}}</option>
                        
                        <option value="submit"
                        @if(old('type_selector')=="submit")!=null)
                            @if(old('type_selector')=="submit")
                            selected
                            @endif
                        @endif
                        >{{trans('products.submit')}}</option>
                        
                        <option value="role"
                        @if(old('type_selector')=="role")!=null)
                            @if(old('type_selector')=="role")
                            selected
                            @endif
                        @endif
                        >{{trans('products.role')}}</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#type_selector:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
                <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.is_checkbox")}}:</strong> <br>
                            <input type="checkbox" name="is_checkbox" class="js-switch"

                            @if(old('is_checkbox') != null)
                               @if(old('is_checkbox')=="on")
                               checked
                               @endif
                           @endif


                          >
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.week_check")}}:</strong>
                            {!! Form::textarea('week_check',old('week_check'), array('placeholder' => trans("products.week_check"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("products.week_select")}}:</strong>
                            {!! Form::number('week_select',"", array('placeholder' => trans("products.week_select"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("products.name_ar")}}:</strong>
                            {!! Form::text('name_ar', "", array('placeholder' => trans("products.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("products.name_en")}}:</strong>
                            {!! Form::text('name_en', "", array('placeholder' => trans("products.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">

                            <div class="form-group">
                            <strong>{{trans("products.product_file")}}:</strong><br>
                            <input type="file" id="product_file" name="product_file" class="file">

                        </div></div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar',old('description_ar'), array('placeholder' => trans("products.description_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.description_en")}}:</strong>
                            {!! Form::textarea('description_en',old('description_en'), array('placeholder' => trans("products.description_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.html_text_ar")}}:</strong>
                            <textarea name="html_text_ar" id="html_text_ar" >
                            {{ old('html_text_ar') }}</textarea>
                        </div>
                    </div>
                    <script>
                        $('#html_text_ar').richText({});
                    </script>

                    
                
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("products.html_text_en")}}:</strong>
                            <textarea name="html_text_en" id="html_text_en" >
                            {{ old('html_text_en') }}</textarea>
                        </div>
                    </div>
                    <script>
                        $('#html_text_en').richText({});
                    </script>

                    
                
                 <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("products.sort")}}:</strong>
                                {!! Form::number('sort',$sort_number, array('placeholder' => trans("products.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("products.active")}}:</strong>
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
                




        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans('admin_messages.save')}}</button>
            <button type="button"  onclick="
                $('#save_type').val('save_and_add_new');
                document.getElementById('form').submit();
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

<script type="text/javascript">

        $("#product_file").fileinput(
            {
                showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                allowedFileTypes:["image", "text", "video", "audio","pdf"],
                msgPlaceholder : "{{trans('admin_messages.Select file..')}}",
                msgSelected : "{{trans('admin_messages.msgSelected')}}",
                msgProcessing : "{{trans('admin_messages.msgProcessing')}}",
                removeTitle : "{{trans('admin_messages.removeTitle')}}",
                uploadTitle : "{{trans('admin_messages.uploadTitle')}}",
                downloadTitle : "{{trans('admin_messages.downloadTitle')}}",
                zoomTitle : "{{trans('admin_messages.zoomTitle')}}",
                dragTitle : "{{trans('admin_messages.dragTitle')}}",
                msgNo : "{{trans('admin_messages.msgNo')}}",
                msgNoFilesSelected : "{{trans('admin_messages.msgNoFilesSelected')}}",
                msgCancelled : "{{trans('admin_messages.msgCancelled')}}",
                msgPaused : "{{trans('admin_messages.msgPaused')}}",
                msgZoomTitle : "{{trans('admin_messages.msgZoomTitle')}}",
                msgZoomModalHeading : "{{trans('admin_messages.msgZoomModalHeading')}}",
                msgFileRequired : "{{trans('admin_messages.msgFileRequired')}}",
                browseLabel : "{{trans('admin_messages.browseLabel')}}",
                removeLabel : "{{trans('admin_messages.removeLabel')}}",
                dropZoneTitle : "{{trans('admin_messages.dropZoneTitle')}}",

            }
        );
    </script> 
@endsection
