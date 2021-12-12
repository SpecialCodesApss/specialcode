@extends('backend.layouts.app')
@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <h2> تعديل البيانات</h2>
                        </div>
{{--                        <div class="pull-left">--}}
{{--                            <a class="btn btn-primary" href="{{ route('contents.index') }}"> رجوع</a>--}}
{{--                        </div>--}}
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

                {!! Form::model($Setting, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['settings.update', $Setting->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("settings.content_key")}}:</strong>
                            {!! Form::text('content_key',  $Setting->setting_key, array('placeholder' => trans("contents.content_key"),'class' => 'form-control', 'disabled')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("settings.setting_value")}}:</strong>
                            <textarea name="setting_value" id="setting_value" >{{$Setting->setting_value}}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("settings.setting_alternate_value")}}:</strong>
                            <textarea name="setting_alternate_value" id="setting_alternate_value" >{{$Setting->setting_alternate_value}}</textarea>
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

    <script>
        $(document).ready(function() {
            $('#setting_value').summernote({
                height: 300,
            });
            $('#setting_alternate_value').summernote({
                height: 300,
            });
        });
    </script>
@endsection
