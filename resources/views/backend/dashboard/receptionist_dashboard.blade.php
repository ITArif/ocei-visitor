@extends('backend.master')

@section('title', 'Receptionist Dashboard')
@section('dashboard-title', 'Dashboard')
@section('breadcrumb-title', 'Dashboard Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalVisitor}}</h3>

              <p>Total Visitor</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$totalPendingAppointment}}</h3>

              <p>Total Pending Appointments</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-columns"></i>
            </div>
            <a href="{{route('checkAppointmentList')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$ongoingAppointments}}</h3>

              <p>Ongoing Appointments</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('appontmentHistoryData')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$totalArchievedAppointment}}</h3>

              <p>Archieved Appointments</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('archiveAppointmentData')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="d-flex justify-content-center">
       <div class="col-md-7">
          <div class="card card-info">
            <div class="card-header">
               <h3 style="text-align: center;font-size: 16px;font-family: italic bold;">Walk In Appointment</h3>
                <div class="col-md-8 offset-2 mt-2">
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
            </div>
            <div class="card-body">
              <form action="{{route('walkAppointment')}}" method="post">
                @csrf
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Visitors Name<span style="color: red;" class="required">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                    @if($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Address/Organization<span style="color: red;" class="required">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="address" placeholder="Enter ..."></textarea>
                    @if($errors->has('address'))
                      <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Purpose <span style="color: red;" class="required">*</span></label>
                        <select class="form-control select2bs4" name="purpose" id="purpose" style="width: 100%;">
                          <option value="">----Select Purpose----</option>
                          <option value="official" @if (old('purpose') == "official") {{ 'selected' }} @endif>Official</option>
                          <option value="seminar" @if (old('purpose') == "seminar") {{ 'selected' }} @endif>Seminar</option>
                          <option value="workshop" @if (old('purpose') == "workshop") {{ 'selected' }} @endif>Workshop</option>
                          <option value="meeting" @if (old('purpose') == "meeting") {{ 'selected' }} @endif>Meeting</option>
                          <option value="personal" @if (old('purpose') == "personal") {{ 'selected' }} @endif>Personal</option>
                          <option value="other" @if (old('purpose') == "other") {{ 'selected' }} @endif>Other</option>
                        </select>
                        @if($errors->has('purpose'))
                          <span class="text-danger">{{ $errors->first('purpose') }}</span>
                        @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label>Contact No<span style="color: red;" class="required">*</span></label>
                     <input type="text" class="form-control" name="contact_no" placeholder="Enter ...">
                     @if($errors->has('contact_no'))
                      <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                     @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Officials<span style="color: red;" class="required">*</span></label>
                      <select class="form-control select2bs4" name="employee_id" id="employee_id">
                      <option value="">----Select Employee----</option>
                      @foreach($employees as $employee)
                      <option value="{{$employee->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                      @endforeach
                      </select>
                      @if($errors->has('employee_id'))
                        <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Branch<span style="color: red;" class="required">*</span></label>
                      <select class="form-control select2bs4" name="branch_id" id="branch_id">
                      <option value="">----Select Branch----</option>
                      @foreach($branchs as $branch)
                      <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                      @endforeach
                      </select>
                      @if($errors->has('branch_id'))
                        <span class="text-danger">{{ $errors->first('branch_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>ID No<span style="color: red;" class="required">*</span></label>
                      <input type="text" class="form-control" name="id_card_number" id="id_card_number" placeholder="ID Card Number">
                      @if($errors->has('id_card_number'))
                        <span class="text-danger">{{ $errors->first('id_card_number') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Date and time <span style="color: red;" class="required">*</span></label>
                        <input type="date" name="date_time" id="date_time" class="form-control">
                        @if($errors->has('date_time'))
                          <span class="text-danger">{{ $errors->first('date_time') }}</span>
                        @endif
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Request Details<span style="color: red;" class="required">*</span></label>
                      <textarea class="form-control" rows="3" name="request_detail" placeholder="Enter ..."></textarea>
                    </div>
                  </div>
                </div> -->
                <div class="card-footer">
                 <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
       </div>
       
      </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('custom_script')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //$("#date_time").datepicker({dateFormat: 'yy-mm-dd H:i:s'});
  })
</script>
@endsection