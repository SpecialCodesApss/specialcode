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


    <div class="row">
        
            
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("languages.id")}}:</strong>
                            {!! Form::number('id', $Language->id, array('placeholder' => trans("languages.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Language->name_ar, array('placeholder' => trans("languages.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.name_en")}}:</strong>
                            {!! Form::text('name_en', $Language->name_en, array('placeholder' => trans("languages.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("languages.ISO_code")}}:</strong>
                            {!! Form::text('ISO_code', $Language->ISO_code, array('placeholder' => trans("languages.ISO_code"),'class' => 'form-control','disabled')) !!}
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
                               </div>
                        </div></div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("languages.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Language->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("languages.sort")}}:</strong>
                                {!! Form::number('sort',$Language->sort, array('placeholder' => trans("languages.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("languages.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Language->created_at))  , array('placeholder' => trans("languages.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("languages.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Language->created_at)), array('placeholder' => trans("languages.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("languages.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Language->updated_at))  , array('placeholder' => trans("languages.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("languages.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Language->updated_at)), array('placeholder' => trans("languages.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
