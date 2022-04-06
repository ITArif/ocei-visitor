@extends('backend.master')

@section('title', 'All Visitor Walk In Appointment History')
@section('dashboard-title', 'All Visitor Walk In Appointment History')
@section('breadcrumb-title', 'All Visitor Walk In Appointment  History')

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
              <!-- <button class="btn btn-danger btn-sm float-sm-left" id="delete_all" style="margin:5px;"><i class="fa fa-trash"></i> Delete</button>&nbsp -->
             <button class="btn btn-success btn-sm float-sm-left" id="done_all" style="margin:5px;"><i class="fa fa-check"></i> Done?</button>&nbsp
             <button class="btn btn-warning btn-sm float-sm-left" id="pending_all" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> Pending?</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-walkinappointment-history" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-success">
                      <th>SL No</th>
                      <th>Id Card Number</th>
                      <th>Visitor Name & Phone</th>
                      <th>Purpose</th>
                      <th>Employee Name</th>
                      <th>Branch</th>
                      <th>Appointment Date</th>
                      <th>Start Date & Time</th>
                      <th>End Date & Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                   @foreach($walkInAppointmentHistory as $walkInAppointmentHistoryData)
                    <tr>
                    <td><input type="checkbox" name="walkinappointmentData_ids[]" value="{{$walkInAppointmentHistoryData->id}}"></td>
                    <td>{{$walkInAppointmentHistoryData->id_card_number}}</td>
                    <td>{{$walkInAppointmentHistoryData->name}} <br>{{$walkInAppointmentHistoryData->contact_no}}</td>
                    <td>{{$walkInAppointmentHistoryData->purpose}}</td>
                    <td>{{$walkInAppointmentHistoryData->firstName}} {{$walkInAppointmentHistoryData->lName}}</td>
                    <td>{{$walkInAppointmentHistoryData->branchName}}</td>
                    <td>{{ date('j F Y', strtotime($walkInAppointmentHistoryData->date_time)) }}</td>
                    <td>{{ date('j F Y g:i A', strtotime($walkInAppointmentHistoryData->created_at)) }}</td>
                    @if ($walkInAppointmentHistoryData->status==5)
                    <td></td>
                    @else
                    <td>{{ date('j F Y g:i A', strtotime($walkInAppointmentHistoryData->updated_at)) }}</td>
                    @endif

                      @if ($walkInAppointmentHistoryData->status==5)
                        <td>
                            <button class="btn btn-sm btn-success btn-xs">Ongoing</button>
                        </td>
                      @elseif($walkInAppointmentHistoryData->status==1)
                        <td>
                            <button class="btn btn-sm btn-warning btn-xs">Done</button>
                            <!-- <button class="btn btn-sm btn-warning btn-xs doneAppointment" id="{{$appointmentHistoryData->id}}">On Going</button> -->
                        </td>
                      @else
                      
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
    $('#all-walkinappointment-history').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
  } );

  // done all
  $('#done_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='walkinappointmentData_ids[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('walkin/appointment/done') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to done this appointment?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Done'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"walkinappointmentData_ids": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Done This Appointment.......',
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
                                  title: 'Successfully Done',
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
              'Select The Appointment First!',
              'error'
          )
      }
  });

  // pending all selected
  $('#pending_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='walkinappointmentData_ids[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('walkin/appointment/pending') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to Pending?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Pending'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"walkinappointmentData_ids": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Pending This Appointment.......',
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
                                  title: 'Successfully Pending',
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
              'Select The Appointment First!',
              'error'
          )
      }
  });

  // $(".doneAppointment").click(function () {
  //     var id=$(this).attr('id');
  //     //alert(id);
  //     var url="{{url('receptionists/done/ongoing-appointment')}}";
  //     $.ajax({
  //         url:url+"/"+id,
  //         type:"GET",
  //         dataType:"json",
  //         beforeSend:function () {
  //             Swal.fire({
  //                 title: 'Done the appointment data.....',
  //                 html:"<i class='fa fa-spinner fa-spin' style='font-size: 24px;'></i>",
  //                 confirmButtonColor: '#3085d6',
  //                 allowOutSideClick:false,
  //                 showCancelButton:false,
  //                 showConfirmButton:false
  //             });
  //         },
  //         success:function (response) {
  //             Swal.close();
  //             if(response==="success") {
  //                 Swal.fire({
  //                     title:'success',
  //                     text: 'You Have Successfully Done Appointment',
  //                     type:'success',
  //                     confirmButtonText: 'OK'
  //                 }).then(function(result){
  //                     if (result.value) {
  //                         window.location.reload();
  //                     }
  //                 });
  //             }
  //             //console.log(response)
  //         },
  //         error:function (error) {
  //             Swal.fire({
  //                 title: 'Error',
  //                 text:'Something Went Wrong',
  //                 type:'error',
  //                 showConfirmButton: true
  //             });
  //             //console.log(error);
  //         }
  //     })
  //   });

</script>
@endsection