@extends('frontend.master')
@section('title', 'Register')
@section('stylesheet')

@endsection
@section('contain')
    <div>
        <div class="col-md-12 col-sm-8 col-xs-12">
            <div class="row registration-page-wrapper">
                <div class="col-xs-12">
                    <div id="messageSection" class="alert alert-success hide">
                        <button class="close" data-dismiss="alert">×</button>
                        <div id="messageBody">
                        </div>
                    </div>
                    <h3 class="page-heading">
                        <span>Visitor Registration Form</span>
                    </h3>
                    <div class="col-md-12 offset-2 mt-2">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong class="text-center">{{ $message }}</strong>
                            </div>
                        @endif

                        @if ($message = Session::get('danger'))
                            <div class="alert alert-danger alert-block text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <form method="post" action="{{ route('store.register') }}" class="form clearfix"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- left column -->
                                    <div class="col-md-6">
                                        <!-- general form elements -->
                                        <div class="card card-primary">
                                            <!-- form start -->
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="NAME">Full Name :<span id="mark">&nbsp;*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ old('name') }}" placeholder="Full Name">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email: <span id="mark">&nbsp;*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        value="{{ old('email') }}" placeholder="sample@email.com">
                                                    @if ($errors->has('email'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Password :<span id="mark">&nbsp;*</span></label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" value="" placeholder="Password">
                                                    @if ($errors->has('password'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="PASSWORD">Profile Picture<span style="color:red;" id="mark">&nbsp;(png,jpg,jpeg)</span></label>
                                                    <input type="file" class="form-control" name="image" id="image" onchange="validateFileType()">
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>
                                    <!--/.col (left) -->
                                    <!-- right column -->
                                    <div class="col-md-6">
                                        <!-- Form Element sizes -->
                                        <div class="card card-success">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Phone Number<span id="mark">&nbsp;*</span></label>
                                                    <input type="text" class="form-control" name="phone"
                                                        value="{{ old('phone') }}" placeholder="017123093965">
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="NAME">Present Address :</label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        value="{{ old('address') }}" placeholder="Address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="NAME">Confirm Password :<span
                                                            id="mark">&nbsp;*</span></label>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" id="password" value=""
                                                        placeholder="Confirm password">
                                                    @if ($errors->has('password_confirmation'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                        for="first-name">Image Preview </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <img id="photo_preview" src="" style="width: 150px;height: 150px">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->

                                        <!-- /.card -->
                                    </div>
                                    <!--/.col (right) -->
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <div style="margin-bottom:2px!important;" class="col-md-12">
                                        <span>Are you already registered? Please</span>
                                        <a class="light-green" href="{{ route('visitor.login') }}">
                                            login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                </div>

            </div>
            @include('frontend.partials._footer')
        </div>

    </div>

@endsection

@section('custom_script')
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
@endsection
