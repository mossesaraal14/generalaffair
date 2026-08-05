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
            <h1>IT Tickets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">IT Tickets</li>
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
                <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <i class="icon fas fa-check"></i>
                        {{ session('success') }}
                    </div>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Ticket ID</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Get</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $ticket)
                  <tr>
                    <td>{{ $ticket->ticket_id }}</td>
                    <td>{{ User::findOrFail($ticket->user_id)->name }}</td>
                    <td>{{ $ticket->department }}</td>
                    <td>{{ ucfirst($ticket->description) }}</td>
                    <td>{{ ucfirst($ticket->created_at) }}</td>
                    <td>
                        @if ($ticket->status == 'open')
                            <span class="badge bg-primary">Open</span>
                        @elseif ($ticket->status == 'progress')
                            <span class="badge bg-warning">In Progress</span>
                        @elseif ($ticket->status == 'closed')
                            <span class="badge bg-success">Closed</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($ticket->status) }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                      <a href="{{ route('admin.tickets.destroy', $ticket->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure to delete this item?')" style="padding: 2px 6px; font-size: 12px;">
                        <i class="fas fa-trash"></i>
                      </a>
                      <!-- Button trigger modal -->
                      {{-- <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm btn-show" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-info"></i>
                      </a> --}}
                      <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm btn-show">
                        <i class="fas fa-info"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <a href="{{ route('admin.tickets.get.create', $ticket->id) }}" class="btn btn-success" style="padding: 2px 6px; font-size: 12px;"><i class="fas fa-user-check"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Ticket ID</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Get</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="close btn-close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="content">
            <table class="table table-sm table-borderless mb-0">
                <tr>
                    <th width="140">Ticket ID</th>
                    <td id="ticket_id"></td>
                </tr>
                <tr>
                    <th>User</th>
                    <td id="user_name"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td id="user_email"></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td id="department"></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td id="category"></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($ticket->status == 'open')
                            <span class="badge bg-primary" id="status">Open</span>
                        @elseif ($ticket->status == 'progress')
                            <span class="badge bg-warning" id="status">In Progress</span>
                        @elseif ($ticket->status == 'closed')
                            <span class="badge bg-success" id="status">Closed</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($ticket->status) }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td id="description"></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td id="created_at"></td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td id="updated_at"></td>
                </tr>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
