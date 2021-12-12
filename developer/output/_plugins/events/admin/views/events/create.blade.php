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
                <a class="btn btn-primary" href="{{ route('events.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'events.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.name_ar")}}:</strong>
                            {!! Form::text('name_ar', "", array('placeholder' => trans("events.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.name_en")}}:</strong>
                            {!! Form::text('name_en', "", array('placeholder' => trans("events.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("events.description_html_ar")}}:</strong>
                            <textarea name="description_html_ar" id="description_html_ar" >{{ old('description_html_ar') }}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#description_html_ar').richText();
                        });
                    </script>
                    
                
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("events.description_html_en")}}:</strong>
                            <textarea name="description_html_en" id="description_html_en" >{{ old('description_html_en') }}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#description_html_en').richText();
                        });
                    </script>
                    
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.city")}}:</strong>
                            {!! Form::text('city', "", array('placeholder' => trans("events.city"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                            <strong>{{trans("events.image")}}:</strong>
                            {!! Form::file('image', null, array('placeholder' => trans("events.image"),'class' => 'form-control')) !!}
                           </div>
                        </div></div>
                
                 <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("events.date")}}:</strong>
                            {!! Form::date('date',"", array('placeholder' => trans("events.date"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.website")}}:</strong>
                            {!! Form::text('website', old('website'), array('placeholder' => trans("events.website"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("events.sort")}}:</strong>
                                {!! Form::number('sort',$sort_number, array('placeholder' => trans("events.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("events.active")}}:</label>
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
                            </script>
                            
    
@endsection
