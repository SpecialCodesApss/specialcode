@extends('developer::layouts/app')

@section('title','Extensinos')


@section('header')

@endsection


@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <h3> Extensinos  </h3>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Hello Developer</h1>
                                        <h3>Hello Taha ! .. please select module folder to install it ..</h3>
                                        <br>
                                        <br>

                                        <form method="post" action="{{url('developer/install_extension')}}" enctype="multipart/form-data">
                                            {{csrf_field()}}


{{--                                            Type Folder Name:--}}
{{--                                            <input class="form-control" type="text" name="foldername" /><br/><br/>--}}

                                            <input class="form-control hidden" type="text" id="pathes" name="pathes"  hidden="" />

{{--                                            Module Name:--}}
{{--                                            <input class="form-control" type="text" name="module_name" /><br/><br/>--}}

                                            Select Folder to Upload:
                                            <input   type="file" name="files[]" id="files" multiple directory="" webkitdirectory="" moxdirectory="" /><br/><br/>
                                            <button   type="submit" class="btn btn-primary">Submit</button>
                                            <br><br>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div><!--col_page_content-->
            </div><!--wrapper_cols-->

        @endsection

        @section('footer')

            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

            <script>
                document.getElementById("files").addEventListener("change", function(event) {
                    var paths = [] ;
                    let files = event.target.files;
                    for (let i=0; i<files.length; i++) {
                        paths.push(files[i].webkitRelativePath);
                    };
                    $("#pathes").val(paths);
                }, false);
            </script>


    @endsection

{{--            <div class="content">--}}
{{--                <div class="container-fluid">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}

{{--            <h3> Install Extension  </h3>--}}

{{--            <h1>Hello Developer</h1>--}}
{{--            <h3>Hello Taha ! .. please select module folder to install it ..</h3>--}}
{{--            <br>--}}
{{--            <br>--}}

{{--            <form method="post" action="{{url('developer/install_extension')}}" enctype="multipart/form-data">--}}
{{--                {{csrf_field()}}--}}


{{--                Type Folder Name:--}}

{{--                <input class="form-control" type="text" name="foldername" /><br/><br/>--}}

{{--                <input class="form-control hidden" type="text" id="pathes" name="pathes"  hidden="" />--}}

{{--                Module Name:--}}
{{--                <input class="form-control" type="text" name="module_name" /><br/><br/>--}}

{{--                Select Folder to Upload:--}}
{{--                <input   type="file" name="files[]" id="files" multiple directory="" webkitdirectory="" moxdirectory="" /><br/><br/>--}}
{{--                <button   type="submit" class="btn btn-primary">Submit</button>--}}
{{--                <br><br>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}

