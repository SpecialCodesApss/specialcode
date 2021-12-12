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
                <a class="btn btn-primary" href="{{ route('contents.index') }}"> رجوع</a>
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


    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contents.content_key")}}:</strong>
                            {!! Form::text('content_key', $Content->content_key, array('placeholder' => trans("contents.content_key"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contents.cp_name")}}:</strong>
                            {!! Form::textarea('cp_name', $Content->cp_name, array('placeholder' => trans("contents.cp_name"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contents.content_ar")}}:</strong>
                            <textarea name="content_ar" id="content_ar" name="editordata" disabled>{{$Content->content_ar}}</textarea>                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contents.content_en")}}:</strong>
                            <textarea name="content_ar" id="content_en" name="editordata" disabled>{{$Content->content_en}}</textarea>                        </div>
                    </div>

    </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#content_ar').summernote({
                height: 300,
            });
            $('#content_en').summernote({
                height: 300,
            });
        });
    </script>
@endsection
