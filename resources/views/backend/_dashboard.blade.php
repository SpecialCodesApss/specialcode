@extends('backend.layouts.app')

@section('title','Admin - Dashboard')
@section('header')

@endsection


@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <h3>
                {{trans('admin.welcomeMessage')}}
            </h3>

            <?php

            use Illuminate\Support\Facades\Session;

            $colorArr=['colorblue','colorred','coloryellow','colortrequaz','color4'];
                $i=0;
                $lang = Session::get('applocale');
            ?>
            <div class="row">
            @foreach($admin_sections as $admin_section)
                    @if( $admin_section['active']==1)
                    @if($admin_section->is_drop_menu == 0)
                    <div class="col-md-3 cp_labels">
                        <div class="box_sales {{$colorArr[$i]}}">
                            <a href="{{url('admin/'.$admin_section['section_flag'])}}">
                                <p class="text-center">
                                    <i class="fas fa-{{$admin_section['section_icon']}}"></i>
                                </p>
                                <p class="text-center">
<!--                                    {{$admin_section['section_name_ar']}}-->
<!--                                    {{ __('message.admin') }}-->

<!--                                    {{__('messages.admin')}}-->
<!--                                    {{trans('messages.'.$admin_section['section_flag'])}}-->
                                    @if($lang == "en")
                                    {{$admin_section['section_name_en']}}
                                    @else
                                    {{$admin_section['section_name_ar']}}
                                    @endif
                                </p>
                            </a>
                        </div><!--box_sales-->
                    </div><!--col-md-3-->
                        <?php $i++; if($i==5) { $i=0;} ?>

                    @else
                        @foreach($admin_section['sub_sections'] as $sub_section)
                            <div class="col-md-3 cp_labels">
                                <div class="box_sales {{$colorArr[$i]}}">
                                    <a href="{{url('admin/'.$sub_section['section_flag'])}}">
                                        <p class="text-center">
                                            <i class="fas fa-{{$sub_section['section_icon']}}"></i>
                                        </p>
                                        <p class="text-center">

                                            @if($lang == "en")
                                            {{$sub_section['section_name_en']}}
                                            @else
                                            {{$sub_section['section_name_ar']}}
                                            @endif


                                        </p>
                                    </a>
                                </div><!--box_sales-->
                            </div><!--col-md-3-->
                            <?php $i++; if($i==5) { $i=0;} ?>
                        @endforeach

                    @endif
                    @endif

            @endforeach
            </div>

{{--            <div class="row">--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="box_sales colorblue">--}}
{{--                        <a href="#">--}}
{{--                            <h3>إجمالي المستخدمين</h3>--}}
{{--                            <p>1000 مستخدم</p>--}}
{{--                        </a>--}}
{{--                    </div><!--box_sales-->--}}
{{--                </div><!--col-md-3-->--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="box_sales colorred">--}}
{{--                        <a href="#">--}}
{{--                            <h3>إجمالي المستخدمين</h3>--}}
{{--                            <p>1000 مستخدم</p>--}}
{{--                        </a>--}}
{{--                    </div><!--box_sales-->--}}
{{--                </div><!--col-md-3-->--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="box_sales coloryellow">--}}
{{--                        <a href="#">--}}
{{--                            <h3>إجمالي المستخدمين</h3>--}}
{{--                            <p>1000 مستخدم</p>--}}
{{--                        </a>--}}
{{--                    </div><!--box_sales-->--}}
{{--                </div><!--col-md-3-->--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="box_sales colortrequaz">--}}
{{--                        <a href="#">--}}
{{--                            <h3>إجمالي المستخدمين</h3>--}}
{{--                            <p>1000 مستخدم</p>--}}
{{--                        </a>--}}
{{--                    </div><!--box_sales-->--}}
{{--                </div><!--col-md-3-->--}}
{{--            </div><!--row-->--}}

        </div><!--col_page_content-->
    </div><!--wrapper_cols-->

@endsection

@section('footer')

@endsection
