@extends('admin/layouts/app')

@section('title','لوحة تحكم الإدارة')


@section('header')

@endsection


@section('content')
<div class="wrapper_cols">
    <div class="col_page_content">
        <h3> تغيير الرقم السري </h3>

        <form action="changePassword" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="old_password">الرقم السري الحالى</label>
                <input class="form-control" type="password" name="old_password" >
            </div>

            <div class="form-group">
                <label for="new_password">الرقم السري الجديد</label>
                <input class="form-control" type="password" name="new_password" >
            </div>

            <div class="form-group">
                <label for="confirm_new_password">إعادة الرقم السري الجديد</label>
                <input class="form-control" type="password" name="new_password_confirmation">
            </div>

            <button class="btn btn-primary" type="submit">تعديل</button>
        </form>


    </div><!--col_page_content-->
</div><!--wrapper_cols-->

@endsection

@section('footer')

@endsection
