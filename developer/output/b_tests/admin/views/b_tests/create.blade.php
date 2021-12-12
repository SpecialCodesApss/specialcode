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
                <a class="btn btn-primary" href="{{ route('b_tests.index') }}"> رجوع</a>
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

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'b_tests.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("b_tests.users_ids")}}:</strong><br>
                                <input id="users_ids" name="users_ids" type="text" value="">
                            <script type="text/javascript">
                                banners_autoComplete = [];
                                $(function() {
                                    $('#users_ids').tagsInput({
                                        'onAddTag': function(input, value) {
                                            checkbanners_for_b_tests(value,function(result){
                                                if(result == "true"){
                                                }
                                                else{
                                                    $('#users_ids').removeTag(value)
                                                    $('#users_ids_tag').val(value)
                                                    $('#users_ids_tag').addClass("error")
                                                    $('#users_ids_tag').trigger('focus');
                                                }
                                            });
                                        },
                                        'autocomplete': {
                                            source: banners_autoComplete
                                        },
                                    });
                                    $("#users_ids_tag").on("input", function(){
                                        if( $("#users_ids_tag").val().length >= 3){
                                            searchbanners_for_b_tests($(this).val(),function(result){
                                                banners_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    banners_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                function checkbanners_for_b_tests(id,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checkbanners_for_b_tests")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            id:id,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }
                                
                                function searchbanners_for_b_tests(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchbanners_for_b_tests")}}",
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
                
                 <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.pages_id")}}:</strong>
                            {!! Form::number('pages_id',"", array('placeholder' => trans("b_tests.pages_id"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("b_tests.table_ids")}}:</strong><br>
                                <input id="table_ids" name="table_ids" type="text" value="">
                            <script type="text/javascript">
                                languages_autoComplete = [];
                                $(function() {
                                    $('#table_ids').tagsInput({
                                        'onAddTag': function(input, value) {
                                            checklanguages_for_b_tests(value,function(result){
                                                if(result == "true"){
                                                }
                                                else{
                                                    $('#table_ids').removeTag(value)
                                                    $('#table_ids_tag').val(value)
                                                    $('#table_ids_tag').addClass("error")
                                                    $('#table_ids_tag').trigger('focus');
                                                }
                                            });
                                        },
                                        'autocomplete': {
                                            source: languages_autoComplete
                                        },
                                    });
                                    $("#table_ids_tag").on("input", function(){
                                        if( $("#table_ids_tag").val().length >= 3){
                                            searchlanguages_for_b_tests($(this).val(),function(result){
                                                languages_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    languages_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                function checklanguages_for_b_tests(id,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checklanguages_for_b_tests")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            id:id,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }
                                
                                function searchlanguages_for_b_tests(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchlanguages_for_b_tests")}}",
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
                            <strong>{{trans("b_tests.page_html")}}:</strong>
                            <textarea name="page_html" id="page_html" >{{ old('page_html') }}</textarea>
                        </div>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#page_html').richText();
                        });
                    </script>
                    
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("b_tests.test_2")}}:</strong>
                            {!! Form::text('test_2', "", array('placeholder' => trans("b_tests.test_2"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("b_tests.email")}}:</strong>
                            {!! Form::textarea('email',old('email'), array('placeholder' => trans("b_tests.email"),'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                            <strong>{{trans("b_tests.image")}}:</strong>
                            {!! Form::file('image', null, array('placeholder' => trans("b_tests.image"),'class' => 'form-control')) !!}
                           </div>
                        </div></div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("b_tests.type")}}:</strong>
                            {!! Form::text('type', "", array('placeholder' => trans("b_tests.type"),'class' => 'form-control')) !!}
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
