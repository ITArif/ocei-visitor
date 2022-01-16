@extends('backend.master')

@section('title', 'All Visitor List')
@section('dashboard-title', 'All visitor List')
@section('breadcrumb-title', 'All Visitor  Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <button class="btn btn-danger btn-sm float-sm-left" id="delete_all" style="margin:5px;"><i class="fa fa-trash"></i> Delete</button>&nbsp
      <button class="btn btn-info btn-sm float-sm-left" id="active_all" style="margin:5px;"><i class="fa fa-check"></i> forward <span class="badge badge-dark right">{{$count}}</span></button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="allvisitor" class="table table-bordered table-striped">
        <tr> 
         <th style="text-align: center;" colspan="4">Visitor Information</th> 
         <th style="text-align: center;" colspan="4">Employee Information</th> 
        </tr> 
        <tr> 
          <th>#</th> 
          <th>Name</th>
          <th>Phone</th>
          <th>Gender</th> 
          <th>Employee Name</th> 
          <th>Department</th> 
          <th>Designation</th> 
          <th>Status</th>
        </tr> 

        @foreach($visitors as $visitor)
          <input style="display: none;" type="text" name="visitorId[]" value="{{$visitor->id}}">
        <tr> 
          <td>
            <input type="checkbox" name="visitorId[]" value="{{$visitor->id}}">
          </td> 
          <td>{{$visitor->name}}</td>
          <td>{{$visitor->mobile}}</td>
          <td>{{$visitor->gender}}</td>
          <td><button class="btn btn-primary btn-xs">{{$visitor->employee_name}}</button></td> 
          <td><button class="btn btn-success btn-xs">{{$visitor->deptName}}</button></td>  
          <td><button class="btn btn-warning btn-xs">{{$visitor->desigName}}</button></td>
          <td>
             @if($visitor->status==1)
              <button class="btn btn-info btn-xs">Forward</button>
             @else
              <button class="btn btn-warning btn-xs">Not Forward</button>
             @endif
          </td> 
        </tr>
        @endforeach  
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

@section('custom_script')
<script>
  $(function () {
      ("#allBannerInfo").DataTable();
      // delete all selected question id
      $('#delete_all').click(function () {
          var ids = [];
          // get all selected user id
          $.each($("input[name='visitorId[]']:checked"), function(){
              ids.push($(this).val());
          });
          if (ids.length!==0) {
              var url = "{{ url('delete/all/visitors') }}";
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You want to delete?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Delete it!'
              }).then(function(result) {
                  if (result.value) {
                      $.ajax({
                          url: url,
                          type: 'POST',
                          data: {"visitorId": ids, "_token": "{{ csrf_token() }}"},
                          dataType: "json",
                          beforeSend:function () {
                              Swal.fire({
                                  title: 'Deleting Data.......',
                                  showConfirmButton: false,
                                  html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                  allowOutsideClick: false
                              });
                          },
                          success:function (response) {
                              Swal.close();
                              console.log(response);
                              if (response==="success"){
                                  Swal.fire({
                                      title: 'Successfully Deleted',
                                      type: 'success',
                                      confirmButtonColor: '#3085d6',
                                      confirmButtonText: 'Ok'
                                  }).then(function(result) {
                                      if (result.value) {
                                          window.location.reload();
                                      }
                                  });
                              }
                          },
                          error:function (error) {
                              Swal.close();
                              console.log(error);
                          }
                      })
                  }
              });
          }else{
              Swal.fire(
                  'Error',
                  'Select The Visitor First!',
                  'error'
              )
          }
      });
    });

   // activate all selected user id
  $('#active_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='visitorId[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('activate/all/visitors') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to foward?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Foward'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"visitorId": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Activating Visitors.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Foward',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Visitor First!',
              'error'
          )
      }
  });
</script>
@endsection