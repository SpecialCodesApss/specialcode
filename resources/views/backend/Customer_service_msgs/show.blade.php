@extends('backend.layouts.app')


@section('content')

    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="row ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2> عرض البيانات</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('Customer_service_msgs.index') }}"> رجوع</a>
            </div>
        </div>
    </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>الاسم :</strong>
                            {!! Form::text('user_id',$Customer_service_msg->user_id, array('placeholder' => 'كود المستخدم','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>اسم المستخدم :</strong>
                            {!! Form::text('user_name', $Customer_service_msg->user_name, array('placeholder' => 'اسم المستخدم ','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>البريد الالكتروني :</strong>
                            {!! Form::text('email', $Customer_service_msg->email, array('placeholder' => 'البريد الالكتروني','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>الجوال:</strong>
                            {!! Form::text('mobile', $Customer_service_msg->mobile, array('placeholder' => 'الجوال','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>الرسالة :</strong>
                            {!! Form::textarea('user_message', $Customer_service_msg->user_message, array('class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
