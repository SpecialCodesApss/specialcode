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
    {!! Form::model($Countrie, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['countries.update', $Countrie->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Countrie->name_ar, array('placeholder' => trans("countries.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.name_en")}}:</strong>
                            {!! Form::text('name_en', $Countrie->name_en, array('placeholder' => trans("countries.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.slug")}}:</strong>
                            {!! Form::text('slug', $Countrie->slug, array('placeholder' => trans("countries.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_flag")}}:</strong>
                            <div class="col-12">
                            @if(isset($Countrie->country_flag))
                                <img class="img-responsive" src="{{url($Countrie->country_flag)}}" alt="">
                            @endif
                            </div>
                            {!! Form::file('country_flag', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_alpha2_code")}}:</strong>
                            {!! Form::text('country_alpha2_code', $Countrie->country_alpha2_code, array('placeholder' => trans("countries.country_alpha2_code"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_alpha3_code")}}:</strong>
                            {!! Form::text('country_alpha3_code', $Countrie->country_alpha3_code, array('placeholder' => trans("countries.country_alpha3_code"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.languages")}}:</strong><br>
                 @foreach($languages as $info)
                    <input type="checkbox" name="languages[]" value="{{$info->id}}"
                     @if(in_array($info->id,$Countrie->languages)) checked @endif > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.currencies")}}:</strong><br>
                 @foreach($currencies as $info)
                    <input type="checkbox" name="currencies[]" value="{{$info->id}}"
                     @if(in_array($info->id,$Countrie->currencies)) checked @endif > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("countries.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($Countrie->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($Countrie->active!="1") selected @endif>غير مفعل</option>
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
                                {!! Form::number('sort',$Countrie->sort, array('placeholder' => trans("countries.sort"),'class' => 'form-control')) !!}
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
