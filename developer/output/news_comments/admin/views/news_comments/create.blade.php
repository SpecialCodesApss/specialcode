@extends('admin.layouts.app')

@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>إضافة جديد</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('news_comments.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'news_comments.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_comments.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, "old('user_id')", ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("news_comments.comment_text")}}:</strong>
                            {!! Form::textarea('comment_text',old('comment_text'), array('placeholder' => trans("news_comments.comment_text"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_comments.users_likes_ids")}}:</strong><br>
                                <input id="users_likes_ids" name="users_likes_ids" type="text" value="">
                            <script type="text/javascript">
                                users_autoComplete = [];
                                $(function() {
                                    $('#users_likes_ids').tagsInput({
                                        'onAddTag': function(input, value) {
                                            checkusers_for_news_comments_forFieldusers_likes_ids(value,function(result){
                                                if(result == "true"){
                                                }
                                                else{
                                                    $('#users_likes_ids').removeTag(value)
                                                    $('#users_likes_ids_tag').val(value)
                                                    $('#users_likes_ids_tag').addClass("error")
                                                    $('#users_likes_ids_tag').trigger('focus');
                                                }
                                            });
                                        },
                                        'autocomplete': {
                                            source: users_autoComplete
                                        },
                                    });
                                    $("#users_likes_ids_tag").on("input", function(){
                                        if( $("#users_likes_ids_tag").val().length >= 3){
                                            searchusers_for_news_comments_forFieldusers_likes_ids($(this).val(),function(result){
                                                users_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    users_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                function checkusers_for_news_comments_forFieldusers_likes_ids(email,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checkusers_for_news_comments_forFieldusers_likes_ids")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            email:email,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }
                                
                                function searchusers_for_news_comments_forFieldusers_likes_ids(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchusers_for_news_comments_forFieldusers_likes_ids")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            search_text:search_text,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            search_res = response;
                                            successCallback(search_res);
                                        },
                                    });
                                }
                            </script>
                             </div>
                        </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("news_comments.users_dislikes_ids")}}:</strong><br>
                                <input id="users_dislikes_ids" name="users_dislikes_ids" type="text" value="">
                            <script type="text/javascript">
                                users_autoComplete = [];
                                $(function() {
                                    $('#users_dislikes_ids').tagsInput({
                                        'onAddTag': function(input, value) {
                                            checkusers_for_news_comments_forFieldusers_dislikes_ids(value,function(result){
                                                if(result == "true"){
                                                }
                                                else{
                                                    $('#users_dislikes_ids').removeTag(value)
                                                    $('#users_dislikes_ids_tag').val(value)
                                                    $('#users_dislikes_ids_tag').addClass("error")
                                                    $('#users_dislikes_ids_tag').trigger('focus');
                                                }
                                            });
                                        },
                                        'autocomplete': {
                                            source: users_autoComplete
                                        },
                                    });
                                    $("#users_dislikes_ids_tag").on("input", function(){
                                        if( $("#users_dislikes_ids_tag").val().length >= 3){
                                            searchusers_for_news_comments_forFieldusers_dislikes_ids($(this).val(),function(result){
                                                users_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    users_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                function checkusers_for_news_comments_forFieldusers_dislikes_ids(email,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checkusers_for_news_comments_forFieldusers_dislikes_ids")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            email:email,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }
                                
                                function searchusers_for_news_comments_forFieldusers_dislikes_ids(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchusers_for_news_comments_forFieldusers_dislikes_ids")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            search_text:search_text,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            search_res = response;
                                            successCallback(search_res);
                                        },
                                    });
                                }
                            </script>
                             </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("news_comments.active")}}:</label>
                            <select class="wide" id="active" name="active">
                                <option value="1" @if(old('active')=="1") selected @endif >مفعل</option>
                                <option value="0" @if(old('active')=="0") selected @endif>غير مفعل </option>
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
            <button type="button"  onclick="
                $('#save_type').val('save_and_add_new');
                $('form').submit();
                return false
            " class="btn btn-primary">حفظ وإضافة جديد</button>
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
