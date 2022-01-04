@extends('backend.layouts.app')


@section('content')

    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="row ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2> عرض المستخدم</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> رجوع</a>
            </div>
        </div>
    </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>الاسم :</strong>
                            {!! Form::text('fullname',$user->fullname, array('placeholder' => 'الاسم','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>البريد الالكتروني:</strong>
                            {!! Form::text('email', $user->email, array('placeholder' => 'البريد','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>نوع المستخدم :</strong>
                            {!! Form::select('type', ['عميل'=>'عميل','دكتور'=>'دكتور'],$user->type,array('class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>النوع</strong>
                        {!! Form::select('gender', ['male'=>'ذكر','female'=>'انثي'],$user->gender,array('class' => 'form-control','disabled')) !!}
                    </div>
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>الجوال :</strong>
                            {!! Form::text('mobile', $user->mobile, array('placeholder' => 'الجوال','class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>الصلاحية :</strong>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple','disabled')) !!}
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
