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
                <a class="btn btn-primary" href="{{ route('companies.index') }}"> رجوع</a>
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
                            <strong>{{trans("companies.id")}}:</strong>
                            {!! Form::number('id', $Companie->id, array('placeholder' => trans("companies.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies.categories")}}:</strong><br>
                 @foreach($companies_categories as $info)
                    <input type="checkbox" name="categories[]" disabled="disabled" value="{{$info->id}}"
                     @if(in_array($info->id,$Companie->categories)) checked @endif > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.country_id")}}:</strong>
                                {!!Form::select('country_id', $countries,  $Companie->country_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.city_id")}}:</strong>
                                {!!Form::select('city_id', $country_cities,  $Companie->city_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.slug")}}:</strong>
                            {!! Form::text('slug', $Companie->slug, array('placeholder' => trans("companies.slug"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.company_name_ar")}}:</strong>
                            {!! Form::text('company_name_ar', $Companie->company_name_ar, array('placeholder' => trans("companies.company_name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.company_name_en")}}:</strong>
                            {!! Form::text('company_name_en', $Companie->company_name_en, array('placeholder' => trans("companies.company_name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar', $Companie->description_ar, array('placeholder' => trans("companies.description_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.description_en")}}:</strong>
                            {!! Form::textarea('description_en', $Companie->description_en, array('placeholder' => trans("companies.description_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.logo_image")}}:</strong>
                                <div class="col-12">
                                @if(isset($Companie->logo_image))
                                    <img class="img-responsive" src="{{url($Companie->logo_image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.email")}}:</strong>
                            {!! Form::text('email', $Companie->email, array('placeholder' => trans("companies.email"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.phone_number")}}:</strong>
                            {!! Form::text('phone_number', $Companie->phone_number, array('placeholder' => trans("companies.phone_number"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.whatsapp_number")}}:</strong>
                            {!! Form::text('whatsapp_number', $Companie->whatsapp_number, array('placeholder' => trans("companies.whatsapp_number"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.website_link")}}:</strong>
                                <div class="col-12">
                                <a href="{{$Companie->website_link}}"><u>{{$Companie->website_link}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.address")}}:</strong>
                            {!! Form::textarea('address', $Companie->address, array('placeholder' => trans("companies.address"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.lat")}}:</strong>
                            {!! Form::text('lat', $Companie->lat, array('placeholder' => trans("companies.lat"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.lng")}}:</strong>
                            {!! Form::text('lng', $Companie->lng, array('placeholder' => trans("companies.lng"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.facebook")}}:</strong>
                                <div class="col-12">
                                <a href="{{$Companie->facebook}}"><u>{{$Companie->facebook}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.twitter")}}:</strong>
                                <div class="col-12">
                                <a href="{{$Companie->twitter}}"><u>{{$Companie->twitter}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.linkedin")}}:</strong>
                                <div class="col-12">
                                <a href="{{$Companie->linkedin}}"><u>{{$Companie->linkedin}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies.youtube")}}:</strong>
                                <div class="col-12">
                                <a href="{{$Companie->youtube}}"><u>{{$Companie->youtube}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.SEO_company_page_title")}}:</strong>
                            {!! Form::text('SEO_company_page_title', $Companie->SEO_company_page_title, array('placeholder' => trans("companies.SEO_company_page_title"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.SEO_company_page_metatags")}}:</strong>
                            {!! Form::textarea('SEO_company_page_metatags', $Companie->SEO_company_page_metatags, array('placeholder' => trans("companies.SEO_company_page_metatags"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.is_recommended")}}:</strong>
                            <input type="checkbox" name="is_recommended" class="form-control disabled"  
                            @if($Companie->is_recommended==1 || old('is_recommended') =="on") checked @endif>
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.views_count")}}:</strong>
                            {!! Form::number('views_count', $Companie->views_count, array('placeholder' => trans("companies.views_count"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies.sort")}}:</strong>
                                {!! Form::number('sort',$Companie->sort, array('placeholder' => trans("companies.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Companie->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Companie->created_at))  , array('placeholder' => trans("companies.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Companie->created_at)), array('placeholder' => trans("companies.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Companie->updated_at))  , array('placeholder' => trans("companies.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Companie->updated_at)), array('placeholder' => trans("companies.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
