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


    <div class="row">
        
            
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_authers.id")}}:</strong>
                            {!! Form::number('id', $News_auther->id, array('placeholder' => trans("news_authers.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_authers.country_id")}}:</strong>
                                {!!Form::select('country_id', $countries,  $News_auther->country_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.slug")}}:</strong>
                            {!! Form::text('slug', $News_auther->slug, array('placeholder' => trans("news_authers.slug"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $News_auther->name_ar, array('placeholder' => trans("news_authers.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.name_en")}}:</strong>
                            {!! Form::text('name_en', $News_auther->name_en, array('placeholder' => trans("news_authers.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.work_title")}}:</strong>
                            {!! Form::text('work_title', $News_auther->work_title, array('placeholder' => trans("news_authers.work_title"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_authers.Biographical_info_ar")}}:</strong>
                            {!! Form::textarea('Biographical_info_ar', $News_auther->Biographical_info_ar, array('placeholder' => trans("news_authers.Biographical_info_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_authers.Biographical_info_en")}}:</strong>
                            {!! Form::textarea('Biographical_info_en', $News_auther->Biographical_info_en, array('placeholder' => trans("news_authers.Biographical_info_en"),'class' => 'form-control','disabled')) !!}
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
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.email")}}:</strong>
                            {!! Form::text('email', $News_auther->email, array('placeholder' => trans("news_authers.email"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_authers.website_link")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_auther->website_link}}"><u>{{$News_auther->website_link}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_authers.facebook")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_auther->facebook}}"><u>{{$News_auther->facebook}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_authers.twitter")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_auther->twitter}}"><u>{{$News_auther->twitter}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_authers.linkedin")}}:</strong>
                                <div class="col-12">
                                <a href="{{$News_auther->linkedin}}"><u>{{$News_auther->linkedin}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_authers.SEO_auther_page_title")}}:</strong>
                            {!! Form::text('SEO_auther_page_title', $News_auther->SEO_auther_page_title, array('placeholder' => trans("news_authers.SEO_auther_page_title"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_authers.SEO_auther_page_metatags")}}:</strong>
                            {!! Form::textarea('SEO_auther_page_metatags', $News_auther->SEO_auther_page_metatags, array('placeholder' => trans("news_authers.SEO_auther_page_metatags"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_authers.sort")}}:</strong>
                                {!! Form::number('sort',$News_auther->sort, array('placeholder' => trans("news_authers.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_authers.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $News_auther->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_authers.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($News_auther->created_at))  , array('placeholder' => trans("news_authers.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_authers.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($News_auther->created_at)), array('placeholder' => trans("news_authers.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_authers.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($News_auther->updated_at))  , array('placeholder' => trans("news_authers.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_authers.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($News_auther->updated_at)), array('placeholder' => trans("news_authers.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
