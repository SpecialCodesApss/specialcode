@extends('admin.layouts.app')

@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>إضافة جديد</h2>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'companies.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies.categories")}}:</strong><br>
                 @foreach($companies_categories as $info)
                    <input type="checkbox" name="categories[]" value="{{$info->id}}" > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
                
                <div class="col-md-12 nopadding">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.country_id")}}:</strong>
                            {!!Form::select('country_id', $countries, "old('country_id')", ['class' => 'form-control  chosen-select'])!!}
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.city_id")}}:</strong>
                            <div id="city_block" >
                                {!!Form::select('city_id', $country_cities, "old('city_id')", ['class' => 'form-control wide'])!!}
                            </div>
                        </div>
                    </div>

                </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.slug")}}:</strong>
                            {!! Form::text('slug', "", array('placeholder' => trans("companies.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.company_name_ar")}}:</strong>
                            {!! Form::text('company_name_ar', "", array('placeholder' => trans("companies.company_name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.company_name_en")}}:</strong>
                            {!! Form::text('company_name_en', "", array('placeholder' => trans("companies.company_name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar',old('description_ar'), array('placeholder' => trans("companies.description_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.description_en")}}:</strong>
                            {!! Form::textarea('description_en',old('description_en'), array('placeholder' => trans("companies.description_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                            <strong>{{trans("companies.logo_image")}}:</strong>
                            {!! Form::file('logo_image', null, array('placeholder' => trans("companies.logo_image"),'class' => 'form-control')) !!}
                           </div>
                        </div></div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.email")}}:</strong>
                            {!! Form::text('email', "", array('placeholder' => trans("companies.email"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.phone_number")}}:</strong>
                            {!! Form::text('phone_number', "", array('placeholder' => trans("companies.phone_number"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.whatsapp_number")}}:</strong>
                            {!! Form::text('whatsapp_number', "", array('placeholder' => trans("companies.whatsapp_number"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.website_link")}}:</strong>
                            {!! Form::text('website_link', old('website_link'), array('placeholder' => trans("companies.website_link"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.address")}}:</strong>
                            {!! Form::textarea('address',old('address'), array('placeholder' => trans("companies.address"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.lat")}}:</strong>
                            {!! Form::text('lat', "", array('placeholder' => trans("companies.lat"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.lng")}}:</strong>
                            {!! Form::text('lng', "", array('placeholder' => trans("companies.lng"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.facebook")}}:</strong>
                            {!! Form::text('facebook', old('facebook'), array('placeholder' => trans("companies.facebook"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.twitter")}}:</strong>
                            {!! Form::text('twitter', old('twitter'), array('placeholder' => trans("companies.twitter"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.linkedin")}}:</strong>
                            {!! Form::text('linkedin', old('linkedin'), array('placeholder' => trans("companies.linkedin"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.youtube")}}:</strong>
                            {!! Form::text('youtube', old('youtube'), array('placeholder' => trans("companies.youtube"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies.SEO_company_page_title")}}:</strong>
                            {!! Form::text('SEO_company_page_title', "", array('placeholder' => trans("companies.SEO_company_page_title"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies.SEO_company_page_metatags")}}:</strong>
                            {!! Form::textarea('SEO_company_page_metatags',old('SEO_company_page_metatags'), array('placeholder' => trans("companies.SEO_company_page_metatags"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies.is_recommended")}}:</strong>
                            <input type="checkbox" name="is_recommended" class="form-control"
                            @if( old('is_recommended') =="on") checked @endif>
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies.sort")}}:</strong>
                                {!! Form::number('sort',$sort_number, array('placeholder' => trans("companies.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("companies.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if(old('active')=="1") selected @endif >مفعل</option>
                                <option value="0" @if(old('active')=="0") selected @endif>غير مفعل </option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('.wide:not(.ignore)').niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
   
   
      

        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">حفظ</button>
            <button type="button"  onclick="
                $('#save_type').val('save_and_add_new');
                $('form').submit();
                return false
            " class="btn btn-primary">حفظ وإضافة جديد</button>
        </div>
    </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>
    
 <script>
                                $(document).ready(function() {
                                    $('input').keydown(function(event){
                                            if(event.keyCode == 13) {
                                                event.preventDefault();
                                                $("form").submit();
                                                // return false;
                                            }
                                        });
                                });



                                $('select[name="country_id"]').change(function(){
                                    val = $('select[name="country_id"]').val();
                                    get_CountryCites_for_companies_store(val)
                                });

                                function get_CountryCites_for_companies_store(id){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";
                                    $.ajax({
                                        url: "{{url("admin/get_CountryCites_for_companies_store_Admin")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                        country_id:id,
                                        _token:_token
                                    },
                                    success: function(response) {
                                        res = response;
                                            $("#city_block").html(response);
                                            $('#city_block .wide:not(.ignore)').niceSelect();
                                    },
                                });
                                }



                            </script>
                            
    
@endsection
