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
                <a class="btn btn-primary" href="{{ route('news_categories.index') }}"> رجوع</a>
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
    {!! Form::model($News_categorie, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['news_categories.update', $News_categorie->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_categories.parent_category_id")}}:</strong>
                                {!!Form::select('parent_category_id', $news_categories, $News_categorie->parent_category_id, ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_categories.slug")}}:</strong>
                            {!! Form::text('slug', $News_categorie->slug, array('placeholder' => trans("news_categories.slug"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_categories.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $News_categorie->name_ar, array('placeholder' => trans("news_categories.name_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_categories.name_en")}}:</strong>
                            {!! Form::text('name_en', $News_categorie->name_en, array('placeholder' => trans("news_categories.name_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_categories.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar',$News_categorie->description_ar, array('placeholder' => trans("news_categories.description_ar"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_categories.description_en")}}:</strong>
                            {!! Form::textarea('description_en',$News_categorie->description_en, array('placeholder' => trans("news_categories.description_en"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_categories.category_image")}}:</strong>
                            <div class="col-12">
                            @if(isset($News_categorie->category_image))
                                <img class="img-responsive" src="{{url($News_categorie->category_image)}}" alt="">
                            @endif
                            </div>
                            {!! Form::file('category_image', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("news_categories.category_icon")}}:</strong>
                            <div class="col-12">
                            @if(isset($News_categorie->category_icon))
                                <img class="img-responsive" src="{{url($News_categorie->category_icon)}}" alt="">
                            @endif
                            </div>
                            {!! Form::file('category_icon', null, array('class' => 'form-control','disabled')) !!}
                                       </div>
                        </div></div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_categories.sort")}}:</strong>
                                {!! Form::number('sort',$News_categorie->sort, array('placeholder' => trans("news_categories.sort"),'class' => 'form-control')) !!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_categories.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if($News_categorie->active=="1") selected @endif>مفعل</option>
                                <option value="0" @if($News_categorie->active!="1") selected @endif>غير مفعل</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#active:not(.ignore)").niceSelect();
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
                                    $("input").keydown(function(event){
                                        if(event.keyCode == 13) {
                                            event.preventDefault();
                                            $("form").submit();
                                            // return false;
                                        }
                                    });
                                });
                            </script>

    
@endsection
