@extends('backend.layouts.app')


@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <h5>الدعم الفني</h5>
                    </div>

                    <div class="pull-left">
                        <a class="btn btn-success" href="{{ route('Customer_service_msgs.create') }}"> إضافة جديد </a>
                    </div>
                </div>

                <div class="col-md-12" >

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="blog_tablesearch">
                            <div class="table-responsive">
                                <table  id="example" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="is_filter">كود</th>
                                        <th  class="is_filter">الاسم</th>
                                        <th  class="is_filter">البريد</th>
                                        <th width="100px">تحكم</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th>كود</th>
                                        <th>الاسم</th>
                                        <th>البريد</th>
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
                            var table = $('.dataTable').DataTable({
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
                                ajax: "{{ route('Customer_service_msgs.index') }}",
                                aoColumns: [
                                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                    {data: 'user_name', name: 'user_name'},
                                    {data: 'email', name: 'email'},
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
                <!--col-md-12-->

            </div>
            <!--row-->

        </div>
        <!--col_page_content-->
    </div>
    <!--wrapper_cols-->

@endsection
