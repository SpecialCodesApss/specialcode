@extends('developer::layouts/app')

@section('title','Extensinos')


@section('header')
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet" href="{{url('css/bootstrap-iconpicker.min.css')}}"/>
    <link rel="stylesheet" href="{{url('developer/assets/css/table_scroller.css')}}"/>
<!--    <link rel="stylesheet" href="{{url('developer/assets/css/fontawesome.css')}}"/>-->

    <style>
        .head_cols{
            position: absolute;
            width: 7em;
            margin-left: -100px;
            border-top-width: 1px;
            /*only relevant for first row*/
            margin-top: -1px;
            /*compensate for top border*/
            background: #f0ad4e;
        }

        input[type=checkbox], input[type=radio]{
            width: 25px !important;
            height: 25px !important;
        }

        .table-responsive{
            margin-left: 65px;
        }

         .container_scroll {
             cursor: grab;
             overflow: auto;
         }

    </style>
@endsection


@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Hello Developer</h1>
            <h4>now you can develope admin panel from simple framework</h4>
            <br>
            <br>

            <form method="post" action="{{url('developer/create_extension_table')}}">

                {{csrf_field()}}

            <label for="table_select">Select Table</label>
            <select class="form-control"  name="table_name" id="table_select">
                @foreach($tables as $table)
                <option value="{{ $table->$db}}">{{ $table->$db}}</option>
                @endforeach
            </select>

                <div class="form-group  col-md-12 float-right" style="direction: rtl">
                    <button type="submit" class="btn btn-next pull-right">Next</button>
                </div>


            </form>


@endsection

@section('footer')


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Bootstrap-Iconpicker Bundle -->
    <script type="text/javascript" src="{{url('js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>

    <script !src="">
        //$("#table_select").change(function(){
        //    var table_name=$("#table_select").val();
        //    var _token = '<?php //echo csrf_token() ?>//';
        //    //alert(table_name);
        //
        //    $.ajax({
        //        type:'get',
        //        url:'../developer/get_table_fields',
        //        data:{table_name:table_name, _token:_token},
        //        success:function($result) {
        //            $("#table_fields_names").html($result['table_fields_names']);
        //            $("#tables_table").html($result['fields']);
        //            $("#table_name").val($result['table_name']);
        //            $("#module_name").val($result['module_name']);
        //            $("#section_name_en").val($result['section_name_en']);
        //            $("#section_flag").val($result['section_flag']);
        //            $("#section_name_ar").val($result['section_name_ar']);
        //            $("#sort").val($result['sort']);
        //        },
        //        error: function(data) {
        //            alert('error');
        //        }
        //    });
        //});

        $("#indexTheme").change(function(){
            var themeName = $("#indexTheme").val();
            $("#themeImage").attr("src",'Flutter/themes/indexPage/'+themeName+'/thumbnail.jpg');
            var Page='indexPage';
            //get theme items
            var _token = '<?php echo csrf_token() ?>';
            var tableName=$("#table_select").val();
            $.ajax({
                type:'get',
                url:'../developer/get_theme_items',
                data:{
                    themeName:themeName,
                    tableName:tableName,
                    Page:Page,
                    _token:_token},
                success:function(result) {
                    $("#themeItems").html(result);
                    //alert(result);
                },
                error: function(data) {
                    alert('error');
                }
            });
        });


        $("#viewTheme").change(function(){
            var themeName = $("#viewTheme").val();
            $("#viewthemeImage").attr("src",'Flutter/themes/viewPage/'+themeName+'/thumbnail.jpg');
            var Page='viewPage';
            //get theme items
            var _token = '<?php echo csrf_token() ?>';
            var tableName=$("#table_select").val();
            $.ajax({
                type:'get',
                url:'../developer/get_theme_items',
                data:{
                    themeName:themeName,
                    tableName:tableName,
                    Page:Page,
                    _token:_token},
                success:function(result) {
                    $("#viewthemeItems").html(result);
                    //alert(result);
                },
                error: function(data) {
                    alert('error');
                }
            });
        });

    </script>

@endsection


