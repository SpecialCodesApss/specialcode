@extends('backend.layouts.app')


@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>تعديل بيانات المستخدم</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> رجوع</a>
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


    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الاسم :</strong>
                {!! Form::text('fullname', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>البريد الالكتروني:</strong>
                {!! Form::text('email', null, array('placeholder' => 'البريد','class' => 'form-control')) !!}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>نوع المستخدم :</strong>
                {!! Form::select('type', ['عميل'=>'عميل','دكتور'=>'دكتور'],$user->type,array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>النوع</strong>
                        {!! Form::select('gender', ['male'=>'ذكر','female'=>'انثي'],$user->gender,array('class' => 'form-control')) !!}
                    </div>
                </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الجوال :</strong>
                {!! Form::text('mobile', $user->mobile, array('placeholder' => 'الجوال','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الرقم السري :</strong>
                {!! Form::password('password', array('placeholder' => 'الرقم السري','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>إعادة الرقم السري :</strong>
                {!! Form::password('c_password', array('placeholder' => ' إعادة الرقم السري','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الصلاحية :</strong>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close() !!}



            </div>
        </div>
    </div>
@endsection
