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
                <a class="btn btn-primary" href="{{ route('companies_reviews.index') }}"> رجوع</a>
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
                            <strong>{{trans("companies_reviews.id")}}:</strong>
                            {!! Form::number('id', $Companies_review->id, array('placeholder' => trans("companies_reviews.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_reviews.company_id")}}:</strong>
                                {!!Form::select('company_id', $companies,  $Companies_review->company_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("companies_reviews.user_id")}}:</strong>
                                {!!Form::select('user_id', $users,  $Companies_review->user_id, ['class' => 'form-control  chosen-select','disabled'])!!}
                            </div>
                        </div>
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <label>{{trans("companies_reviews.rate_stars_count")}}:</label>
                            <select class="wide disabled" id="rate_stars_count" name="rate_stars_count">
                                
                        <option value="1" @if($Companies_review->rate_stars_count=="1" || old('rate_stars_count')=="1") selected @endif>1</option>
                        
                        <option value="2" @if($Companies_review->rate_stars_count=="2" || old('rate_stars_count')=="2") selected @endif>2</option>
                        
                        <option value="3" @if($Companies_review->rate_stars_count=="3" || old('rate_stars_count')=="3") selected @endif>3</option>
                        
                        <option value="4" @if($Companies_review->rate_stars_count=="4" || old('rate_stars_count')=="4") selected @endif>4</option>
                        
                        <option value="5" @if($Companies_review->rate_stars_count=="5" || old('rate_stars_count')=="5") selected @endif>5</option>
                        
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#rate_stars_count:not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>
            
            
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("companies_reviews.comment")}}:</strong>
                            {!! Form::textarea('comment', $Companies_review->comment, array('placeholder' => trans("companies_reviews.comment"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
            
             
 <div class="col-md-12">
 <strong>{{trans("companies_reviews.users_likes_ids")}}:</strong>
                                    <div class="blog_tablesearch">
                                        <div class="table-responsive">
                                            <table  id="table_users_likes_ids" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="is_filter">{{trans("users.id")}}</th>
                          <th class="is_filter">{{trans("users.role")}}</th>
                          <th class="is_filter">{{trans("users.type")}}</th>
                          <th class="is_filter">{{trans("users.fullname")}}</th>
                          <th class="is_filter">{{trans("users.email")}}</th>
                          <th class="is_filter">{{trans("users.mobile")}}</th>
                          <th class="is_filter">{{trans("users.gender")}}</th>
                          <th width="100px">تحكم</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="is_filter">{{trans("users.id")}}</th>
                          <th class="is_filter">{{trans("users.role")}}</th>
                          <th class="is_filter">{{trans("users.type")}}</th>
                          <th class="is_filter">{{trans("users.fullname")}}</th>
                          <th class="is_filter">{{trans("users.email")}}</th>
                          <th class="is_filter">{{trans("users.mobile")}}</th>
                          <th class="is_filter">{{trans("users.gender")}}</th>
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
                                        var table = $('#table_users_likes_ids').DataTable({
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
                                                url: '{{ route('getusersInfo_for_companies_reviews_forFieldusers_likes_ids') }}',
                                                data: {
                                                    'Companies_review_id' : '{{ $Companies_review->id}}' ,
                                                }
                                            },
                                            aoColumns: [
                                               {data: 'id', name: 'id'},
                    {data: 'role', name: 'role'},
                    {data: 'type', name: 'type'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'gender', name: 'gender'},
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
            
             
 <div class="col-md-12">
 <strong>{{trans("companies_reviews.users_dislikes_ids")}}:</strong>
                                    <div class="blog_tablesearch">
                                        <div class="table-responsive">
                                            <table  id="table_users_dislikes_ids" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="is_filter">{{trans("users.id")}}</th>
                          <th class="is_filter">{{trans("users.role")}}</th>
                          <th class="is_filter">{{trans("users.type")}}</th>
                          <th class="is_filter">{{trans("users.fullname")}}</th>
                          <th class="is_filter">{{trans("users.email")}}</th>
                          <th class="is_filter">{{trans("users.mobile")}}</th>
                          <th class="is_filter">{{trans("users.gender")}}</th>
                          <th width="100px">تحكم</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="is_filter">{{trans("users.id")}}</th>
                          <th class="is_filter">{{trans("users.role")}}</th>
                          <th class="is_filter">{{trans("users.type")}}</th>
                          <th class="is_filter">{{trans("users.fullname")}}</th>
                          <th class="is_filter">{{trans("users.email")}}</th>
                          <th class="is_filter">{{trans("users.mobile")}}</th>
                          <th class="is_filter">{{trans("users.gender")}}</th>
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
                                        var table = $('#table_users_dislikes_ids').DataTable({
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
                                                url: '{{ route('getusersInfo_for_companies_reviews_forFieldusers_dislikes_ids') }}',
                                                data: {
                                                    'Companies_review_id' : '{{ $Companies_review->id}}' ,
                                                }
                                            },
                                            aoColumns: [
                                               {data: 'id', name: 'id'},
                    {data: 'role', name: 'role'},
                    {data: 'type', name: 'type'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'gender', name: 'gender'},
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
                                <strong>{{trans("companies_reviews.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Companies_review->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div>
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_reviews.created_at")}}  التاريخ :</strong>
                            {!! Form::date('created_at_date',  date('Y-m-d',strtotime($Companies_review->created_at))  , array('placeholder' => trans("companies_reviews.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_reviews.created_at")}}  الوقت :</strong>
                            {!! Form::time('created_at_time', date('H:i',strtotime($Companies_review->created_at)), array('placeholder' => trans("companies_reviews.created_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            
             <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_reviews.updated_at")}}  التاريخ :</strong>
                            {!! Form::date('updated_at_date',  date('Y-m-d',strtotime($Companies_review->updated_at))  , array('placeholder' => trans("companies_reviews.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("companies_reviews.updated_at")}}  الوقت :</strong>
                            {!! Form::time('updated_at_time', date('H:i',strtotime($Companies_review->updated_at)), array('placeholder' => trans("companies_reviews.updated_at "),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
                    
            

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
