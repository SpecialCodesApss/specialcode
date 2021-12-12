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
                <a class="btn btn-primary" href="{{ route('system_errors.index') }}"> رجوع</a>
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
                            <strong>{{trans("system_errors.id")}}:</strong>
                            {!! Form::number('id', $System_error->id, array('placeholder' => trans("system_errors.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("system_errors.error_title")}}:</strong>
                            {!! Form::textarea('error_title', $System_error->error_title, array('placeholder' => trans("system_errors.error_title"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("system_errors.error_text")}}:</strong>
                            {!! Form::textarea('error_text', $System_error->error_text, array('placeholder' => trans("system_errors.error_text"),'class' => 'form-control','disabled','style' => 'height: 700px !important;')) !!}
                        </div>
                    </div> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("system_errors.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($System_error->created_at))  , array('placeholder' => trans("system_errors.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("system_errors.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($System_error->created_at)), array('placeholder' => trans("system_errors.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("system_errors.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($System_error->updated_at))  , array('placeholder' => trans("system_errors.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("system_errors.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($System_error->updated_at)), array('placeholder' => trans("system_errors.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>




    </div>

            </div>
        </div>
    </div>


@endsection
