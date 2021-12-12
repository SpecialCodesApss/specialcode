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


    <div class="row">
        
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("tests.id")}}:</strong>
                            {!! Form::number('id', $Test->id, array('placeholder' => trans("tests.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div> 
 <div class="col-md-12">
 <strong>{{trans("tests.users_ids")}}:</strong>
                                    <div class="blog_tablesearch">
                                        <div class="table-responsive">
                                            <table  id="table_admin_sections" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="is_filter">{{trans("admin_sections.id")}}</th>
                          <th class="is_filter">{{trans("admin_sections.parent_section_id")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_name_ar")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_name_en")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_icon")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_flag")}}</th>
                          <th class="is_filter">{{trans("admin_sections.controller_name")}}</th>
                          <th class="is_filter">{{trans("admin_sections.is_notification_able")}}</th>
                          <th class="is_filter">{{trans("admin_sections.is_drop_menu")}}</th>
                          <th class="is_filter">{{trans("admin_sections.active")}}</th>
                          <th class="is_filter">{{trans("admin_sections.sort")}}</th>
                          <th width="100px">تحكم</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="is_filter">{{trans("admin_sections.id")}}</th>
                          <th class="is_filter">{{trans("admin_sections.parent_section_id")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_name_ar")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_name_en")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_icon")}}</th>
                          <th class="is_filter">{{trans("admin_sections.section_flag")}}</th>
                          <th class="is_filter">{{trans("admin_sections.controller_name")}}</th>
                          <th class="is_filter">{{trans("admin_sections.is_notification_able")}}</th>
                          <th class="is_filter">{{trans("admin_sections.is_drop_menu")}}</th>
                          <th class="is_filter">{{trans("admin_sections.active")}}</th>
                          <th class="is_filter">{{trans("admin_sections.sort")}}</th>
                          <th width="100px">تحكم</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

<script type="text/javascript">
                                    $(document).ready(function() {
                                        window.pdfMake.fonts = {
                                            AEfont: {
                                                normal: 'AEfont-Regular.ttf',
                                                bold: 'AEfont-Regular.ttf',
                                                italics: 'AEfont-Regular.ttf',
                                                bolditalics: 'AEfont-Regular.ttf'
                                            }
                                        };
                                        var table = $('#table_admin_sections').DataTable({
                                            dom: 'Bfrtip',
                                            buttons: [
                                                {extend:'copyHtml5',text:'نسخ',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    },
                                                },
                                                {extend:'excelHtml5',text:'تصدير Excel',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    },
                                                },
                                                {extend:'csvHtml5',text:'تصدير CSV',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    },
                                                },
                                                {extend:'pdfHtml5',text:'تصدير PDF' ,
                                                    customize: function (doc) {
                                                        doc.defaultStyle =
                                                            {
                                                                font: 'AEfont',
                                                                alignment: 'center',
                                                                fontSize: 16,
                                                            }
                                                    },
                                                    exportOptions: {
                                                        columns: [2,1,0],
                                                    },

                                                } ,
                                                {extend:'print',text:'طباعة' ,
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    },
                                                },
                                            ],
                                            processing: true,
                                            serverSide: true,
                                            responsive: true,
                                            "language": {
                                                "sProcessing":   "جارٍ التحميل...",
                                                "sLengthMenu":   "أظهر _MENU_ مدخلات",
                                                "sZeroRecords":  "لم يعثر على أية سجلات",
                                                "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                                                "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                                                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "ابحث:",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                    "sFirst":    "الأول",
                                                    "sPrevious": "السابق",
                                                    "sNext":     "التالي",
                                                    "sLast":     "الأخير"
                                                }
                                            },
                                            ajax: {
                                                url: '{{ route('getadmin_sectionsInfo_for_tests') }}',
                                                data: {
                                                    'Test_id' : '{{ $Test->id}}' ,
                                                }
                                            },
                                            aoColumns: [
                                               {data: 'id', name: 'id'},
                    {data: 'parent_section_id', name: 'parent_section_id'},
                    {data: 'section_name_ar', name: 'section_name_ar'},
                    {data: 'section_name_en', name: 'section_name_en'},
                    {data: 'section_icon', name: 'section_icon'},
                    {data: 'section_flag', name: 'section_flag'},
                    {data: 'controller_name', name: 'controller_name'},
                    {data: 'is_notification_able', name: 'is_notification_able'},
                    {data: 'is_drop_menu', name: 'is_drop_menu'},
                    {data: 'active', name: 'active'},
                    {data: 'sort', name: 'sort'},
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

                                </script> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("tests.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Test->created_at))  , array('placeholder' => trans("tests.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("tests.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Test->created_at)), array('placeholder' => trans("tests.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("tests.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Test->updated_at))  , array('placeholder' => trans("tests.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("tests.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Test->updated_at)), array('placeholder' => trans("tests.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
