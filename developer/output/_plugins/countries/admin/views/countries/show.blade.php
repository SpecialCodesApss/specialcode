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


    <div class="row">
        
            
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("countries.id")}}:</strong>
                            {!! Form::number('id', $Countrie->id, array('placeholder' => trans("countries.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Countrie->name_ar, array('placeholder' => trans("countries.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.name_en")}}:</strong>
                            {!! Form::text('name_en', $Countrie->name_en, array('placeholder' => trans("countries.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.slug")}}:</strong>
                            {!! Form::text('slug', $Countrie->slug, array('placeholder' => trans("countries.slug"),'class' => 'form-control','disabled')) !!}
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
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_alpha2_code")}}:</strong>
                            {!! Form::text('country_alpha2_code', $Countrie->country_alpha2_code, array('placeholder' => trans("countries.country_alpha2_code"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("countries.country_alpha3_code")}}:</strong>
                            {!! Form::text('country_alpha3_code', $Countrie->country_alpha3_code, array('placeholder' => trans("countries.country_alpha3_code"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.languages")}}:</strong><br>
                 @foreach($languages as $info)
                    <input type="checkbox" name="languages[]" disabled="disabled" value="{{$info->id}}"
                     @if(in_array($info->id,$Countrie->languages)) checked @endif > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.currencies")}}:</strong><br>
                 @foreach($currencies as $info)
                    <input type="checkbox" name="currencies[]" disabled="disabled" value="{{$info->id}}"
                     @if(in_array($info->id,$Countrie->currencies)) checked @endif > {{$info->name_ar}}
                @endforeach
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Countrie->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("countries.sort")}}:</strong>
                                {!! Form::number('sort',$Countrie->sort, array('placeholder' => trans("countries.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("countries.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Countrie->created_at))  , array('placeholder' => trans("countries.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("countries.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Countrie->created_at)), array('placeholder' => trans("countries.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("countries.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Countrie->updated_at))  , array('placeholder' => trans("countries.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("countries.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Countrie->updated_at)), array('placeholder' => trans("countries.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
