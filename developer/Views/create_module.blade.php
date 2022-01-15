@extends('developer::layouts/app')

@section('title','Extensinos')


@section('header')
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet" href="{{url('developer/assets/css/bootstrap-iconpicker.min.css')}}"/>
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

@if($result['fields_count'] > 25)
<style>
    .limiter{
        height: 3000px !important;
    }

</style>
@elseif($result['fields_count'] > 18)
<style>
    .limiter{
        height: 3000px !important;
    }

</style>
@endif


@endsection


@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Hello Developer</h1>
            <h4>now you can develope admin panel from simple framework</h4>
            <br>
            <br>
            <label for="table_select">Select Table</label>
<!--            <select class="form-control"  name="db" id="table_select">-->
<!--                @foreach($tables as $table)-->
<!--                <option value="{{ $table->$db}}">{{ $table->$db}}</option>-->
<!--                @endforeach-->
<!--            </select>-->

            <br><br>

            <form class="form-inline" method="post" action="{{url('developer/create_extension')}}">
                {{csrf_field()}}


                <div class="form-group  col-md-12 float-right" style="direction: rtl">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>

            <div class="form-group col-md-3">
                <label for="table_name">table_name</label>
                <input type="text" class="form-control" id="table_name" name="table_name" value="{{$result['table_name']}}">
            </div>
            <div class="form-group col-md-3">
                    <label for="module_name">module_name</label>
                    <input type="text" class="form-control" id="module_name" name="module_name" value="{{$result['module_name']}}">
            </div>

            <div class="form-group  col-md-3">
                <label for="section_name_ar">section_name_ar</label>
                <input type="text" class="form-control" id="section_name_ar" name="section_name_ar" value="{{$result['section_name_ar']}}">
            </div>
            <div class="form-group  col-md-3">
                <label for="section_name_en">section_name_en</label>
                <input type="text" class="form-control" id="section_name_en" name="section_name_en" value="{{$result['section_name_en']}}">
            </div>
            <div class="form-group  col-md-3">
                <label for="section_icon">section_icon</label>
                    <!-- Button tag -->
                    <button name="section_icon" id="section_icon" class="btn btn-secondary  col-md-12" role="iconpicker"></button>

            </div>
            <div class="form-group  col-md-3">
                <label for="section_flag">section_flag</label>
                <input type="text" class="form-control" id="section_flag" name="section_flag"  value="{{$result['section_flag']}}">
            </div>
                <div class="col-md-6">

                </div>




            <div class="form-group col-md-3">
                <label for="is_notification_able">is_notification_able</label>
                <select class="form-control  col-md-12"  name="is_notification_able" id="is_notification_able">
                    <option value="1">yes</option>
                    <option value="0" selected>no</option>
                </select>
            </div>

                <div class="form-group  col-md-3">
                    <label for="sort">arabic notification</label>
                    <input type="text" class="form-control  col-md-12" id="is_notification_ar" name="is_notification_ar"  value="">
                </div>
                <div class="form-group  col-md-3">
                    <label for="sort">english notification</label>
                    <input type="text" class="form-control  col-md-12" id="is_notification_en" name="is_notification_en"  value="">
                </div>


            <div class="form-group  col-md-3">
                <label for="is_drop_menu">is_drop_menu</label>
                <select  class="form-control  col-md-12" name="is_drop_menu" id="is_drop_menu">
                    <option value="1">yes</option>
                    <option value="0" selected>no</option>
                </select>
            </div>

                <div class="form-group col-md-3">
                    <label for="table_has_multiple_images">table_has_multiple_images</label>
                    <select class="form-control  col-md-12"  name="table_has_multiple_images" id="table_has_multiple_images">
                        <option value="1">yes</option>
                        <option value="0" selected>no</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="table_has_multiple_files">table_has_multiple_files</label>
                    <select class="form-control  col-md-12"  name="table_has_multiple_files" id="table_has_multiple_files">
                        <option value="1">yes</option>
                        <option value="0" selected>no</option>
                    </select>
                </div>

                <div class="form-group  col-md-3">
                <label for="active">active</label>
                <select  class="form-control col-md-12" name="active" id="active">
                    <option value="1">yes</option>
                    <option value="0">no</option>
                </select>
            </div>
            <div class="form-group  col-md-3">
                <label for="sort">sort</label>
                <input type="text" class="form-control  col-md-12" id="sort" name="sort"  value="{{$result['sort']}}">
            </div>





                <div class="row">
                    <div class="wrapper1  col-md-12">
                        <div class="div1"></div>
                    </div>
                    <div class="wrapper2  col-md-12">
                        <div class="div2">
                            <!-- Content Here -->
                        </div>
                    </div>

                </div>





                <div class="limiter">
                    <div class="container-table100" >
                        <div class="wrap-table100">
                            <div class="table100 ver1 " >
                                <div class="table100-firstcol " >
                                    <table >
                                        <thead>
                                        <tr class="row100 head"><th class="cell100 column1" style="    height: 110px;">name</th></tr>
                                        </thead>

                                        <tbody id="table_fields_names">
                                        {!!$result['table_fields_names']!!}

                                        </tbody>

                                    </table>
                                </div>

                                <div class="wrap-table100-nextcols js-pscroll ">
                                    <div class="table100-nextcols container_scroll">
                                        <table>
                                            <thead>
                                            <tr class="row100 head">
                                                <th class="cell100 column3">trans en</th>
                                                <th class="cell100 column3">trans ar</th>
                                                <th class="cell100 column3">data type for field</th>
                                                <th class="cell100 column3">selector items</th>
                                                <th class="cell100 column3">is Unique</th>
                                                <th class="cell100 column3">is active adminTable</th>
                                                <th class="cell100 column3">module Protected</th>
                                                <th class="cell100 column3">is active admin View</th>
                                                <th class="cell100 column3">is required admin store</th>
                                                <th class="cell100 column3">is required admin update</th>
                                                <th class="cell100 column3">is active Mob API</th>
                                                <th class="cell100 column3">is required Mob API store</th>
                                                <th class="cell100 column3">is required Mob API update</th>
                                                <th class="cell100 column7">join selected table</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tables_table">
                                            {!!$result['fields']!!}

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



