@extends('backend.layouts.app')
@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>إضافة جديد</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('pages.index') }}"> رجوع</a>
            </div>
        </div>
    </div>


    {{--    @if (count($errors) > 0)--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>خطأ!</strong> خطأ في البيانات.<br><br>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'pages.store','method'=>'POST')) !!}
    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.page_key")}}:</strong>
                            {!! Form::text('page_key', null, array('placeholder' => trans("pages.page_key"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.title_ar")}}:</strong>
                            {!! Form::text('title_ar', null, array('placeholder' => trans("pages.title_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.title_en")}}:</strong>
                            {!! Form::text('title_en', null, array('placeholder' => trans("pages.title_en"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.html_page_ar")}}:</strong>
                            {!! Form::textarea('html_page_ar', null, array('placeholder' => trans("pages.html_page_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.html_page_en")}}:</strong>
                            {!! Form::textarea('html_page_en', null, array('placeholder' => trans("pages.html_page_en"),'class' => 'form-control')) !!}
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
