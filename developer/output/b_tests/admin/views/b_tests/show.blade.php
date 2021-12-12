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


    <div class="row">
        
            
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.id")}}:</strong>
                            {!! Form::number('id', $B_test->id, array('placeholder' => trans("b_tests.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             
 <div class="col-md-12">
 <strong>{{trans("b_tests.table_ids")}}:</strong>
                                    <div class="blog_tablesearch">
                                        <div class="table-responsive">
                                            <table  id="table_languages" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="is_filter">{{trans("languages.id")}}</th>
                          <th class="is_filter">{{trans("languages.name_ar")}}</th>
                          <th class="is_filter">{{trans("languages.name_en")}}</th>
                          <th class="is_filter">{{trans("languages.active")}}</th>
                          <th class="is_filter">{{trans("languages.sort")}}</th>
                          <th width="100px">تحكم</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="is_filter">{{trans("languages.id")}}</th>
                          <th class="is_filter">{{trans("languages.name_ar")}}</th>
                          <th class="is_filter">{{trans("languages.name_en")}}</th>
                          <th class="is_filter">{{trans("languages.active")}}</th>
                          <th class="is_filter">{{trans("languages.sort")}}</th>
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
                                        var table = $('#table_languages').DataTable({
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
                                                url: '{{ route('getlanguagesInfo_for_b_tests') }}',
                                                data: {
                                                    'B_test_id' : '{{ $B_test->id}}' ,
                                                }
                                            },
                                            aoColumns: [
                                               {data: 'id', name: 'id'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
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

                                </script>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.pages_id")}}:</strong>
                            {!! Form::number('pages_id', $B_test->pages_id, array('placeholder' => trans("b_tests.pages_id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             
 <div class="col-md-12">
 <strong>{{trans("b_tests.table_ids")}}:</strong>
                                    <div class="blog_tablesearch">
                                        <div class="table-responsive">
                                            <table  id="table_languages" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="is_filter">{{trans("languages.id")}}</th>
                          <th class="is_filter">{{trans("languages.name_ar")}}</th>
                          <th class="is_filter">{{trans("languages.name_en")}}</th>
                          <th class="is_filter">{{trans("languages.active")}}</th>
                          <th class="is_filter">{{trans("languages.sort")}}</th>
                          <th width="100px">تحكم</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="is_filter">{{trans("languages.id")}}</th>
                          <th class="is_filter">{{trans("languages.name_ar")}}</th>
                          <th class="is_filter">{{trans("languages.name_en")}}</th>
                          <th class="is_filter">{{trans("languages.active")}}</th>
                          <th class="is_filter">{{trans("languages.sort")}}</th>
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
                                        var table = $('#table_languages').DataTable({
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
                                                url: '{{ route('getlanguagesInfo_for_b_tests') }}',
                                                data: {
                                                    'B_test_id' : '{{ $B_test->id}}' ,
                                                }
                                            },
                                            aoColumns: [
                                               {data: 'id', name: 'id'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
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

                                </script>
            
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("b_tests.page_html")}}:</strong>
                            <textarea name="page_html" id="page_html" > {{$B_test->page_html}}</textarea>
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
                            {!! Form::text('test_2', $B_test->test_2, array('placeholder' => trans("b_tests.test_2"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("b_tests.email")}}:</strong>
                            {!! Form::textarea('email', $B_test->email, array('placeholder' => trans("b_tests.email"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("b_tests.image")}}:</strong>
                                <div class="col-12">
                                @if(isset($B_test->image))
                                    <img class="img-responsive" src="{{url($B_test->image)}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("b_tests.type")}}:</strong>
                            {!! Form::text('type', $B_test->type, array('placeholder' => trans("b_tests.type"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($B_test->created_at))  , array('placeholder' => trans("b_tests.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($B_test->created_at)), array('placeholder' => trans("b_tests.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($B_test->updated_at))  , array('placeholder' => trans("b_tests.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("b_tests.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($B_test->updated_at)), array('placeholder' => trans("b_tests.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
