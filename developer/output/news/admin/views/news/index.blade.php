@extends('admin.layouts.app')
@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <h5>الأخبار</h5>
                    </div>
                    <div class="pull-left">
                        <a class="btn btn-success" href="{{ route('news.create') }}"> إضافة جديد </a>
                    </div>
                </div>
                <div class="col-md-12" >

                    <div class="col-md-12">
                        <div class="blog_tablesearch">
                            <div class="table-responsive">
                                <table  id="example" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="is_filter">{{trans("news.id")}}</th>
                          <th class="is_filter">{{trans("news.category_id")}}</th>
                          <th class="is_filter">{{trans("news.publisher_newspaper_id")}}</th>
                          <th class="is_filter">{{trans("news.auther_id")}}</th>
                          <th class="is_filter">{{trans("news.country_id")}}</th>
                          <th class="is_filter">{{trans("news.city_id")}}</th>
                          <th class="is_filter">{{trans("news.title_ar")}}</th>
                          <th class="is_filter">{{trans("news.image")}}</th>
                          <th class="is_filter">{{trans("news.published")}}</th>
                          <th class="is_filter">{{trans("news.publish_date")}}</th>
                          <th class="is_filter">{{trans("news.archive_date")}}</th>
                          <th class="is_filter">{{trans("news.news_types_tags")}}</th>
                          <th class="is_filter">{{trans("news.permalink_tag")}}</th>
                          <th class="is_filter">{{trans("news.news_languages")}}</th>
                          <th class="is_filter">{{trans("news.views_count")}}</th>
                          <th class="is_filter">{{trans("news.comments_count")}}</th>
                          <th width="100px">تحكم</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="is_filter">{{trans("news.id")}}</th>
                          <th class="is_filter">{{trans("news.category_id")}}</th>
                          <th class="is_filter">{{trans("news.publisher_newspaper_id")}}</th>
                          <th class="is_filter">{{trans("news.auther_id")}}</th>
                          <th class="is_filter">{{trans("news.country_id")}}</th>
                          <th class="is_filter">{{trans("news.city_id")}}</th>
                          <th class="is_filter">{{trans("news.title_ar")}}</th>
                          <th class="is_filter">{{trans("news.image")}}</th>
                          <th class="is_filter">{{trans("news.published")}}</th>
                          <th class="is_filter">{{trans("news.publish_date")}}</th>
                          <th class="is_filter">{{trans("news.archive_date")}}</th>
                          <th class="is_filter">{{trans("news.news_types_tags")}}</th>
                          <th class="is_filter">{{trans("news.permalink_tag")}}</th>
                          <th class="is_filter">{{trans("news.news_languages")}}</th>
                          <th class="is_filter">{{trans("news.views_count")}}</th>
                          <th class="is_filter">{{trans("news.comments_count")}}</th>
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
                                ajax: "{{ route('news.index') }}",
                                aoColumns: [
                                    {data: 'id', name: 'id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'publisher_newspaper_id', name: 'publisher_newspaper_id'},
                    {data: 'auther_id', name: 'auther_id'},
                    {data: 'country_id', name: 'country_id'},
                    {data: 'city_id', name: 'city_id'},
                    {data: 'title_ar', name: 'title_ar'},
                    {data: 'image', name: 'image',
                                        render: function(data,type,row){
                                            return '<img src="' + '{{url('/')}}' +'/'+ data + '",width=60px, height=60px />'},
                                        orderable: false
                                    },
                                    {data: 'published', name: 'published'},
                    {data: 'publish_date', name: 'publish_date'},
                    {data: 'archive_date', name: 'archive_date'},
                    {data: 'news_types_tags', name: 'news_types_tags'},
                    
                    {data: 'permalink_tag', name: 'permalink_tag',
                        "render": function(data, type, row, meta) {      
                                data = '<a style="text-decoration: underline" target="_blank" href="' + data + '">' + data + ' </a>';
                            return data;
                        }
                        },
                   
                    {data: 'news_languages', name: 'news_languages'},
                    {data: 'views_count', name: 'views_count'},
                    {data: 'comments_count', name: 'comments_count'},
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
