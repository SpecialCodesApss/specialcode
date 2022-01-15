@extends('layouts.app')
@section('title',trans('faqs.faqs'))
@section('header')


<link href="{{url('themes/admin/admindek/assets/css/jquery.dataTables.min.css')}} " rel="stylesheet">
<link href="{{url('themes/admin/admindek/assets/css/dataTables.bootstrap4.min.css')}} " rel="stylesheet">
<link href="{{url('themes/admin/admindek/assets/css/responsive.dataTables.min.css')}} " rel="stylesheet">


@endsection
@section('content')
<?php $lang=App::getLocale(); ?>

<div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">


    <div class="card">
                                <div class="card-header">
                                    <h5>{{trans('faqs.faqs')}}</h5>
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

                <div class="col-lg-12">
                      <div class="row">
                        @foreach($faqs as $Faq)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">{{$Faq->{"question_".$lang} }}</h6>
                                        <p class="card-text">
                                            {{$Faq->{"answer_".$lang} }}</p>


                                    </div>
                                </div>
                            </div>
                        @endforeach

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

