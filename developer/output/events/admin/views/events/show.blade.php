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
                <a class="btn btn-primary" href="{{ route('events.index') }}"> رجوع</a>
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
                            <strong>{{trans("events.id")}}:</strong>
                            {!! Form::number('id', $Event->id, array('placeholder' => trans("events.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.name_ar")}}:</strong>
                            {!! Form::text('name_ar', $Event->name_ar, array('placeholder' => trans("events.name_ar"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.name_en")}}:</strong>
                            {!! Form::text('name_en', $Event->name_en, array('placeholder' => trans("events.name_en"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("events.description_html_ar")}}:</strong>
                            <textarea name="description_html_ar" id="description_html_ar" > {{$Event->description_html_ar}}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#description_html_ar').richText();
                        });
                    </script>
                    
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("events.description_html_en")}}:</strong>
                            <textarea name="description_html_en" id="description_html_en" > {{$Event->description_html_en}}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#description_html_en').richText();
                        });
                    </script>
                    
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("events.city")}}:</strong>
                            {!! Form::text('city', $Event->city, array('placeholder' => trans("events.city"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("events.image")}}:</strong>
                                <div class="col-12">
                                @if(isset($Event->image))
                                    <img class="img-responsive" src="{{url($Event->image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("events.date")}}:</strong>
                            {!! Form::date('date', $Event->date, array('placeholder' => trans("events.date"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("events.website")}}:</strong>
                                <div class="col-12">
                                <a href="{{$Event->website}}"><u>{{$Event->website}}</u></a>
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("events.sort")}}:</strong>
                                {!! Form::number('sort',$Event->sort, array('placeholder' => trans("events.sort"),'class' => 'form-control','disabled')) !!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("events.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Event->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("events.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Event->created_at))  , array('placeholder' => trans("events.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("events.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Event->created_at)), array('placeholder' => trans("events.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("events.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Event->updated_at))  , array('placeholder' => trans("events.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("events.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Event->updated_at)), array('placeholder' => trans("events.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
