@extends('developer::layouts/app')

@section('title','Extensinos')


@section('header')

@endsection


@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <h3> Extensinos  </h3>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">Installed Extensions</h4>
                                    <p class="card-category"> this table for installed extensions</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                description
                                            </th>
                                            <th>
                                                Additionals Ext.
                                            </th>
                                            <th>
                                                additional_tables.
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($extensions as $extension)
                                            <tr>
                                                <td>
                                                    {{$extension->id}}
                                                </td>
                                                <td>
                                                    {{$extension->extension_flag_name}}
                                                </td>
                                                <td>
                                                    {{$extension->extension_description}}
                                                </td>
                                                <td>
                                                    {{$extension->additional_extensions}}
                                                </td>
                                                <td>
                                                    {{$extension->additional_tables}}
                                                </td>
                                                <td>
                                                    <form action="{{url('developer/export_extension')}}">
                                                        <input type="text" hidden name="extension_id" value="{{$extension->id}}">
                                                        <button type="submit" class="btn btn-warning">
                                                            Export
                                                        </button>
                                                    </form>
                                                    <form id="form_{{$extension->id}}" action="{{url('developer/delete_extension')}}">
                                                        <input type="text" hidden name="extension_id" value="{{$extension->id}}">
                                                        <button type="button" onclick="return deleteConfirm({{$extension->id}})" class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                                @endforeach

                                            <script !src="">
                                               function deleteConfirm(form_id){
                                                   var result = confirm("are you sure you want to delete this extension ? " +
                                                       "be careful if deleted cant restore again");
                                                   if (result) {
                                                       $("#form_"+form_id).submit();
                                                   }
                                                }
                                            </script>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div><!--col_page_content-->
    </div><!--wrapper_cols-->

@endsection

@section('footer')

@endsection
