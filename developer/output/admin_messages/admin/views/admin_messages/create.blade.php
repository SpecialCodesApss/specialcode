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
                <h4>{{trans('admin.Create')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route('admin_messages.index') }}">
                {{trans('admin.back')}}</a>
            </div>
        </div>
    </div>




    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'admin_messages.store',
    'method'=>'POST',
    'id'=>'form')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">

    <div class="row">


    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("admin_messages.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, "old('user_id')", ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.fullname")}}:</strong>
                            {!! Form::text('fullname', "", array('placeholder' => trans("admin_messages.fullname"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.email")}}:</strong>
                            {!! Form::text('email', "", array('placeholder' => trans("admin_messages.email"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.mobile")}}:</strong>
                            {!! Form::text('mobile', "", array('placeholder' => trans("admin_messages.mobile"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("admin_messages.message_type")}}:</strong>
                            <select class="wide form-control" id="message_type" name="message_type">
                                
                        <option value="Complaint"
                        @if(old('message_type')=="Complaint")!=null)
                            @if(old('message_type')=="Complaint")
                            selected
                            @endif
                        @endif
                        >{{trans('admin_messages.Complaint')}}</option>
                        
                        <option value="Suggestion"
                        @if(old('message_type')=="Suggestion")!=null)
                            @if(old('message_type')=="Suggestion")
                            selected
                            @endif
                        @endif
                        >{{trans('admin_messages.Suggestion')}}</option>
                        
                        <option value="Technical Support"
                        @if(old('message_type')=="Technical Support")!=null)
                            @if(old('message_type')=="Technical Support")
                            selected
                            @endif
                        @endif
                        >{{trans('admin_messages.Technical Support')}}</option>
                        
                        <option value="Management"
                        @if(old('message_type')=="Management")!=null)
                            @if(old('message_type')=="Management")
                            selected
                            @endif
                        @endif
                        >{{trans('admin_messages.Management')}}</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#message_type:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">

                            <div class="form-group">
                            <strong>{{trans("admin_messages.image")}}:</strong>
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
                {{trans('admin.Upload')}}
                </button>
                </div>


                        </div></div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("admin_messages.messages_text")}}:</strong>
                            {!! Form::textarea('messages_text',old('messages_text'), array('placeholder' => trans("admin_messages.messages_text"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("admin_messages.open_status")}}:</strong>
                            <select class="wide form-control" id="open_status" name="open_status">
                                
                        <option value="Open"
                        @if(old('open_status')=="Open")!=null)
                            @if(old('open_status')=="Open")
                            selected
                            @endif
                        @endif
                        >{{trans('admin_messages.Open')}}</option>
                        
                        <option value="Closed"
                        @if(old('open_status')=="Closed")!=null)
                            @if(old('open_status')=="Closed")
                            selected
                            @endif
                        @endif
                        >{{trans('admin_messages.Closed')}}</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#open_status:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                




        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans('admin.save')}}</button>
            <button type="button"  onclick="
            $('#save_type').val('save_and_add_new');
                document.getElementById('form').submit();
                return false
            " class="btn btn-primary">{{trans('admin.save_and_addNew')}}</button>
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

