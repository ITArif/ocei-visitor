@extends('backend.master')

@section('title', 'All Appointment List')
@section('dashboard-title', 'All Appointment List')
@section('breadcrumb-title', 'All Appointment  Information')

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
                Please Select Phone Number
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
              <form action="{{route('checkAppointmentList')}}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                              <label for="exampleInputFile">Phone Number</label>
                              <select class="form-control select2bs4" name="phone" id="phone" style="width: 100%;">
                                <option value="">----Select Phnone Number----</option>
                                @foreach ($visitorAppointments as $visitorAppointment)
                                    <option value="{{$visitorAppointment->visitorPhone}}">{{$visitorAppointment->visitorPhone}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <!--  <a href="#" class="btn btn-primary float-left">Search</a> -->
                   <button id="buttonSearch" type="submit" class="btn btn-primary float-right" style="margin-right: 10px">
                    <span class="fas fa-search"></span>&nbsp;Search
                   </button> 
                </div>
              </form>
            </div>
          </div>
          </div>
        </div>
      <!-- ./row -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                All Appointments
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-employee" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-success ">
                      <th>SL No</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Approval Of</th>
                      <th>Purpose</th>
                      <!-- <th>Request Details</th> -->
                      <th>Date & Time</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                   @foreach($checkAppointmentList as $checkAppointment)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>
                      <img src="{{ asset('images/avatar.png') }}" style="width: 80px;height: 80px"><br>
                      <p style="font-size:13px;">{{$checkAppointment->visitorName}}</p>
                    </td>
                    <td>{{$checkAppointment->visitorPhone}}</td>
                    <td>{{$checkAppointment->empeeName}}{{$checkAppointment->epeeLastName}}</td>
                    <td>{{$checkAppointment->purpose}}</td>
                    <!-- <td>{{$checkAppointment->request_detail}}</td> -->
                    <td>{{ date('j F Y g:i A', strtotime($checkAppointment->date_time)) }}</td>
                      @if ($checkAppointment->approval_of==1)
                        <td>
                            <button class="btn btn-sm btn-success btn-xs">Approved</button>
                        </td>
                      @elseif($checkAppointment->approval_of==3)
                        <td>
                            <button class="btn btn-sm btn-warning btn-xs">Pending</button>
                        </td>
                      @else
                        <td>
                            <button class="btn btn-sm btn-danger btn-xs">Rejected</button>
                        </td>
                      @endif
                    <td>
                      @if ($checkAppointment->approval_of==1)
                      <a href="{{url('receptionists/create/appointment',$checkAppointment->id)}}" title="Get Pass" class="btn btn-success btn-xs"><i class="fas fa-plus-square"></i></a>
                      @else
                       
                       
                      @endif
                    </td>
                   </tr>
                  @endforeach
               </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.col-->
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
  })
  $(document).ready(function() {
    $('#all-employee').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
} );
</script>
@endsection