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
                <a class="btn btn-primary" href="{{ route('news_users_notifications_settings.index') }}"> رجوع</a>
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
                            <strong>{{trans("news_users_notifications_settings.id")}}:</strong>
                            {!! Form::number('id', $News_users_notifications_setting->id, array('placeholder' => trans("news_users_notifications_settings.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_users_notifications_settings.user_id")}}:</strong>
                                {!!Form::select('user_id', $users,  $News_users_notifications_setting->user_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_users_notifications_settings.active_notification")}}:</strong>
                                {!!Form::select('active_notification', ['غير مفعل','مفعل'], $News_users_notifications_setting->active_notification, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_users_notifications_settings.notification_type")}}:</label>
                            <select class="wide disabled" id="notification_type" name="notification_type">
                                
                        <option value="every day" @if($News_users_notifications_setting->notification_type=="every day" || old('notification_type')=="every day") selected @endif>كل يوم</option>
                        
                        <option value="every week" @if($News_users_notifications_setting->notification_type=="every week" || old('notification_type')=="every week") selected @endif>كل اسبوع</option>
                        
                        <option value="every month" @if($News_users_notifications_setting->notification_type=="every month" || old('notification_type')=="every month") selected @endif>كل شهر</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#notification_type:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_users_notifications_settings.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($News_users_notifications_setting->created_at))  , array('placeholder' => trans("news_users_notifications_settings.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_users_notifications_settings.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($News_users_notifications_setting->created_at)), array('placeholder' => trans("news_users_notifications_settings.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_users_notifications_settings.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($News_users_notifications_setting->updated_at))  , array('placeholder' => trans("news_users_notifications_settings.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("news_users_notifications_settings.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($News_users_notifications_setting->updated_at)), array('placeholder' => trans("news_users_notifications_settings.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
