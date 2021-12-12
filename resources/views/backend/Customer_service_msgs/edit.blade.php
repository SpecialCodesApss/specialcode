@extends('backend.layouts.app')


@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>تعديل البيانات</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('Customer_service_msgs.index') }}"> رجوع</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>خطأ!</strong> خطأ في ادخال البيانات.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($Customer_service_msg, ['method' => 'PATCH','route' => ['Customer_service_msgs.update', $Customer_service_msg->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>كود المستخدم :</strong>
                {!! Form::text('user_id', null, array('placeholder' => 'كود المستخدم','class' => 'form-control')) !!}
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>اسم المستخدم :</strong>
                {!! Form::text('user_name', null, array('placeholder' => 'اسم المستخدم','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>البريد الالكتروني :</strong>
                {!! Form::text('email', null,array('placeholder' => 'البريد الالكتروني','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الجوال:</strong>
                {!! Form::text('mobile',null, array('placeholder' => 'الجوال','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الرسالة :</strong>
                {!! Form::textarea('user_message',null, array('class' => 'form-control',)) !!}
            </div>
        </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>

    {!! Form::close() !!}



            </div>
        </div>
    </div>
@endsection
