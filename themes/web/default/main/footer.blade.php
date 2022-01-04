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


@yield('footer')



@if(session('success'))
    <script>
        $(document).ready(function() {
            notify('bottom', 'right', '', 'inverse',
                'animated fadeInUp', 'animated fadeOutDown', '', '{{session('success')}}'
                , '' );
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
