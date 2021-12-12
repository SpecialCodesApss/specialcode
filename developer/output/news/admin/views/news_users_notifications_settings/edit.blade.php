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
    {!! Form::model($News_users_notifications_setting, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['news_users_notifications_settings.update', $News_users_notifications_setting->id]]) !!}
    <div class="row">
    
    
        
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_users_notifications_settings.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, $News_users_notifications_setting->user_id, ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_users_notifications_settings.active_notification")}}:</label>
                            <select class="wide" id="active_notification" name="active_notification">
                                <option value="1" @if($News_users_notifications_setting->active_notification=="1") selected @endif>مفعل</option>
                                <option value="0" @if($News_users_notifications_setting->active_notification!="1") selected @endif>غير مفعل</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#active_notification:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_users_notifications_settings.notification_type")}}:</label>
                            <select class="wide" id="notification_type" name="notification_type">
                                
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
