<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
        </p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="{{url('themes/admin/admindek/assets/images/browser/chrome.png')}}" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="{{url('themes/admin/admindek/assets/images/browser/firefox.png')}}" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="{{url('themes/admin/admindek/assets/images/browser/opera.png')}}" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="{{url('themes/admin/admindek/assets/images/browser/safari.png')}}" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="{{url('themes/admin/admindek/assets/images/browser/ie.png')}}" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/bower_components/jquery/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
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
<!-- Custom js -->
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/script.min.js')}}"></script>
<script type="text/javascript" src="{{url('themes/admin/admindek/assets/js/script.min.js')}}"></script>


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


<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/sample-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Dec 2021 18:01:54 GMT -->
</html>
