@extends('admin.layouts.app')

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
                <a class="btn btn-primary" href="{{ route('news_newspaper_publishers.index') }}"> رجوع</a>
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
                            <strong>{{trans("news_newspaper_publishers.id")}}:</strong>
                            {!! Form::number('id', $News_newspaper_publisher->id, array('placeholder' => trans("news_newspaper_publishers.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.country_id")}}:</strong>
                                {!!Form::select('country_id', $countries,  $News_newspaper_publisher->country_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.slug")}}:</strong>
                            {!! Form::text('slug', $News_newspaper_publisher->slug, array('placeholder' => trans("news_newspaper_publishers.slug"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.newspaper_name_ar")}}:</strong>
                            {!! Form::text('newspaper_name_ar', $News_newspaper_publisher->newspaper_name_ar, array('placeholder' => trans("news_newspaper_publishers.newspaper_name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.newspaper_name_en")}}:</strong>
                            {!! Form::text('newspaper_name_en', $News_newspaper_publisher->newspaper_name_en, array('placeholder' => trans("news_newspaper_publishers.newspaper_name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar', $News_newspaper_publisher->description_ar, array('placeholder' => trans("news_newspaper_publishers.description_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.description_en")}}:</strong>
                            {!! Form::textarea('description_en', $News_newspaper_publisher->description_en, array('placeholder' => trans("news_newspaper_publishers.description_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.logo_image")}}:</strong>
                                <div class="col-12">
                                @if(isset($News_newspaper_publisher->logo_image))
                                    <img class="img-responsive" src="{{url($News_newspaper_publisher->logo_image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.email")}}:</strong>
                            {!! Form::text('email', $News_newspaper_publisher->email, array('placeholder' => trans("news_newspaper_publishers.email"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.website_link")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_newspaper_publisher->website_link}}"><u>{{$News_newspaper_publisher->website_link}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.facebook")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_newspaper_publisher->facebook}}"><u>{{$News_newspaper_publisher->facebook}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.twitter")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_newspaper_publisher->twitter}}"><u>{{$News_newspaper_publisher->twitter}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.linkedin")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_newspaper_publisher->linkedin}}"><u>{{$News_newspaper_publisher->linkedin}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.SEO_newspaper_page_title")}}:</strong>
                            {!! Form::text('SEO_newspaper_page_title', $News_newspaper_publisher->SEO_newspaper_page_title, array('placeholder' => trans("news_newspaper_publishers.SEO_newspaper_page_title"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.SEO_newspaper_page_metatags")}}:</strong>
                            {!! Form::textarea('SEO_newspaper_page_metatags', $News_newspaper_publisher->SEO_newspaper_page_metatags, array('placeholder' => trans("news_newspaper_publishers.SEO_newspaper_page_metatags"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.sort")}}:</strong>
                                {!! Form::number('sort',$News_newspaper_publisher->sort, array('placeholder' => trans("news_newspaper_publishers.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $News_newspaper_publisher->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($News_newspaper_publisher->created_at))  , array('placeholder' => trans("news_newspaper_publishers.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($News_newspaper_publisher->created_at)), array('placeholder' => trans("news_newspaper_publishers.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($News_newspaper_publisher->updated_at))  , array('placeholder' => trans("news_newspaper_publishers.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($News_newspaper_publisher->updated_at)), array('placeholder' => trans("news_newspaper_publishers.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
