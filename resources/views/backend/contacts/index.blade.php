@extends('backend.layouts.app')
@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <h5>بيانات التواصل</h5>
                    </div>
{{--                    <div class="pull-left">--}}
{{--                        <a class="btn btn-success" href="{{ route('contacts.create') }}"> إضافة جديد </a>--}}
{{--                    </div>--}}
                </div>
                <div class="col-md-12" >
                    {{--                    @if ($message = Session::get('success'))--}}
{{--                        <script !src="">--}}
{{--                            toastr.success('{{$message}}')--}}
{{--                        </script>--}}
{{--                    @endif--}}
                    <div class="col-md-12">
                        <div class="blog_tablesearch">
                            <div class="table-responsive">
                                <table  id="example" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="is_filter">{{trans("contacts.flag")}}</th><th class="is_filter">{{trans("contacts.name_ar")}}</th><th class="is_filter">{{trans("contacts.name_en")}}</th><th class="is_filter">{{trans("contacts.icon_text")}}</th><th class="is_filter">{{trans("contacts.image")}}</th><th class="is_filter">{{trans("contacts.value_ar")}}</th><th class="is_filter">{{trans("contacts.value_en")}}</th><th class="is_filter">{{trans("contacts.active")}}</th><th class="is_filter">{{trans("contacts.sort")}}</th><th width="100px">تحكم</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="is_filter">{{trans("contacts.flag")}}</th><th class="is_filter">{{trans("contacts.name_ar")}}</th><th class="is_filter">{{trans("contacts.name_en")}}</th><th class="is_filter">{{trans("contacts.icon_text")}}</th><th class="is_filter">{{trans("contacts.image")}}</th><th class="is_filter">{{trans("contacts.value_ar")}}</th><th class="is_filter">{{trans("contacts.value_en")}}</th><th class="is_filter">{{trans("contacts.active")}}</th><th class="is_filter">{{trans("contacts.sort")}}</th><th width="100px">تحكم</th>
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
                                // dom: 'Bfrtip',
                                // buttons: [
                                //     {extend:'copyHtml5',text:'نسخ',
                                //         exportOptions: {
                                //             columns: ':not(:last-child)',
                                //         },
                                //     },
                                //     {extend:'excelHtml5',text:'تصدير Excel',
                                //         exportOptions: {
                                //             columns: ':not(:last-child)',
                                //         },
                                //     },
                                //     {extend:'csvHtml5',text:'تصدير CSV',
                                //         exportOptions: {
                                //             columns: ':not(:last-child)',
                                //         },
                                //     },
                                //     {extend:'pdfHtml5',text:'تصدير PDF' ,
                                //         customize: function (doc) {
                                //             doc.defaultStyle =
                                //                 {
                                //                     font: 'AEfont',
                                //                     alignment: 'center',
                                //                     fontSize: 16,
                                //                 }
                                //         },
                                //         exportOptions: {
                                //             columns: [2,1,0],
                                //         },
                                //
                                //     } ,
                                //     {extend:'print',text:'طباعة' ,
                                //         exportOptions: {
                                //             columns: ':not(:last-child)',
                                //         },
                                //     },
                                // ],
                                // processing: true,
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
                                ajax: "{{ route('contacts.index') }}",
                                aoColumns: [
                                    {data: 'flag', name: 'flag'},{data: 'name_ar', name: 'name_ar'},{data: 'name_en', name: 'name_en'},{data: 'icon_text', name: 'icon_text'},{data: 'image', name: 'image'},{data: 'value_ar', name: 'value_ar'},{data: 'value_en', name: 'value_en'},{data: 'active', name: 'active'},{data: 'sort', name: 'sort'}, {data: 'action', name: 'action', orderable: false,
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
