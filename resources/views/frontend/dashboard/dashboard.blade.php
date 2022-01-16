@extends('frontend.master')
@section('title', 'Ocei Index')
@section('stylesheet')

@endsection
@section('contain')
    <div class="col-md-9 col-sm-8 col-xs-12">
        <div class="home-slider-wrapper slider-wrapper">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{ asset('frontend/echallan/assets/img/ocei_banner.png') }}" alt="Frist Slide"
                            style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="{{ asset('frontend/echallan/assets/img/slider/slide-2.jpg') }}" alt="Secound Slide"
                            style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="{{ asset('frontend/echallan/assets/img/slider/slide-3.jpg') }}" alt="Third Slide"
                            style="width:100%;">
                    </div>
                </div>

                <!-- Left and right controls -->
            </div>
        </div>
        <div class="clearfix col-xs-12 padding-lr0">
            <div class="padding-lr0 col-xs-12 homepage-tab-wrapper margin-top10">
                <ul class="nav nav-tabs tab-links" role="tablist">
                </ul>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-3 padding-l0 sidebar-offcanvas" id="sidebar">
        <div class="panel panel-primary custom-panel">
            <div class="panel-heading bg-violet-deep">
                <h3 class="panel-title"><b>Total Number of Supervisor, Electrical and Contractor Certified Engineer. </b>
                </h3>
            </div>
            <marquee direction="up">
                <div class="panel-body" style="color:#31343b;">
                    <p><b>ELB Certified Electrician </b><span style="color: red;font-size: 20px; margin-left: 20px;">
                            :</span> <span class='font-family-boishkhi'>11003</span></p>
                    <p><b>ELB Certified Supervisor </b><span style="color: red;font-size: 20px; margin-left: 20px;">
                            :</span> <span class='font-family-boishkhi'>4420</span></p>
                    <p><b>ELB Certified Contractor </b><span style="color: red;font-size: 20px; margin-left: 20px;">
                            :</span> <span class='font-family-boishkhi'>3036</span></p>
                </div>
            </marquee>
        </div>
    </div>

    <footer style="left: 0; width: 100%;color: white; position:fixed; bottom:0;" class="margin-top-50">
        <div class="row">
            <div class="footer-artwork" id="footer-artwork">
                <img class="img-responsive" src="{{ asset('frontend/echallan/assets/img/footer_top_bg.png') }}" alt=""
                    title="">
            </div>
            <div class="footer-wrapper full-width" id="footer-wrapper">
                <div id="footer-menu" class="clearfix">
                    <div class="col-xs-12 col-md-7 footer-left">
                        <ul class="list-inline">
                            <li><a href="#">Ocei সম্বন্ধে</a></li>
                            <li><a href="#">ব্যবহার নির্দেশিকা</a></li>
                            <li><a href="#">সচরাচর জিজ্ঞাসা</a></li>
                            <li><a href="#">যোগাযোগ</a></li>
                            <li><a href="#-">সাইটম্যাপ</a></li>
                        </ul>
                    </div>

                    <div class="col-xs-12 col-md-5 credit-org text-right">
                        <div class="full-row">
                            <a target="_blank" href="http://ocei.portal.gov.bd/">
                                প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

@endsection
