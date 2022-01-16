@extends('backend.master')

@section('title', 'All Forward Visitor List')
@section('dashboard-title', 'All Forward visitor List')
@section('breadcrumb-title', 'All Forward Visitor  Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection
@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="allvisitor" class="table table-bordered table-striped">
        <tr> 
          <th>Serial No</th> 
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Gender</th> 
          <th>Date & Time</th>
          <th>Status</th>
        </tr> 
        @foreach($forwardingVisitors as $forwardingVisitor)
        <tr> 
          <td>{{$loop->iteration}}</td> 
          <td>{{$forwardingVisitor->name}}</td>
          <td>{{$forwardingVisitor->email}}</td>
          <td>{{$forwardingVisitor->mobile}}</td>
          <td>{{$forwardingVisitor->gender}}</td>
          <td>{{$forwardingVisitor->created_at}}</td>
          <td>
             @if($forwardingVisitor->status==1)
              <button class="btn btn-info btn-xs">Forward by admin</button>
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
  
</script>
@endsection