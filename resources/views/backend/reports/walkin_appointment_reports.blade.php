@extends('backend.master')

@section('title', 'All WalkIn Appointment Reports')
@section('dashboard-title', 'All WalkIn Appointment Reports')
@section('breadcrumb-title', 'All WalkIn Appointment Reports Information')

@section('stylesheets')
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
              <form action="{{route('walkAppointmentPrintReport')}}" method="get">
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
                                <option value="branch_wise">Branch Wise</option>
                                <option value="employee_wise">Employee Wise</option>
                                <!-- @foreach($branchs as $branch)
                                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                                @endforeach -->
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

</script>
@endsection