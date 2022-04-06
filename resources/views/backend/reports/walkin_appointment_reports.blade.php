@extends('backend.master')

@section('title', 'All WalkIn Appointment Reports')
@section('dashboard-title', 'All WalkIn Appointment Reports')
@section('breadcrumb-title', 'All WalkIn Appointment Reports Information')

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
                Please Select Branch & From Date & To Date
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('walkInAppointmentReports')}}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputFile">From Date</label>
                              <input class="form-control" type="date" name="from_date" id="from_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputFile">To Date</label>
                              <input class="form-control" type="date" name="to_date" id="to_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputFile">Branch</label>
                            <select class="form-control select2bs4" name="branch_id" id="branch_id" style="width: 100%;">
                                <option value="">----Select Branch----</option>
                                <option value="all">All</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
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
                Walk In Appointment Reports
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-reports" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-success ">
                      <th style="width:5%!important;">SL</th>
                      <th>Name</th>
                      <th>Office</th>
                      <th>Branch</th>
                      <th>Address</th>
                      <th>Purpose</th>
                      <th>ID Number</th>
                      <th>Appointment Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach($appointmentData as $aptmentData)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$aptmentData->name}}<br>{{$aptmentData->contact_no}}</td>
                        <td>{{$aptmentData->firstName}} {{$aptmentData->lName}}</td>
                        <td>{{$aptmentData->branchName}}</td>
                        <td>{{$aptmentData->address}}</td>
                        <td>{{$aptmentData->purpose}}</td>
                        <td>{{$aptmentData->id_card_number}}</td>
                        <td>{{ date('j F Y g:i A', strtotime($aptmentData->date_time)) }}</td>
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
    // $('#all-reports').DataTable( {
    //     "info": true,
    //       "autoWidth": false,
    //       scrollX:'50vh',
    //       scrollY:'50vh',
    //     scrollCollapse: true,
    // } );

    $("button").click(function(){
        //var current = $(this).val();
        var department=$("#designation_name").val();
        console.log(department);
        //alert(current);
    });
} );

//   (function () {
//     var previous;

//     $("#designation_name").on('focus', function () {
//         // Store the current value on focus and on change
//         previous = this.value;
//     }).change(function() {
//         // Do something with the previous value after the change
//         alert(previous);

//         // Make sure the previous value is updated
//         previous = this.value;
//     });
// })();

// $("#designation_name").on('change', function(){
//     var current = $(this).val();
//     console.log("The value " + current);
// });

</script>
@endsection