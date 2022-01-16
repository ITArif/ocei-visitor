<div class="row">
    <div class="col-xs-12 padding-lr0">
        <!-- Fixed navbar -->
        <nav id="header" class="navbar custom-navbar"> <!--  navbar-fixed-top -->
            <div id="header-container" class="container navbar-container">
                <div class="navbar-header">
                    <button type="button"
                            class="navbar-toggle collapsed "
                            data-toggle="collapse"
                            data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="brand" class="navbar-brand visible-xs" href="#">
                        <img style="margin-right: 10px" class="pull-left"
                             src="{{asset('frontend/assets/img/logo.png')}}" alt="গণপ্রজাতন্ত্রী বাংলাদেশ">
                        <div class="pull-left">
                            <h4 class="logo-title">OCEI</h4>
                        </div>
                    </a>
                </div>

                <div id="navbar" class="collapse navbar-collapse">
                    <a class="logo-fixed-top clearfix pull-left" href="#">
                        <img style="margin-right: 10px" class="pull-left"
                             src="{{asset('frontend/echallan/assets/img/logo.png')}}" alt="গণপ্রজাতন্ত্রী বাংলাদেশ">
                        <div class="pull-left hidden-sm">
                            <h4 class="logo-title">OCEI</h4>
                        </div>
                    </a>

                    <ul class="nav navbar-nav pull-left">
                        <li class="active">
                            <a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);">Verify License</a>
                        </li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
    </div>
</div>