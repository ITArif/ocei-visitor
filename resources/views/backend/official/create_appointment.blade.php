@extends('backend.master')

@section('title', 'Create Appointment')
@section('dashboard-title', 'Create Appointment')
@section('breadcrumb-title', 'Create Appointment')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Appointment Form
              </h3>
            </div>
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
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('storeAppointment',$employee->employee_id)}}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Official</label>
                                  <select class="form-control select2bs4" name="employee_id" id="employee_id" style="width: 100%;">
                                    <option value="">----Select----</option>
                                    <option value="{{$employee->employee_id}}" @if(!empty($employee->employee_id) && $employee->employee_id == $employee->employee_id) selected="" @endif>{{$employee->first_name}} {{$employee->last_name}} <!-- [{{$employee->phone}}] --></option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Official</label>
                                  <select class="form-control select2bs4" name="branch_id" id="branch_id" style="width: 100%;">
                                    <option value="">----Select Branch----</option>
                                    <option value="{{$employee->branch_id}}" @if(!empty($employee->branch_id) && $employee->branch_id == $employee->branch_id) selected="" @endif>{{$employee->branchName}} <!-- [{{$employee->phone}}] --></option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label>Date and time <span style="color: red;" class="required">*</span></label>
                                  <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                      <input type="text" name="date_time" class="form-control datetimepicker-input" data-target="#reservationdatetime">
                                      <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                                  @if($errors->has('date_time'))
                                    <span class="text-danger">{{ $errors->first('date_time') }}</span>
                                  @endif
                              </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Purpose <span style="color: red;" class="required">*</span></label>
                                  <select class="form-control select2bs4" name="purpose" id="purpose" style="width: 100%;">
                                    <option value="">----Select----</option>
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
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Request Details</label>
                                  <textarea class="form-control" name="request_detail" rows="3" cols="3" placeholder="Request Details"></textarea>
                                </div>
                            </div>
                            <div hidden="" class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">visitor id</label>
                                  <div class="custom-file">
                                    <input type="hidden" class="custom-file-input" name="visitor_id" id="visitor_id" value="{{session('id')}}">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                       <a href="{{route('official.list')}}" class="btn btn-info float-left">Back</a>
                       <button id="buttonSearch" type="submit" class="btn btn-success float-right" style="margin-right: 10px"> Submit
                       </button> 
                    </div>
              </form>
            </div>
          </div>
          </div>
        </div>
      <!-- ./row -->
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

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false
})

</script>
@endsection