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
                            <a class="btn btn-primary" href="{{ route('tests.index') }}"> رجوع</a>
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

                {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'tests.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-10">
                        <div class="form-group">
                            <strong>{{trans("tests.users_ids")}}:</strong>


                            <input id="form-tags-1" name="tags-1" type="text" value="">

                            <script type="text/javascript">

                                users_autoComplete = [];

                                $(function() {
                                    $('#form-tags-1').tagsInput({

                                        'onAddTag': function(input, value) {
                                            getusername(value,function(result){
                                                if(result == "true"){
                                                    // alert("res is true")
                                                }
                                                else{
                                                    // alert("res is false")
                                                    $('#form-tags-1').removeTag(value)
                                                    $('#form-tags-1_tag').val(value)
                                                    $('#form-tags-1_tag').addClass("error")
                                                    // $('#form-tags-1').focus()
                                                    $('#form-tags-1_tag').trigger('focus');
                                                }
                                            });
                                        },

                                        'autocomplete': {
                                            source: users_autoComplete
                                        },

                                        // 'onChange': function(input, value) {
                                        //     alert("A")
                                        //
                                        //     // searchusername(value,function(result){
                                        //     //     alert(result)
                                        //     // });
                                        //
                                        // }

                                    // 'onRemoveTag': function(input, value) {
                                        //     console.log('tag removed', input, value);
                                        // },

                                    });


                                    $("#form-tags-1_tag").on("input", function(){
                                        if( $("#form-tags-1_tag").val().length >= 3){
                                            searchusername($(this).val(),function(result){
                                                users_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    users_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });


                                });


                                function getusername(email,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/checkusername")}}",
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


                                function searchusername(search_text,successCallback){
                                    var _token = '<?php echo csrf_token() ?>';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/searchusername")}}",
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
                            {{--                            {!! Form::text('users_ids', "", array('placeholder' => trans("tests.users_ids"),'class' => 'form-control')) !!}--}}
                        </div>
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


@endsection
