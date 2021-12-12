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
                <a class="btn btn-primary" href="{{ route('contacts.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'contacts.store','method'=>'POST')) !!}
    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.flag")}}:</strong>
                            {!! Form::text('flag', null, array('placeholder' => trans("contacts.flag"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.name_ar")}}:</strong>
                            {!! Form::text('name_ar', null, array('placeholder' => trans("contacts.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.name_en")}}:</strong>
                            {!! Form::text('name_en', null, array('placeholder' => trans("contacts.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.icon_text")}}:</strong>
                            {!! Form::text('icon_text', null, array('placeholder' => trans("contacts.icon_text"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.image")}}:</strong>
                            {!! Form::file('image', null, array('placeholder' => trans("contacts.image"),'class' => 'form-control','disabled')) !!}
                                       </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.value_ar")}}:</strong>
                            {!! Form::text('value_ar', null, array('placeholder' => trans("contacts.value_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.value_en")}}:</strong>
                            {!! Form::text('value_en', null, array('placeholder' => trans("contacts.value_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.active")}}:</strong>
                            {!!Form::select('active', ['غير مفعل','مفعل'], null, ['class' => 'form-control'])!!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.sort")}}:</strong>
                            {!! Form::number('sort',$sort_number, array('placeholder' => trans("contacts.sort"),'class' => 'form-control')) !!}
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
