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
                <a class="btn btn-primary" href="{{ route('currencies.index') }}"> رجوع</a>
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
    {!! Form::model($Currencie, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['currencies.update', $Currencie->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("currencies.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Currencie->name_ar, array('placeholder' => trans("currencies.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("currencies.name_en")}}:</strong>
                            {!! Form::text('name_en', $Currencie->name_en, array('placeholder' => trans("currencies.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("currencies.ISO_code")}}:</strong>
                            {!! Form::text('ISO_code', $Currencie->ISO_code, array('placeholder' => trans("currencies.ISO_code"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("currencies.value")}}:</strong>
                            {!! Form::number('value', $Currencie->value, array('placeholder' => trans("currencies.value"),'class' => 'form-control','step' => "0.100")) !!}
                        </div>
                    </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("currencies.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($Currencie->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($Currencie->active!="1") selected @endif>غير مفعل</option>
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
                                <strong>{{trans("currencies.sort")}}:</strong>
                                {!! Form::number('sort',$Currencie->sort, array('placeholder' => trans("currencies.sort"),'class' => 'form-control')) !!}
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
