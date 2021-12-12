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
                <a class="btn btn-primary" href="{{ route('our_services.index') }}"> رجوع</a>
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
    {!! Form::model($Our_service, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['our_services.update', $Our_service->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("our_services.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Our_service->name_ar, array('placeholder' => trans("our_services.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("our_services.name_en")}}:</strong>
                            {!! Form::text('name_en', $Our_service->name_en, array('placeholder' => trans("our_services.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("our_services.description_html_ar")}}:</strong>
                            <textarea name="description_html_ar" id="description_html_ar" >{{$Our_service->description_html_ar}}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#description_html_ar').richText();
                        });
                    </script>
                    
                
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("our_services.description_html_en")}}:</strong>
                            <textarea name="description_html_en" id="description_html_en" >{{$Our_service->description_html_en}}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#description_html_en').richText();
                        });
                    </script>
                    
                
                 <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("our_services.image")}}:</strong>
                            <div class="col-12">
                            @if(isset($Our_service->image))
                                <img class="img-responsive" src="{{url($Our_service->image)}}" alt="">
                            @endif
                            </div>
                            {!! Form::file('image', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("our_services.sort")}}:</strong>
                                {!! Form::number('sort',$Our_service->sort, array('placeholder' => trans("our_services.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("our_services.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($Our_service->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($Our_service->active!="1") selected @endif>غير مفعل</option>
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
