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
                <a class="btn btn-primary" href="{{ route('country_cities_areas.index') }}"> رجوع</a>
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
    {!! Form::model($Country_cities_area, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['country_cities_areas.update', $Country_cities_area->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("country_cities_areas.city_id")}}:</strong>
                                {!!Form::select('city_id', $country_cities, $Country_cities_area->city_id, ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("country_cities_areas.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Country_cities_area->name_ar, array('placeholder' => trans("country_cities_areas.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("country_cities_areas.name_en")}}:</strong>
                            {!! Form::text('name_en', $Country_cities_area->name_en, array('placeholder' => trans("country_cities_areas.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("country_cities_areas.slug")}}:</strong>
                            {!! Form::text('slug', $Country_cities_area->slug, array('placeholder' => trans("country_cities_areas.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("country_cities_areas.sort")}}:</strong>
                                {!! Form::number('sort',$Country_cities_area->sort, array('placeholder' => trans("country_cities_areas.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("country_cities_areas.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($Country_cities_area->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($Country_cities_area->active!="1") selected @endif>غير مفعل</option>
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
