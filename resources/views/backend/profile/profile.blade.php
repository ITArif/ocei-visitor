@extends('backend.master')

@section('title', 'Visitor Profile')
@section('dashboard-title', 'Profile')
@section('breadcrumb-title', 'Visitor Profile Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('images/user4-128x128.jpg')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{session('user_name')}}</h3>

                <p class="text-muted text-center">Visitor</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right">{{session('user_name')}}</a>
                  </li>
                </ul>
                <a href="javascript:void(0)" class="btn btn-primary btn-block"><b>Update</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Update Password</a></li>
                </ul>
              </div><!-- /.card-header -->
             
              <div class="col-md-10 offset-2 mt-2">
              @if(Session::has('success'))
                <div class="alert alert-success alert-block text-center">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong class="text-center">{{ Session::get('success') }}</strong>
                </div>
                @endif

                @if(Session::has('failed'))
                <div class="alert alert-danger alert-block text-center">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong> {{ Session::get('failed') }}</strong>
                </div>
              @endif
              @if(Session::has('error'))
                <div class="alert alert-danger alert-block text-center">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ Session::get('error') }}</strong>
                </div>
              @endif
              </div>
          <!-- </div> -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profile">
                    <!-- Post -->
                    <form class="form-horizontal" action="{{route('update.profile')}}" method="post">
                      @csrf
                      <div class="form-group row {{$errors->has('user_name') ? 'has-error' : ''}}">
                        <label for="inputName" class="col-sm-2 col-form-label">Name<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Name" value="{{session('user_name')}}">
                          @if($errors->has('user_name'))
                          <span class="help-block text-danger">
                            {{$errors->first('user_name')}}
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                      </div>
                    </form>
                    <!-- /.post -->

                    <!-- Post -->
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                 
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="password">
                    <form action="#" method="post" class="form-horizontal">
                     @csrf
                      <div class="form-group row {{$errors->has('old_password') ? 'has-error' : ''}}">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password">
                          @if($errors->has('old_password'))
                          <span class="help-block text-danger">
                            {{$errors->first('old_password')}}
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row {{$errors->has('password') ? 'has-error' : ''}}">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                          @if($errors->has('password'))
                          <span class="help-block text-danger">
                            {{$errors->first('password')}}
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm Password<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm Password">
                          @if($errors->has('password_confirmation'))
                          <span class="help-block text-danger">
                            {{$errors->first('password_confirmation')}}
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
@endsection

@section('custom_script')


@endsection