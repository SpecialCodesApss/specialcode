@extends('admin.layouts.app')
@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <h5>الشركات</h5>
                    </div>
                    <div class="pull-left">
                        <a class="btn btn-success" href="{{ route('companies.create') }}"> إضافة جديد </a>
                    </div>
                </div>
                <div class="col-md-12" >

                    <div class="col-md-12">
                        <div class="blog_tablesearch">
                            <div class="table-responsive">
                                <table  id="example" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="is_filter">{{trans("companies.id")}}</th>
                          <th class="is_filter">{{trans("companies.categories")}}</th>
                          <th class="is_filter">{{trans("companies.country_id")}}</th>
                          <th class="is_filter">{{trans("companies.slug")}}</th>
                          <th class="is_filter">{{trans("companies.company_name_ar")}}</th>
                          <th class="is_filter">{{trans("companies.logo_image")}}</th>
                          <th class="is_filter">{{trans("companies.email")}}</th>
                          <th class="is_filter">{{trans("companies.phone_number")}}</th>
                          <th class="is_filter">{{trans("companies.website_link")}}</th>
                          <th class="is_filter">{{trans("companies.is_recommended")}}</th>
                          <th class="is_filter">{{trans("companies.views_count")}}</th>
                          <th class="is_filter">{{trans("companies.active")}}</th>
                          <th width="100px">تحكم</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="is_filter">{{trans("companies.id")}}</th>
                          <th class="is_filter">{{trans("companies.categories")}}</th>
                          <th class="is_filter">{{trans("companies.country_id")}}</th>
                          <th class="is_filter">{{trans("companies.slug")}}</th>
                          <th class="is_filter">{{trans("companies.company_name_ar")}}</th>
                          <th class="is_filter">{{trans("companies.logo_image")}}</th>
                          <th class="is_filter">{{trans("companies.email")}}</th>
                          <th class="is_filter">{{trans("companies.phone_number")}}</th>
                          <th class="is_filter">{{trans("companies.website_link")}}</th>
                          <th class="is_filter">{{trans("companies.is_recommended")}}</th>
                          <th class="is_filter">{{trans("companies.views_count")}}</th>
                          <th class="is_filter">{{trans("companies.active")}}</th>
                          <th width="100px">تحكم</th>
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
                                ajax: "{{ route('companies.index') }}",
                                aoColumns: [
                                    {data: 'id', name: 'id'},
                    {data: 'categories', name: 'categories'},
                    {data: 'country_id', name: 'country_id'},
                    {data: 'slug', name: 'slug'},
                    {data: 'company_name_ar', name: 'company_name_ar'},
                    {data: 'logo_image', name: 'logo_image',
                                        render: function(data,type,row){
                                            return '<img src="' + '{{url('/')}}' +'/'+ data + '",width=60px, height=60px />'},
                                        orderable: false
                                    },
                                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    
                    {data: 'website_link', name: 'website_link',
                        "render": function(data, type, row, meta) {      
                                data = '<a style="text-decoration: underline" target="_blank" href="' + data + '">' + data + ' </a>';
                            return data;
                        }
                        },
                   
                    {data: 'is_recommended', name: 'is_recommended'},
                    {data: 'views_count', name: 'views_count'},
                    {data: 'active', name: 'active'},
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
