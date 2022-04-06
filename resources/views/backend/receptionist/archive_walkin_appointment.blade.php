@extends('backend.master')

@section('title', 'All Archived Walk In Appointment History')
@section('dashboard-title', 'All Archived Walk In Appointment History')
@section('breadcrumb-title', 'All Archived Walk In Appointment  History')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
      <!-- ./row -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">All Archived Walk In Appointments</h3>
              <!-- <button class="btn btn-danger btn-sm float-sm-left" id="delete_all" style="margin:5px;"><i class="fa fa-trash"></i> Delete</button>&nbsp -->
            <!--  <button class="btn btn-success btn-sm float-sm-left" id="done_all" style="margin:5px;"><i class="fa fa-check"></i> Done?</button>&nbsp
             <button class="btn btn-warning btn-sm float-sm-left" id="pending_all" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> Pending?</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-archive-appointment" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-success ">
                      <th>SL No</th>
                     <!--  <th>Id Card Number</th> -->
                      <th>Visitor Name & Phone</th>
                      <th>ID Number</th>
                      <th>Purpose</th>
                      <th>Employee Name</th>
                      <th>Branch Name</th>
                      <th>Appointment Date & Time</th>
                      <th>Start Date & Time</th>
                      <th>End Date & Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                   @foreach($archiveWalkInAppointments as $archiveWalkInAppointment)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$archiveWalkInAppointment->name}} <br>{{$archiveWalkInAppointment->contact_no}}</td>
                    <td>{{$archiveWalkInAppointment->id_card_number}}</td>
                    <td>{{$archiveWalkInAppointment->purpose}}</td>
                    <td>{{$archiveWalkInAppointment->firstName}} {{$archiveWalkInAppointment->lName}}</td>
                    <td>{{$archiveWalkInAppointment->branchName}}</td>
                    <td>{{ date('j F Y g:i A', strtotime($archiveWalkInAppointment->date_time)) }}</td>
                    <td>{{ date('j F Y g:i A', strtotime($archiveWalkInAppointment->created_at)) }}</td>
                    @if ($archiveWalkInAppointment->status==0)
                    <td></td>
                    @else
                    <td>{{ date('j F Y g:i A', strtotime($archiveWalkInAppointment->updated_at)) }}</td>
                    @endif

                      @if ($archiveWalkInAppointment->status==1)
                        <td>
                            <button class="btn btn-sm btn-success btn-xs">Done</button>
                        </td>
                      @else
                        <td>
                            <button class="btn btn-sm btn-warning btn-xs">Pending</button>
                        </td>
                      @endif
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
  $(document).ready(function() {
    $('#all-archive-appointment').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
  } );
</script>
@endsection