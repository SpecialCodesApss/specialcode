@extends('backend.layouts.app')
@section('title',trans('contents.Admin - contents'))
@section('header')


<link href="{{url('themes/admin/admindek/assets/css/jquery.dataTables.min.css')}} " rel="stylesheet">
<link href="{{url('themes/admin/admindek/assets/css/dataTables.bootstrap4.min.css')}} " rel="stylesheet">
<link href="{{url('themes/admin/admindek/assets/css/responsive.dataTables.min.css')}} " rel="stylesheet">




@endsection
@section('content')
<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="far fa-copy bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans('contents.Admin - contents')}}</h5>
                        <span>{{trans('admin.manage and control all system sides')}}
                             </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('admin/dashboard')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{trans('contents.contents')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
<div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">


    <div class="card">
                                <div class="card-header">
                                    <h5>{{trans('contents.Admin - contents')}}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
    <div class="pcoded-inner-content">
        <div class="main-body">

                <div class="page-body">


    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
                <div class="col-lg-12 align_btn_end">
                        <a class="btn btn-primary"
            href="{{ route('contents.create') }}">
  {{trans('admin.Create')}} </a> <br> <br>
                </div>

                    <div class="col-md-12">
                        <div class="blog_tablesearch">
                            <div >
                                <table  id="example" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="is_filter">{{trans("contents.id")}}</th>
                          <th class="is_filter">{{trans("contents.content_key")}}</th>
                          <th class="is_filter">{{trans("contents.cp_name")}}</th>
                          <th class="is_filter">{{trans("contents.content_ar")}}</th>
                          <th class="is_filter">{{trans("contents.content_en")}}</th>
                          <th width="100px">{{trans("admin.Control")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="is_filter">{{trans("contents.id")}}</th>
                          <th class="is_filter">{{trans("contents.content_key")}}</th>
                          <th class="is_filter">{{trans("contents.cp_name")}}</th>
                          <th class="is_filter">{{trans("contents.content_ar")}}</th>
                          <th class="is_filter">{{trans("contents.content_en")}}</th>
                          <th width="100px">{{trans("admin.Control")}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">



                        $(document).ready(function() {
                            var base_url = '{{url('/')}}';
                            window.pdfMake.fonts = {
                                AEfont: {
                                        normal: 'AEfont-Regular.ttf',
                                        bold: 'AEfont-Regular.ttf',
                                        italics: 'AEfont-Regular.ttf',
                                        bolditalics: 'AEfont-Regular.ttf'
                                    }
                                };
                            var table = $('.dataTable').DataTable({
                                "order": [[ 0, "desc" ]],
                                dom: 'Bfrtip',
                                buttons: [
                                
             {extend:'copyHtml5',text:"{{trans("admin.copyHtml5")}}",
                                        exportOptions: {
                                            columns: ':not(:last-child)',
                                        },
                                    },
            
             {extend:'excelHtml5',text:"{{trans("admin.excelHtml5")}}",
                                        exportOptions: {
                                            columns: ':not(:last-child)',
                                        },
                                    },
            
            {extend:'csvHtml5',text:"{{trans("admin.csvHtml5")}}",
                                        exportOptions: {
                                            columns: ':not(:last-child)',
                                        },
                                    },
            
             {extend:'pdfHtml5',text:"{{trans("admin.pdfHtml5")}}" ,
                                        customize: function (doc) {
                                            doc.defaultStyle =
                                                {
                                                    font: 'AEfont',
                                                    alignment: 'center',
                                                    fontSize: 16,
                                                }
                                        },

                                    } ,
            
             {extend:'print',text:"{{trans("admin.print")}}" ,
                                        exportOptions: {
                                            columns: ':not(:last-child)',
                                        },
                                    },
            
                                ],
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "language": {
                                    "sProcessing":   "{{trans("admin.sProcessing")}}",
                                    "sZeroRecords":   "{{trans("admin.sZeroRecords")}}",
                                    "sInfo":          "{{trans("admin.sInfo")}}",
                                    "sInfoEmpty":    "{{trans("admin.sInfoEmpty")}}",
                                    "sInfoFiltered":  "{{trans("admin.sInfoFiltered")}}",
                                    "sInfoPostFix":  "",
                                    "sSearch":       "{{trans("admin.sSearch")}}",
                                    "sUrl":          "",
                                    "oPaginate": {
                                        "sFirst":     "{{trans("admin.sFirst")}}",
                                        "sPrevious":  "{{trans("admin.sPrevious")}}",
                                        "sNext":      "{{trans("admin.sNext")}}",
                                        "sLast":     "{{trans("admin.sLast")}}",
                                    }
                                },
                                ajax: "{{ route('contents.index') }}",
                                aoColumns: [
                                    {data: 'id', name: 'id'},
                    {data: 'content_key', name: 'content_key'},
                    {data: 'cp_name', name: 'cp_name'},
                    {data: 'content_ar', name: 'content_ar'},
                    {data: 'content_en', name: 'content_en'},
                     {data: 'action', name: 'action', orderable: false,
                                        paging:false,
                                        searchable: false,
                                        bSearchable:false,
                                    },
                                ],
                                initComplete: function () {
                                    this.api().columns('.is_filter').every(function () {
                                        var column = this;
                                        var input = document.createElement("input");
                                        $(input).addClass("form-control")
                                        $(input).appendTo($(column.footer()).empty())
                                            .on('change', function () {
                                                column.search($(this).val(), false, false, true).draw();
                                            });
                                    });
                                }
                            });
                        });
                    </script>

            </div>
            </div>
            </div>
            <!--row-->
        </div>
        <!--col_page_content-->


    </div>
    </div>


    </div>
    </div>
    </div>
    </div>

@endsection



@section('footer')
    


            <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/dataTables.bootstrap4.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/dataTables.responsive.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/dataTables.buttons.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/buttons.print.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/jszip.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/pdfmake.min.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/vfs_fonts.js')}}"></script>
        <script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/buttons.html5.min.js')}}"></script>


@endsection

