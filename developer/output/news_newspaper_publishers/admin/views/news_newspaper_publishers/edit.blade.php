@extends('admin.layouts.app')

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
    {!! Form::model($News_newspaper_publisher, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['news_newspaper_publishers.update', $News_newspaper_publisher->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.country_id")}}:</strong>
                                {!!Form::select('country_id', $countries, $News_newspaper_publisher->country_id, ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.slug")}}:</strong>
                            {!! Form::text('slug', $News_newspaper_publisher->slug, array('placeholder' => trans("news_newspaper_publishers.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.newspaper_name_ar")}}:</strong>
                            {!! Form::text('newspaper_name_ar', $News_newspaper_publisher->newspaper_name_ar, array('placeholder' => trans("news_newspaper_publishers.newspaper_name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.newspaper_name_en")}}:</strong>
                            {!! Form::text('newspaper_name_en', $News_newspaper_publisher->newspaper_name_en, array('placeholder' => trans("news_newspaper_publishers.newspaper_name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar',$News_newspaper_publisher->description_ar, array('placeholder' => trans("news_newspaper_publishers.description_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.description_en")}}:</strong>
                            {!! Form::textarea('description_en',$News_newspaper_publisher->description_en, array('placeholder' => trans("news_newspaper_publishers.description_en"),'class' => 'form-control')) !!}
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
                            {!! Form::file('logo_image', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.email")}}:</strong>
                            {!! Form::text('email', $News_newspaper_publisher->email, array('placeholder' => trans("news_newspaper_publishers.email"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.website_link")}}:</strong>
                            {!! Form::text('website_link', $News_newspaper_publisher->website_link, array('placeholder' => trans("news_newspaper_publishers.website_link"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.facebook")}}:</strong>
                            {!! Form::text('facebook', $News_newspaper_publisher->facebook, array('placeholder' => trans("news_newspaper_publishers.facebook"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.twitter")}}:</strong>
                            {!! Form::text('twitter', $News_newspaper_publisher->twitter, array('placeholder' => trans("news_newspaper_publishers.twitter"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.linkedin")}}:</strong>
                            {!! Form::text('linkedin', $News_newspaper_publisher->linkedin, array('placeholder' => trans("news_newspaper_publishers.linkedin"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.SEO_newspaper_page_title")}}:</strong>
                            {!! Form::text('SEO_newspaper_page_title', $News_newspaper_publisher->SEO_newspaper_page_title, array('placeholder' => trans("news_newspaper_publishers.SEO_newspaper_page_title"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_newspaper_publishers.SEO_newspaper_page_metatags")}}:</strong>
                            {!! Form::textarea('SEO_newspaper_page_metatags',$News_newspaper_publisher->SEO_newspaper_page_metatags, array('placeholder' => trans("news_newspaper_publishers.SEO_newspaper_page_metatags"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_newspaper_publishers.sort")}}:</strong>
                                {!! Form::number('sort',$News_newspaper_publisher->sort, array('placeholder' => trans("news_newspaper_publishers.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_newspaper_publishers.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($News_newspaper_publisher->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($News_newspaper_publisher->active!="1") selected @endif>غير مفعل</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#active:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
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
                                    $("input").keydown(function(event){
                                        if(event.keyCode == 13) {
                                            event.preventDefault();
                                            $("form").submit();
                                            // return false;
                                        }
                                    });
                                });
                            </script>

    
@endsection