<!--                //scripts for scroller -->

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ele = document.getElementsByClassName('container_scroll').item(0);
                        ele.style.cursor = 'grab';

                        let pos = { top: 0, left: 0, x: 0, y: 0 };

                        const mouseDownHandler = function(e) {
                            ele.style.cursor = 'grabbing';
                            ele.style.userSelect = 'none';

                            pos = {
                                left: ele.scrollLeft,
                                top: ele.scrollTop,
                                // Get the current mouse position
                                x: e.clientX,
                                y: e.clientY,
                            };

                            document.addEventListener('mousemove', mouseMoveHandler);
                            document.addEventListener('mouseup', mouseUpHandler);
                        };

                        const mouseMoveHandler = function(e) {
                            // How far the mouse has been moved
                            const dx = e.clientX - pos.x;
                            const dy = e.clientY - pos.y;

                            // Scroll the element
                            ele.scrollTop = pos.top - dy;
                            ele.scrollLeft = pos.left - dx;
                        };

                        const mouseUpHandler = function() {
                            ele.style.cursor = 'grab';
                            ele.style.removeProperty('user-select');

                            document.removeEventListener('mousemove', mouseMoveHandler);
                            document.removeEventListener('mouseup', mouseUpHandler);
                        };

                        // Attach the handler
                        ele.addEventListener('mousedown', mouseDownHandler);
                    });
                </script>

                <script>
                    $('.js-pscroll').each(function(){
                        var ps = new PerfectScrollbar(this);

                        $(window).on('resize', function(){
                            ps.update();
                        })

                        $(this).on('ps-x-reach-start', function(){
                            $(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
                        });

                        $(this).on('ps-scroll-x', function(){
                            $(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
                        });

                    });
                </script>

<!--                //end of scroller script -->

<!--                <div class="table-responsive">-->
<!--                <br><br><br>-->
<!--                <table class="table table-bordered tableFixHead">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th class="head_cols">name</th>-->
<!--                        <th>trans_en</th>-->
<!--                        <th>trans_ar</th>-->
<!--                        <th>data_type_for_field</th>-->
<!--                        <th>selector_items</th>-->
<!--                        <th>is_Unique</th>-->
<!--                        <th>is_active_adminTable</th>-->
<!--                        <th>moduleProtected</th>-->
<!--                        <th>is_active_adminView</th>-->
<!--                        <th>is_required_admin_store</th>-->
<!--                        <th>is_required_admin_update</th>-->
<!--                        <th>is_active_MobAPI</th>-->
<!--                        <th>is_required_MobAPI_store</th>-->
<!--                        <th>is_required_MobAPI_update</th>-->
<!--                        <th>join_selected_table</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                   <tbody id="tables_table">-->

<!--                   </tbody>-->
<!--                </table>-->
<!--            </div>-->


                <div class="col-md-12">
                    <br><br><br>
                    <h3>Admin Operations</h3>
                    <table>
                        <tr>
                            <th style="font-size: 20px;text-decoration: underline">Admin Coding Active</th>
                            <td><td><input type="checkbox" name="Admin_Coding" checked></td></td>
                        </tr>
                    </table>
                    <table class="table">

                        <thead>
                            <th>List</th>
                            <th>Create</th>
                            <th>View</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </thead>

                        <tr>
                            <td><input type="checkbox" name="Admin_List" checked></td>
                            <td><input type="checkbox" name="Admin_Create" checked></td>
                            <td><input type="checkbox" name="Admin_View" checked></td>
                            <td><input type="checkbox" name="Admin_Update" checked></td>
                            <td><input type="checkbox" name="Admin_Delete" checked></td>
                        </tr>

                        <tr>
                            <th>Table Export Options</th>
                        </tr>
                        <tr>
                            <td><p>Admin_Export_Copy</p><input type="checkbox" name="Admin_Export_Copy" checked></td>
                            <td><p>Admin_Export_Excel</p><input type="checkbox" name="Admin_Export_Excel" checked></td>
                            <td><p>Admin_Export_CSV</p><input type="checkbox" name="Admin_Export_CSV" checked></td>
                            <td><p>Admin_Export_PDF</p><input type="checkbox" name="Admin_Export_PDF" checked></td>
                            <td><p>Admin_Export_Print</p><input type="checkbox" name="Admin_Export_Print" checked></td>
                        </tr>
                    </table>

                    <br><br><br>
                    <h3>Mobile API Operations</h3>


                    <table>
                        <tr>
                            <th style="font-size: 20px;text-decoration: underline">Mobile Coding Active</th>
                            <td><td><input type="checkbox" name="Mobile_Coding" ></td>
                        </tr>
                    </table>
                    <table class="table">
                        <thead>
                        <th>List</th>
                        <th>Create</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </thead>
                        <tr>
                            <td><input type="checkbox" name="Mobile_List" checked></td>
                            <td><input type="checkbox" name="Mobile_Create" checked></td>
                            <td><input type="checkbox" name="Mobile_View" checked></td>
                            <td><input type="checkbox" name="Mobile_Update" checked></td>
                            <td><input type="checkbox" name="Mobile_Delete" checked></td>
                        </tr>
                        <tr>
                            <th>Mobile_Require_User_Authentication</th>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="Mobile_require_auth_user_List" ></td>
                            <td><input type="checkbox" name="Mobile_require_auth_user_Create" checked></td>
                            <td><input type="checkbox" name="Mobile_require_auth_user_View" ></td>
                            <td><input type="checkbox" name="Mobile_require_auth_user_Update" checked></td>
                            <td><input type="checkbox" name="Mobile_require_auth_user_Delete" checked></td>
                        </tr>
                    </table>




                    <br><br><br>
                    <h3>Website Operations</h3>


                    <table>
                        <tr>
                            <th style="font-size: 20px;text-decoration: underline">Web Coding Active</th>
                            <td><td><input type="checkbox" name="Web_Coding" ></td>
                        </tr>
                    </table>
                    <table class="table">
                        <thead>
                        <th>List</th>
                        <th>Create</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </thead>
                        <tr>
                            <td><input type="checkbox" name="Web_List" checked></td>
                            <td><input type="checkbox" name="Web_Create" checked></td>
                            <td><input type="checkbox" name="Web_View" checked></td>
                            <td><input type="checkbox" name="Web_Update" checked></td>
                            <td><input type="checkbox" name="Web_Delete" checked></td>
                        </tr>
                        <tr>
                            <th>Mobile_Require_User_Authentication</th>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="Web_require_auth_user_List" ></td>
                            <td><input type="checkbox" name="Web_require_auth_user_Create" checked></td>
                            <td><input type="checkbox" name="Web_require_auth_user_View" ></td>
                            <td><input type="checkbox" name="Web_require_auth_user_Update" checked></td>
                            <td><input type="checkbox" name="Web_require_auth_user_Delete" checked></td>
                        </tr>
                    </table>



<br><br><br>
                    <h3>Flutter Mobile Operations</h3>
                    <h3>Index Page Screen</h3>
                    <table class="table">
                        <tr>
                            <th>List_View_Type</th><td>
                            <select name="viewType" id="viewType">
                                <option value="ListView"> ListView </option>
                                <option value="GridView"> GridView </option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Theme</th><td>
                                <select name="indexTheme" id="indexTheme">
                                    <option value="theme1"> Theme 1 </option>
                                    <option value="theme2"> Theme 2 </option>
                                </select>
                            </td>
                            <td>
                                <img class="img-responsive" width="200px" id="themeImage" src="Flutter/themes/indexPage/theme1/thumbnail.jpg" alt="">
                            </td>
                        </tr>
                        <tr id="themeItems">

                        </tr>
                        <tr>
                            <th>ViewAddButton</th><td>
                            <select name="ViewAddButton" id="ViewAddButton">
                                <option value="true"> true </option>
                                <option value="false"> false </option>
                            </select>
                            </td>
                            <th>ViewSearchBar</th><td>
                            <select name="ViewSearchBar" id="ViewSearchBar">
                                <option value="true"> true </option>
                                <option value="false"> false </option>
                            </select>
                            </td>
                            <th>ViewIndexPageAdv</th><td>
                            <select name="ViewIndexPageAdv" id="ViewIndexPageAdv">
                                <option value="true"> true </option>
                                <option value="false"> false </option>
                            </select>
                            </td>
                        </tr>
                    </table>

                    <br><br><br>

                    <h3>View Page Screen</h3>
                    <table class="table">
                        <tr>
                            <th>List_View_Type</th><td>
                            <select name="ViewPage_viewPageType" id="ViewPage_viewPageType">
                                <option value="ProductView"> ProductView </option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Theme</th><td>
                                <select name="viewTheme" id="viewTheme">
                                    <option value="theme1"> Theme 1 </option>
                                    <option value="theme2"> Theme 2 </option>
                                </select>
                            </td>
                            <td>
                                <img class="img-responsive" width="200px" id="viewthemeImage" src="Flutter/themes/viewPage/theme1/thumbnail.jpg" alt="">
                            </td>
                        </tr>
                        <tr id="viewthemeItems">

                        </tr>
                        <tr>
                            <th>View Image</th><td>
                            <select name="ViewPage_ViewImage" id="ViewPage_ViewImage">
                                <option value="true"> true </option>
                                <option value="false"> false </option>
                            </select>
                            </td>
                            <th>View Image Type</th><td>
                            <select name="ViewPage_ViewImageType" id="ViewPage_ViewImageType">
                                <option value="slider"> Slider Images </option>
                                <option value="static"> Static Image </option>
                            </select>
                            </td>
                            <th>View Order button</th><td>
                            <select name="ViewPage_viewOrderBtn" id="ViewPage_viewOrderBtn">
                                <option value="true"> true </option>
                                <option value="false"> false </option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>View Edit button</th><td>
                                <select name="ViewPage_ViewEditBtn" id="ViewPage_ViewEditBtn">
                                    <option value="true"> true </option>
                                    <option value="false"> false </option>
                                </select>
                            </td>
                            <th>View Delete button</th><td>
                                <select name="ViewPage_ViewDeleteBtn" id="ViewPage_ViewDeleteBtn">
                                    <option value="true"> true </option>
                                    <option value="false"> false </option>
                                </select>
                            </td>
                        </tr>
                    </table>

                </div>

                <div class="form-group  col-md-12">
                    <br><br><br>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->


@endsection

@section('footer')


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Bootstrap-Iconpicker Bundle -->
    <script type="text/javascript" src="{{url('developer/assets/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>

    <script !src="">
        $("#table_select").change(function(){
            var table_name=$("#table_select").val();
            var _token = '<?php echo csrf_token() ?>';
            //alert(table_name);

            $.ajax({
                type:'get',
                url:'../developer/get_table_fields',
                data:{table_name:table_name, _token:_token},
                success:function($result) {
                    $("#table_fields_names").html($result['table_fields_names']);
                    $("#tables_table").html($result['fields']);
                    $("#table_name").val($result['table_name']);
                    $("#module_name").val($result['module_name']);
                    $("#section_name_en").val($result['section_name_en']);
                    $("#section_flag").val($result['section_flag']);
                    $("#section_name_ar").val($result['section_name_ar']);
                    $("#sort").val($result['sort']);
                },
                error: function(data) {
                    alert('error');
                }
            });
        });

        $("#indexTheme").change(function(){
            var themeName = $("#indexTheme").val();
            $("#themeImage").attr("src",'Flutter/themes/indexPage/'+themeName+'/thumbnail.jpg');
            var Page='indexPage';
            //get theme items
            var _token = '<?php echo csrf_token() ?>';
            var tableName=$("#table_name").val();
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
            var tableName=$("#table_name").val();
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


