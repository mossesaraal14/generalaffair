@php
    Use App\Models\User;
@endphp
@extends('layouts.adminlte')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin.tickets.get.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Ticket ID</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Problem Solving</th>
                    <th>Update</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $get)
                  <tr>
                    <td>{{ $get->tickets->ticket_id }}</td>
                    <td>{{ $get->tickets->user->name }}</td>
                    <td>{{ $get->tickets->department }}</td>
                    <td>{{ $get->tickets->description }}</td>
                    <td>{{ ucfirst($get->tickets->category) }}</td>
                    <td>
                        @if ($get->tickets->status == 'open')
                            <span class="badge bg-primary">Open</span>
                        @elseif ($get->tickets->status == 'progress')
                            <span class="badge bg-warning">In Progress</span>
                        @elseif ($get->tickets->status == 'closed')
                            <span class="badge bg-success">Closed</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($get->tickets->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $get->description ?? '-' }}</td>
                    <td><a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Ticket ID</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Problem Solving</th>
                    <th>Update</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
