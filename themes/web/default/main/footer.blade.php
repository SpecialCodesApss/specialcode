<!-- Required Jquery -->
<script type="text/javascript" src="{{url('themes/web/default/assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('themes/web/default/assets/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('themes/web/default/assets/js/popper.min.js')}}"></script>
<script src="{{url('themes/web/default/assets/js/bootstrap.min.js')}}"></script>

<!-- waves js -->
<script src="{{url('themes/admin/admindek/assets/pages/waves/js/waves.min.js')}}"></script>

<!-- notifications -->
@if (Config::get('languages')[App::getLocale()] != "Arabic")
    <script src="{{url('themes/admin/admindek/assets/js/notification/notification.js')}}"></script>
@else
    <script src="{{url('themes/admin/admindek/assets/js/notification/notification_ar.js')}}"></script>
@endif
<script src="{{url('themes/admin/admindek/assets/js/bootstrap-growl.min.js')}}"></script>
<script src="{{url('themes/admin/admindek/assets/js/imageScript.js')}}"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
<script src="{{url('themes/admin/admindek/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('themes/admin/admindek/assets/js/vertical/vertical-layout.min.js')}}"></script>



<!--  File Input -->
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/fileinput.js')}}"></script>

<!--  Chosen selector  -->
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/chosen.jquery.js')}}"></script>


{{--    <!-- Font Awesome  -->--}}
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/fontawesome5.js')}}"></script>

<script>

    //prevent form from submit data on click enter
    $('form').submit(function () {
        if ($(document.activeElement).attr('type') == 'submit')
            return true;
        else return false;
    });


    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });

    $(".chosen-select").chosen();

</script>


@yield('footer')



@if(session('success'))
    <script>
        $(document).ready(function() {
            notify('bottom', 'right', '', 'inverse',
                'animated fadeInUp', 'animated fadeOutDown', '', '{{session('success')}}'
                , '');
        });
    </script>
@endif

@if(session('error'))
    <script>
        notify('bottom', 'right','','inverse',
            'animated fadeInUp','animated fadeOutDown','','{{session('error')}}'
            ,'');
    </script>
@endif

@if(session('errors'))
    <script>
        notify('bottom', 'right','','inverse',
            'animated fadeInUp','animated fadeOutDown','','{{session('errors')->first()}}'
            ,'');
    </script>
    @endif

    </body>


    </html>
