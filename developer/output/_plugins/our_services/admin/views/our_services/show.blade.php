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


    <div class="row">
        
            
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("our_services.id")}}:</strong>
                            {!! Form::number('id', $Our_service->id, array('placeholder' => trans("our_services.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("our_services.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Our_service->name_ar, array('placeholder' => trans("our_services.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("our_services.name_en")}}:</strong>
                            {!! Form::text('name_en', $Our_service->name_en, array('placeholder' => trans("our_services.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("our_services.description_html_ar")}}:</strong>
                            <textarea name="description_html_ar" id="description_html_ar" > {{$Our_service->description_html_ar}}</textarea>
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
                            <textarea name="description_html_en" id="description_html_en" > {{$Our_service->description_html_en}}</textarea>
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
                               </div>
                        </div></div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("our_services.sort")}}:</strong>
                                {!! Form::number('sort',$Our_service->sort, array('placeholder' => trans("our_services.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("our_services.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Our_service->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("our_services.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Our_service->created_at))  , array('placeholder' => trans("our_services.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("our_services.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Our_service->created_at)), array('placeholder' => trans("our_services.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("our_services.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Our_service->updated_at))  , array('placeholder' => trans("our_services.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("our_services.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Our_service->updated_at)), array('placeholder' => trans("our_services.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
