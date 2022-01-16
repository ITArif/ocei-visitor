<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from e-service.ocei.gov.bd/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Sep 2021 07:51:12 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>@yield('title')</title>
    @include('frontend.partials._css_js_head')
</head>



<body>

    <div class="container main-wrapper">
        <!-- Start Loader -->
        <!--<div id="loader">
        <div class="square-spin">
            <img src="/assets/img/preloader.gif" alt="">
        </div>
    </div>-->
        <div class="row">
            <div style="margin-left: 10px; margin-right: 10px;">
                <marquee width="100%" direction="left" height="80px">
                    <h1 style="color: red;">Please Registration First Then You Can Login.</h1>
                </marquee>
            </div>
        </div>

        @include('frontend.partials._header')

        @include('frontend.partials._navbar')

        <div class="clearfix row margin-bottom-50">

            @yield('contain')


        </div>
        <!--/.sidebar-offcanvas-->

    </div>
    <!-- Footer Section -->
    {{-- @include('frontend.partials._footer') --}}
    <!-- End Footer Section -->

    <!-- ScrollTop Starts-->
    <div class="scroll-top hide">
        <a id="gotoTop">
            <i class="fa fa-angle-up fa-2x"></i>
        </a>
    </div>
    <!-- ScrollTop Starts-->
    </div>
    </div>
    <!--/.container-->

    <!--/.container-->

    <script src="{{ asset('frontend/echallan/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/echallan/assets/js/jquery.bootstrap.newsbox.min.js') }}"></script>
    <script src="{{ asset('frontend/echallan/assets/js/highcharts.min.js') }}"></script>
    <script src="{{ asset('frontend/echallan/assets/js/exporting.min.js') }}"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#photo_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <!--Combined JS-->
    <script src="assets/echallan/assets/js/combined.min.js"></script>

    <script src="assets/echallan/assets/js/xlsx.core.min.js"></script>
    <script src="assets/echallan/assets/js/FileSaver.min.js"></script>
    <script src="assets/echallan/assets/js/tableexport.min.js"></script>

</body>

<!-- Mirrored from e-service.ocei.gov.bd/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Sep 2021 07:52:16 GMT -->

</html>
