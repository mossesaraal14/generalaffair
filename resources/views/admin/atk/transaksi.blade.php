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
                <h3 class="card-title">Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Barang</th>
                    {{-- <th>User</th> --}}
                    <th>Tipe</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $transaksi)
                  <tr>
                    <td>{{ $transaksi->id_transaksi }}</td>
                    <td>{{ $transaksi->masterAtk->nama_barang }}</td>
                    {{-- <td>{{ $transaksi->user->email }}</td> --}}
                    <td>{{ $transaksi->tipe }}</td>
                    <td>{{ $transaksi->qty }}</td>
                    <td>{{ $transaksi->masterAtk->harga }}</td>
                    <td>{{ $transaksi->total_harga }}</td>
                    <td>{{ $transaksi->keterangan ?? '-' }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Barang</th>
                    {{-- <th>User</th> --}}
                    <th>Tipe</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Keterangan</th>
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