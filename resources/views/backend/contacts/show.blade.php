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


    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.flag")}}:</strong>
                            {!! Form::text('flag', $Contact->flag, array('placeholder' => trans("contacts.flag"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Contact->name_ar, array('placeholder' => trans("contacts.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.name_en")}}:</strong>
                            {!! Form::text('name_en', $Contact->name_en, array('placeholder' => trans("contacts.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.icon_text")}}:</strong>
                            {!! Form::text('icon_text', $Contact->icon_text, array('placeholder' => trans("contacts.icon_text"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.image")}}:</strong>
                            <div class="col-12">
                                <img class="img-responsive" src="{{url($Contact->image)}}" alt="">
                            </div>
                                       </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.value_ar")}}:</strong>
                            {!! Form::text('value_ar', $Contact->value_ar, array('placeholder' => trans("contacts.value_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.value_en")}}:</strong>
                            {!! Form::text('value_en', $Contact->value_en, array('placeholder' => trans("contacts.value_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.active")}}:</strong>
                            {!!Form::select('active', ['غير مفعل','مفعل'], $Contact->active, ['class' => 'form-control','disabled'])!!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("contacts.sort")}}:</strong>
                            {!! Form::number('sort',$Contact->sort, array('placeholder' => trans("contacts.sort"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

    </div>

            </div>
        </div>
    </div>
@endsection
