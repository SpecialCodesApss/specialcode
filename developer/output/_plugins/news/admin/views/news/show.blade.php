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
                <a class="btn btn-primary" href="{{ route('news.index') }}"> رجوع</a>
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
                            <strong>{{trans("news.id")}}:</strong>
                            {!! Form::number('id', $News->id, array('placeholder' => trans("news.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.category_id")}}:</strong>
                                {!!Form::select('category_id', $news_categories,  $News->category_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.publisher_newspaper_id")}}:</strong>
                                {!!Form::select('publisher_newspaper_id', $news_newspaper_publishers,  $News->publisher_newspaper_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.auther_id")}}:</strong>
                                {!!Form::select('auther_id', $news_authers,  $News->auther_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.country_id")}}:</strong>
                                {!!Form::select('country_id', $countries,  $News->country_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.city_id")}}:</strong>
                                {!!Form::select('city_id', $country_cities,  $News->city_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news.title_ar")}}:</strong>
                            {!! Form::text('title_ar', $News->title_ar, array('placeholder' => trans("news.title_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news.sub_title_ar")}}:</strong>
                            {!! Form::text('sub_title_ar', $News->sub_title_ar, array('placeholder' => trans("news.sub_title_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news.content_ar_html")}}:</strong>
                            <textarea name="content_ar_html" id="content_ar_html" > {{$News->content_ar_html}}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#content_ar_html').richText();
                        });
                    </script>
                    
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news.title_en")}}:</strong>
                            {!! Form::text('title_en', $News->title_en, array('placeholder' => trans("news.title_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news.sub_title_en")}}:</strong>
                            {!! Form::text('sub_title_en', $News->sub_title_en, array('placeholder' => trans("news.sub_title_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news.content_en_html")}}:</strong>
                            <textarea name="content_en_html" id="content_en_html" > {{$News->content_en_html}}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#content_en_html').richText();
                        });
                    </script>
                    
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.image")}}:</strong>
                                <div class="col-12">
                                @if(isset($News->image))
                                    <img class="img-responsive" src="{{url($News->image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news.image_caption")}}:</strong>
                            {!! Form::text('image_caption', $News->image_caption, array('placeholder' => trans("news.image_caption"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.is_video_news")}}:</strong>
                            <input type="checkbox" name="is_video_news" class="form-control disabled"  
                            @if($News->is_video_news==1 || old('is_video_news') =="on") checked @endif>
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.video")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News->video}}"><u>{{$News->video}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.published")}}:</strong>
                            <input type="checkbox" name="published" class="form-control disabled"  
                            @if($News->published==1 || old('published') =="on") checked @endif>
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.publish_date")}}:</strong>
                            {!! Form::date('publish_date', $News->publish_date, array('placeholder' => trans("news.publish_date"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.archive_date")}}:</strong>
                            {!! Form::date('archive_date', $News->archive_date, array('placeholder' => trans("news.archive_date"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news.news_types_tags")}}:</strong><br>
                                <input id="news_types_tags" name="news_types_tags" type="text" value="{{$News->news_types_tags}}"  disabled="disabled">
                            <script type="text/javascript">
                                news_types_tags_autoComplete = [];
                                $(function() {
                                    $('#news_types_tags').tagsInput();
                                    $("#news_types_tags_tag").attr("disabled",'disabled');
                                });
                                
                                function checknews_types_tags_for_news_forFieldnews_types_tags(name_ar,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checknews_types_tags_for_news_forFieldnews_types_tags")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            name_ar:name_ar,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }
                                
                                function searchnews_types_tags_for_news_forFieldnews_types_tags(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchnews_types_tags_for_news_forFieldnews_types_tags")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            search_text:search_text,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            search_res = response;
                                            successCallback(search_res);
                                        },
                                    });
                                }
                            </script>
                             </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news.permalink_tag")}}:</strong>
                            {!! Form::text('permalink_tag', $News->permalink_tag, array('placeholder' => trans("news.permalink_tag"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news.SEO_tags")}}:</strong>
                            {!! Form::textarea('SEO_tags', $News->SEO_tags, array('placeholder' => trans("news.SEO_tags"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.is_comment_allowed")}}:</strong>
                            <input type="checkbox" name="is_comment_allowed" class="form-control disabled"  
                            @if($News->is_comment_allowed==1 || old('is_comment_allowed') =="on") checked @endif>
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.is_breaking_news")}}:</strong>
                            <input type="checkbox" name="is_breaking_news" class="form-control disabled"  
                            @if($News->is_breaking_news==1 || old('is_breaking_news') =="on") checked @endif>
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.is_slider_news")}}:</strong>
                            <input type="checkbox" name="is_slider_news" class="form-control disabled"  
                            @if($News->is_slider_news==1 || old('is_slider_news') =="on") checked @endif>
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.is_company_news")}}:</strong>
                            <input type="checkbox" name="is_company_news" class="form-control disabled"  
                            @if($News->is_company_news==1 || old('is_company_news') =="on") checked @endif>
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news.company_id")}}:</strong>
                                {!!Form::select('company_id', $companies,  $News->company_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news.news_languages")}}:</strong><br>
                 @foreach($languages as $info)
                    <input type="checkbox" name="news_languages[]" disabled="disabled" value="{{$info->id}}"
                     @if(in_array($info->id,$News->news_languages)) checked @endif > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.views_count")}}:</strong>
                            {!! Form::number('views_count', $News->views_count, array('placeholder' => trans("news.views_count"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.comments_count")}}:</strong>
                            {!! Form::number('comments_count', $News->comments_count, array('placeholder' => trans("news.comments_count"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news.sort")}}:</strong>
                                {!! Form::number('sort',$News->sort, array('placeholder' => trans("news.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($News->created_at))  , array('placeholder' => trans("news.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($News->created_at)), array('placeholder' => trans("news.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($News->updated_at))  , array('placeholder' => trans("news.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($News->updated_at)), array('placeholder' => trans("news.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
