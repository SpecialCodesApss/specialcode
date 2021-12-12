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
                <a class="btn btn-primary" href="{{ route('languages.index') }}"> رجوع</a>
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
    {!! Form::model($Language, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['languages.update', $Language->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Language->name_ar, array('placeholder' => trans("languages.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.name_en")}}:</strong>
                            {!! Form::text('name_en', $Language->name_en, array('placeholder' => trans("languages.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.ISO_code")}}:</strong>
                            {!! Form::text('ISO_code', $Language->ISO_code, array('placeholder' => trans("languages.ISO_code"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.language_icon")}}:</strong>
                            <div class="col-12">
                            @if(isset($Language->language_icon))
                                <img class="img-responsive" src="{{url($Language->language_icon)}}" alt="">
                            @endif
                            </div>
                            {!! Form::file('language_icon', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("languages.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($Language->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($Language->active!="1") selected @endif>غير مفعل</option>
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
                                <strong>{{trans("languages.sort")}}:</strong>
                                {!! Form::number('sort',$Language->sort, array('placeholder' => trans("languages.sort"),'class' => 'form-control')) !!}
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
