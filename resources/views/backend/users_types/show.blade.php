@extends('backend.layouts.app')

@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>عرض البيانات  </h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('users_types.index') }}"> رجوع</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>خطأ!</strong> خطأ في البيانات.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">

                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("users_types.id")}}:</strong>
                            {!! Form::number('id', $Users_type->id, array('placeholder' => trans("users_types.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("users_types.type_name_ar")}}:</strong>
                            {!! Form::text('type_name_ar', $Users_type->type_name_ar, array('placeholder' => trans("users_types.type_name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("users_types.type_name_en")}}:</strong>
                            {!! Form::text('type_name_en', $Users_type->type_name_en, array('placeholder' => trans("users_types.type_name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("users_types.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Users_type->created_at))  , array('placeholder' => trans("users_types.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("users_types.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Users_type->created_at)), array('placeholder' => trans("users_types.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("users_types.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Users_type->updated_at))  , array('placeholder' => trans("users_types.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("users_types.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Users_type->updated_at)), array('placeholder' => trans("users_types.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>




    </div>

            </div>
        </div>
    </div>


@endsection
