@extends('developer::layouts/app')

@section('title','Start New Project')


@section('header')

@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Start New Project</h1>

                <form class="form-inline" method="post" action="{{url('developer/start_project')}}" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group col-md-3">
                        <label for="project_name">project_name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="database_name">database_name</label>
                        <input type="text" class="form-control" id="database_name" name="database_name">
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="package_id">package_id "bundle"</label>
                        <input type="text" class="form-control" id="package_id" name="package_id">
                    </div>


                    <div class="col-md-12">
                        <h3>Images & logos</h3>
                    </div>


                    <div class="form-group  col-md-3">
                        <label for="dashboard_logo">Dashboard Logo</label>
                        <input type="file" class="form-control" id="dashboard_logo" name="dashboard_logo">
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="splash_image">Splash image</label>
                        <input type="file" class="form-control" id="splash_image" name="splash_image">
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="basic_splash_image">basic Splash image</label>
                        <input type="file" class="form-control" id="basic_splash_image" name="basic_splash_image">
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="app_icon">App Icon</label>
                        <input type="file" class="form-control" id="app_icon" name="app_icon">
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="app_bg">App Background</label>
                        <input type="file" class="form-control" id="app_bg" name="app_bg">
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="app_login_bg">Login Background</label>
                        <input type="file" class="form-control" id="app_login_bg" name="app_login_bg">
                    </div>

                    <div class="col-md-12">
                        <h3>Urls</h3>
                    </div>

                    <div class="form-group  col-md-6">
                        <label for="server_url">server_url</label>
                        <input type="text" class="form-control" id="server_url" name="server_url">
                    </div>

                    <div class="form-group  col-md-6">
                        <label for="app_real_website">app_real_website</label>
                        <input type="text" class="form-control" id="app_real_website" name="app_real_website">
                    </div>


                   <div class="col-md-12">
                       <h3>Colors</h3>
                   </div>

                    <div class="form-group  col-md-3">
                        <label for="primary_color">primary color</label>
                        <input type="text" class="form-control" id="primary_color" name="primary_color">
                    </div>
                    <div class="form-group  col-md-3">
                        <label for="secondary_color">secondary color</label>
                        <input type="text" class="form-control" id="secondary_color" name="secondary_color">
                    </div>
                    <div class="form-group  col-md-3">
                        <label for="button_color">button color</label>
                        <input type="text" class="form-control" id="button_color" name="button_color">
                    </div>


                    <div class="form-group  col-md-6">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>


        @endsection

        @section('footer')

    @endsection

