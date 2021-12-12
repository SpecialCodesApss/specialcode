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
                <a class="btn btn-primary" href="{{ route('faqs.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'faqs.store','method'=>'POST')) !!}
    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("faqs.question_ar")}}:</strong>
                            {!! Form::text('question_ar', null, array('placeholder' => trans("faqs.question_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("faqs.question_en")}}:</strong>
                            {!! Form::text('question_en', null, array('placeholder' => trans("faqs.question_en"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("faqs.answer_ar")}}:</strong>
                            {!! Form::textarea('answer_ar', null, array('placeholder' => trans("faqs.answer_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("faqs.answer_en")}}:</strong>
                            {!! Form::textarea('answer_en', null, array('placeholder' => trans("faqs.answer_en"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("faqs.active")}}:</strong>
                            {!!Form::select('active', ['غير مفعل','مفعل'], null, ['class' => 'form-control'])!!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("faqs.sort")}}:</strong>
                            {!! Form::number('sort',$sort_number, array('placeholder' => trans("faqs.sort"),'class' => 'form-control')) !!}
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
