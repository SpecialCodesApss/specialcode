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
                <a class="btn btn-primary" href="{{ route('companies_reviews.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'companies_reviews.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_reviews.company_id")}}:</strong>
                                {!!Form::select('company_id', $companies, "old('company_id')", ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_reviews.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, "old('user_id')", ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("companies_reviews.rate_stars_count")}}:</label>
                            <select class="wide" id="rate_stars_count" name="rate_stars_count">
                                
                        <option value="1" @if(old('rate_stars_count')=="1") selected @endif>1</option>
                        
                        <option value="2" @if(old('rate_stars_count')=="2") selected @endif>2</option>
                        
                        <option value="3" @if(old('rate_stars_count')=="3") selected @endif>3</option>
                        
                        <option value="4" @if(old('rate_stars_count')=="4") selected @endif>4</option>
                        
                        <option value="5" @if(old('rate_stars_count')=="5") selected @endif>5</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#rate_stars_count:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies_reviews.comment")}}:</strong>
                            {!! Form::textarea('comment',old('comment'), array('placeholder' => trans("companies_reviews.comment"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("companies_reviews.users_likes_ids")}}:</strong><br>
                                <input id="users_likes_ids" name="users_likes_ids" type="text" value="">
                            <script type="text/javascript">
                                users_autoComplete = [];
                                $(function() {
                                    $('#users_likes_ids').tagsInput({
                                        'onAddTag': function(input, value) {
                                            checkusers_for_companies_reviews_forFieldusers_likes_ids(value,function(result){
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
                                            searchusers_for_companies_reviews_forFieldusers_likes_ids($(this).val(),function(result){
                                                users_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    users_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                function checkusers_for_companies_reviews_forFieldusers_likes_ids(email,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checkusers_for_companies_reviews_forFieldusers_likes_ids")}}",
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
                                
                                function searchusers_for_companies_reviews_forFieldusers_likes_ids(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchusers_for_companies_reviews_forFieldusers_likes_ids")}}",
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
                                <strong>{{trans("companies_reviews.users_dislikes_ids")}}:</strong><br>
                                <input id="users_dislikes_ids" name="users_dislikes_ids" type="text" value="">
                            <script type="text/javascript">
                                users_autoComplete = [];
                                $(function() {
                                    $('#users_dislikes_ids').tagsInput({
                                        'onAddTag': function(input, value) {
                                            checkusers_for_companies_reviews_forFieldusers_dislikes_ids(value,function(result){
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
                                            searchusers_for_companies_reviews_forFieldusers_dislikes_ids($(this).val(),function(result){
                                                users_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    users_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                function checkusers_for_companies_reviews_forFieldusers_dislikes_ids(email,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checkusers_for_companies_reviews_forFieldusers_dislikes_ids")}}",
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
                                
                                function searchusers_for_companies_reviews_forFieldusers_dislikes_ids(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchusers_for_companies_reviews_forFieldusers_dislikes_ids")}}",
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
                            <label>{{trans("companies_reviews.active")}}:</label>
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
