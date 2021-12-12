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
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('banners.index') }}"> رجوع</a>
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
    {!! Form::model($Banner, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['banners.update', $Banner->id]]) !!}
    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.image")}}:</strong>
                            <div class="col-12">
                                <img class="img-responsive" src="{{url($Banner->image)}}" alt="">
                            </div>
                            {!! Form::file('image', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{trans("banners.url")}}:</strong>
                        {!! Form::textarea('url',  $Banner->url, array('placeholder' => trans("banners.url"),'class' => 'form-control')) !!}
                    </div>
                </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.active")}}:</strong>
                            {!!Form::select('active', ['غير مفعل','مفعل'], $Banner->active, ['class' => 'form-control'])!!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.sort")}}:</strong>
                            {!! Form::number('sort',$Banner->sort, array('placeholder' => trans("banners.sort"),'class' => 'form-control')) !!}
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
