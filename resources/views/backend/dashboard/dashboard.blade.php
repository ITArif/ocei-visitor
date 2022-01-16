@extends('backend.master')

@section('title', 'Visitor Dashboard')
@section('dashboard-title', 'Dashboard')
@section('breadcrumb-title', 'Dashboard Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-3">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$totalAppointment}}</h3>
                <p>Total Appointments</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-columns"></i>
              </div>
              <a href="{{route('appointment.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="small-box bg-info">
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed bg-info" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Informtion About Visiting OCEI
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body text-dark">
                      <span class="badge bg-dark">1</span>
                      Visitor can apply for an appointment at least two days prior to his visiting date.<br>
                      <span class="badge bg-dark">2</span>
                      After getting an appointment visitor must take an ID card from receptionist.<br>
                      <span class="badge bg-dark">3</span>
                      After completing his appointment visitor must hand over his ID card to reception desk.<br>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
            <!-- <div class="card-footer clearfix">
              <a href="{{route('official.list')}}" class="btn btn-success float-left"><i class="fas fa-plus"></i> Create Appointment</a>
            </div> -->
          </section>

          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-9">
            <!-- TO DO List -->
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Appointment List
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
                <table id="all-appointmentListData" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th>SL No</th>
                        <th>Request By</th>
                        <th>Request To</th>
                        <th>Approval Of</th>
                        <!-- <th>Purpose</th>
                        <th>Request Details</th> -->
                        <th>Time</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                       @foreach($appointmentListData as $aptmentData)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$aptmentData->visitorName}}</td>
                          <td>{{$aptmentData->firstName}} {{$aptmentData->lName}}</td>
                          <td>
                           <small class="badge badge-info">{{$aptmentData->firstName}} {{$aptmentData->lName}}</small>
                          </td>
                         <!--  <td>{{$aptmentData->purpose}}</td>
                          <td>{{$aptmentData->request_detail}}</td> -->
                          <td> {{ date('j F Y g:i A', strtotime($aptmentData->date_time)) }} </td>
                              @if ($aptmentData->approval_of==1)
                                  <td>
                                      <button class="btn btn-sm btn-success btn-xs">Approved</button>
                                  </td>
                              @elseif($aptmentData->approval_of==3)
                                  <td>
                                      <button class="btn btn-sm btn-warning btn-xs">Pending</button>
                                  </td>
                              @elseif($aptmentData->approval_of==5)
                                    <td>
                                      <button class="btn btn-sm btn-info btn-xs">Already Done</button>
                                  </td>
                              @else
                                  <td>
                                      <button class="btn btn-sm btn-danger btn-xs">Rejected</button>
                                  </td>
                              @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')
<script>
  $(document).ready(function() {
    $('#all-appointmentListData').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
 } );
</script>

@endsection