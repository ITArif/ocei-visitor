@extends('backend.master')

@section('title', 'Receptionist Create Appointment')
@section('dashboard-title', 'Receptionist')
@section('breadcrumb-title', 'Receptionist')

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
                Receptionist Form
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
              <form action="{{route('storeReceptionistsData')}}" method="post">
                @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6" hidden="">
                              <div class="form-group">
                                <label>Appointment ID</label>
                                  <div class="input-group date" data-target-input="nearest">
                                      <input type="number" name="appointment_id" value="{{$appointments->id}}" class="form-control" readonly="">
                                  </div>
                              </div>
                            </div>
                            <div class="col-6" hidden="">
                              <div class="form-group">
                                <label>Visitor ID</label>
                                  <div class="input-group date" data-target-input="nearest">
                                      <input type="number" name="visitor_id" value="{{$appointments->visitor_id}}" class="form-control" readonly="">
                                  </div>
                              </div>
                            </div>
                            <div class="col-6" hidden="">
                              <div class="form-group">
                                <label>Employee Id</label>
                                  <div class="input-group date" data-target-input="nearest">
                                      <input type="text" name="employee_id" readonly="" value="{{$appointments->employee_id}}" class="form-control" readonly="">
                                  </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label>Date and time</label>
                                <input type="text" name="date_time" class="form-control" value="{{$appointments->date_time}}" readonly="">
                              </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Purpose </label>
                                  <div class="input-group date" data-target-input="nearest">
                                      <input type="text" name="purpose" value="{{$appointments->purpose}}" class="form-control" readonly="">
                                  </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Request Details</label>
                                  <textarea class="form-control" name="request_detail" rows="3" cols="3" placeholder="Request Details" readonly="">{{$appointments->request_detail}}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">ID Card Number<span style="color: red;">*</span></label>
                                 <input type="number" name="id_card_number" class="form-control" value="{{old('id_card_number')}}">
                                </div>
                                 @if($errors->has('id_card_number'))
                                  <span class="text-danger">{{ $errors->first('id_card_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                       <button type="submit" class="btn btn-success float-right" style="margin-right: 10px"> Submit
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

    
});

</script>
@endsection