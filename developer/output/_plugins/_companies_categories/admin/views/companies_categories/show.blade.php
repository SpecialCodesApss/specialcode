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
                <a class="btn btn-primary" href="{{ route('companies_categories.index') }}"> رجوع</a>
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
                            <strong>{{trans("companies_categories.id")}}:</strong>
                            {!! Form::number('id', $Companies_categorie->id, array('placeholder' => trans("companies_categories.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_categories.parent_category_id")}}:</strong>
                                {!!Form::select('parent_category_id', $companies_categories,  $Companies_categorie->parent_category_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.slug")}}:</strong>
                            {!! Form::text('slug', $Companies_categorie->slug, array('placeholder' => trans("companies_categories.slug"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Companies_categorie->name_ar, array('placeholder' => trans("companies_categories.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.name_en")}}:</strong>
                            {!! Form::text('name_en', $Companies_categorie->name_en, array('placeholder' => trans("companies_categories.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.description_ar")}}:</strong>
                            {!! Form::textarea('description_ar', $Companies_categorie->description_ar, array('placeholder' => trans("companies_categories.description_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.description_en")}}:</strong>
                            {!! Form::textarea('description_en', $Companies_categorie->description_en, array('placeholder' => trans("companies_categories.description_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_categories.category_image")}}:</strong>
                                <div class="col-12">
                                @if(isset($Companies_categorie->category_image))
                                    <img class="img-responsive" src="{{url($Companies_categorie->category_image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_categories.category_icon")}}:</strong>
                                <div class="col-12">
                                @if(isset($Companies_categorie->category_icon))
                                    <img class="img-responsive" src="{{url($Companies_categorie->category_icon)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies_categories.sort")}}:</strong>
                                {!! Form::number('sort',$Companies_categorie->sort, array('placeholder' => trans("companies_categories.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies_categories.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Companies_categorie->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Companies_categorie->created_at))  , array('placeholder' => trans("companies_categories.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Companies_categorie->created_at)), array('placeholder' => trans("companies_categories.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Companies_categorie->updated_at))  , array('placeholder' => trans("companies_categories.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_categories.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Companies_categorie->updated_at)), array('placeholder' => trans("companies_categories.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
