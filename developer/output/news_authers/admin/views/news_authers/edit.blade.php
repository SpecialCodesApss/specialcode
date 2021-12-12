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
                <a class="btn btn-primary" href="{{ route('news_authers.index') }}"> رجوع</a>
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
    {!! Form::model($News_auther, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['news_authers.update', $News_auther->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_authers.country_id")}}:</strong>
                                {!!Form::select('country_id', $countries, $News_auther->country_id, ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.slug")}}:</strong>
                            {!! Form::text('slug', $News_auther->slug, array('placeholder' => trans("news_authers.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $News_auther->name_ar, array('placeholder' => trans("news_authers.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.name_en")}}:</strong>
                            {!! Form::text('name_en', $News_auther->name_en, array('placeholder' => trans("news_authers.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.work_title")}}:</strong>
                            {!! Form::text('work_title', $News_auther->work_title, array('placeholder' => trans("news_authers.work_title"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_authers.Biographical_info_ar")}}:</strong>
                            {!! Form::textarea('Biographical_info_ar',$News_auther->Biographical_info_ar, array('placeholder' => trans("news_authers.Biographical_info_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_authers.Biographical_info_en")}}:</strong>
                            {!! Form::textarea('Biographical_info_en',$News_auther->Biographical_info_en, array('placeholder' => trans("news_authers.Biographical_info_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.profile_image")}}:</strong>
                            <div class="col-12">
                            @if(isset($News_auther->profile_image))
                                <img class="img-responsive" src="{{url($News_auther->profile_image)}}" alt="">
                            @endif
                            </div>
                            {!! Form::file('profile_image', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.email")}}:</strong>
                            {!! Form::text('email', $News_auther->email, array('placeholder' => trans("news_authers.email"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.website_link")}}:</strong>
                            {!! Form::text('website_link', $News_auther->website_link, array('placeholder' => trans("news_authers.website_link"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.facebook")}}:</strong>
                            {!! Form::text('facebook', $News_auther->facebook, array('placeholder' => trans("news_authers.facebook"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.twitter")}}:</strong>
                            {!! Form::text('twitter', $News_auther->twitter, array('placeholder' => trans("news_authers.twitter"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.linkedin")}}:</strong>
                            {!! Form::text('linkedin', $News_auther->linkedin, array('placeholder' => trans("news_authers.linkedin"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.SEO_auther_page_title")}}:</strong>
                            {!! Form::text('SEO_auther_page_title', $News_auther->SEO_auther_page_title, array('placeholder' => trans("news_authers.SEO_auther_page_title"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_authers.SEO_auther_page_metatags")}}:</strong>
                            {!! Form::textarea('SEO_auther_page_metatags',$News_auther->SEO_auther_page_metatags, array('placeholder' => trans("news_authers.SEO_auther_page_metatags"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_authers.sort")}}:</strong>
                                {!! Form::number('sort',$News_auther->sort, array('placeholder' => trans("news_authers.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_authers.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($News_auther->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($News_auther->active!="1") selected @endif>غير مفعل</option>
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
