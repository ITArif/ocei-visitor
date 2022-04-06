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
                  @if($allUsers->name != '')
                   <img class="profile-user-img img-fluid img-circle" src="{{asset('profile/images/'.$allUsers->image)}}" alt="User profile picture">
                  @else
                   <img style="width:25px" src="{{ asset('images/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                  @endif
                </div>

                <h3 class="profile-username text-center">{{$allUsers->name}}</h3>

                <p class="text-muted text-center">{{$allUsers->role}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right">{{$allUsers->name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{$allUsers->phone}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$allUsers->email}}</a>
                  </li>
                </ul>
               <!--  <a href="javascript:void(0)" class="btn btn-primary btn-block"><b>Update</b></a> -->
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
                    <form class="form-horizontal" action="{{route('update.profile')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$allUsers->name}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="email" id="email" placeholder="email" value="{{$allUsers->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="{{$allUsers->phone}}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="exampleInputFile">Upload Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="first-name">Photo Preview <span class="required">*</span>
                            </label>
                            <div class="">
                                <img id="photo_preview" src="{{asset('profile/images/'.$allUsers->image)}}" style="width: 150px;height: 150px">
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success float-right">Update Profile</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="password">
                    <form action="{{route('update.password')}}" method="post" class="form-horizontal">
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

  $("input[type=file]").change(function () {
      var fieldVal = $(this).val();

      // Change the node's value by removing the fake path (Chrome)
      fieldVal = fieldVal.replace("C:\\fakepath\\", "");

      if (fieldVal != undefined || fieldVal != "") {
          $(this).next(".custom-file-label").attr('data-content', fieldVal);
          $(this).next(".custom-file-label").text(fieldVal);
      }
  });

</script>
@endsection