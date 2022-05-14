@extends('backend.master')

@section('title', 'Print Reports')
@section('dashboard-title', 'Print Reports')
@section('breadcrumb-title', 'Print Reports Information')

@section('stylesheets')
    <style>
      @media print {
    #printPageButton {
      display: none;
    }
    #ddd{
      display: none;
    }
}
    </style>
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <input id ="printPageButton" type="button" value="Print" onclick="window.print();" >
              <h5 style="text-align:center">People's Republic of Bangladesh<br/>Office Of The Chief Electric Inspector<br/>Ministry Of Power Energy And Mineral Resources<br/>Electric Division</h5><p style="text-align:center">From Date:{{$from_dat}} To Date: {{$to_dat}}</p>
            </div>
            <!-- /.card-header -->
            <?php $total_rowData = 0;$total_rowdataEmployee=0;?>
            <div class="card-body">
              <table class="table table-bordered">
                @if(!empty($appointmentDataBranch))
                <thead>                  
                  <tr>
                    <th style="text-align:center;">Serial No</th>
                    <th style="text-align:center;">Branch Name</th>
                    <th style="text-align:center;">Total Visitor</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($appointmentDataBranch as $rowData)
                  <?php $total_rowData += $rowData->total;?>
                  <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td style="text-align:center;">{{$rowData->branchName}}</td>
                    <td style="text-align:right;">{{$rowData->total}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td style="border: none;"></td>
                    <td style=" font-weight: bold;text-align:right;">Total Visitor</td>
                    <td style=" font-weight: bold;text-align: right;">{{$total_rowData}}  /=</td>
                  </tr>
                  @else

                <thead>                  
                  <tr>
                    <th style="text-align:center;">Serial No</th>
                    <th style="text-align:center;">Employee Name</th>
                    <th style="text-align:center;">Total Visitor</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($appointmentDataEmployee as $rowDataEmp)
                  <?php $total_rowdataEmployee += $rowDataEmp->total;?>
                  <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td style="text-align:center;">{{$rowDataEmp->firstName}} {{$rowDataEmp->lastName}}</td>
                    <td style="text-align:right;">{{$rowDataEmp->total}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td style="border: none;"></td>
                    <td style=" font-weight: bold;text-align:right;">Total Visitor</td>
                    <td style=" font-weight: bold;text-align: right;">{{$total_rowdataEmployee}}  /=</td>
                  </tr>
                  @endif

                </tbody>
              </table>
            </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</section>
@endsection

@section('custom_script')
<script>

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