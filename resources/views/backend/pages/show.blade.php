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


    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.page_key")}}:</strong>
                            {!! Form::text('page_key', $Page->page_key, array('placeholder' => trans("pages.page_key"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.title_ar")}}:</strong>
                            {!! Form::text('title_ar', $Page->title_ar, array('placeholder' => trans("pages.title_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("pages.title_en")}}:</strong>
                            {!! Form::text('title_en', $Page->title_en, array('placeholder' => trans("pages.title_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{trans("pages.html_page_ar")}}:</strong>
                        <textarea name="html_page_ar" id="content_ar" disabled="disabled" name="editordata">{{$Page->html_page_ar}}</textarea>
                    </div>
                </div> <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{trans("pages.html_page_en")}}:</strong>
                        <textarea name="html_page_en" id="content_en" disabled="disabled" name="editordata">{{$Page->html_page_en}}</textarea>
                    </div>
                </div>

    </div>

            </div>
        </div>
    </div>

     <script>
            $(document).ready(function() {
                $('#content_ar').richText();
                $('#content_en').richText();
            });
        </script>
@endsection
