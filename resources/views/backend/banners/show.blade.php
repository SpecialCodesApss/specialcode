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
                <a class="btn btn-primary" href="{{ route('banners.index') }}"> رجوع</a>
            </div>
        </div>
    </div>


    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.image")}}:</strong>
                            <div class="col-12">
                                <img class="img-responsive" src="{{url($Banner->image)}}" alt="">
                            </div>
                                       </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.url")}}:</strong>
                            {!! Form::textarea('url', $Banner->url, array('placeholder' => trans("banners.url"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.active")}}:</strong>
                            {!!Form::select('active', ['غير مفعل','مفعل'], $Banner->active, ['class' => 'form-control','disabled'])!!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("banners.sort")}}:</strong>
                            {!! Form::number('sort',$Banner->sort, array('placeholder' => trans("banners.sort"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

    </div>

            </div>
        </div>
    </div>
@endsection
