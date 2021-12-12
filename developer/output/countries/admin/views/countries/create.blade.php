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
                <a class="btn btn-primary" href="{{ route('countries.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'countries.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.name_ar")}}:</strong>
                            {!! Form::text('name_ar', "", array('placeholder' => trans("countries.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.name_en")}}:</strong>
                            {!! Form::text('name_en', "", array('placeholder' => trans("countries.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.slug")}}:</strong>
                            {!! Form::text('slug', "", array('placeholder' => trans("countries.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                            <strong>{{trans("countries.country_flag")}}:</strong>
                            {!! Form::file('country_flag', null, array('placeholder' => trans("countries.country_flag"),'class' => 'form-control')) !!}
                           </div>
                        </div></div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_alpha2_code")}}:</strong>
                            {!! Form::text('country_alpha2_code', "", array('placeholder' => trans("countries.country_alpha2_code"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_alpha3_code")}}:</strong>
                            {!! Form::text('country_alpha3_code', "", array('placeholder' => trans("countries.country_alpha3_code"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.languages")}}:</strong><br>
                 @foreach($languages as $info)
                    <input type="checkbox" name="languages[]" value="{{$info->id}}" > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.currencies")}}:</strong><br>
                 @foreach($currencies as $info)
                    <input type="checkbox" name="currencies[]" value="{{$info->id}}" > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("countries.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1">مفعل</option>
                                <option value="0">غير مفعل </option>
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
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.sort")}}:</strong>
                                {!! Form::number('sort',$sort_number, array('placeholder' => trans("countries.sort"),'class' => 'form-control')) !!}
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
                            </script>
                            
    
@endsection
