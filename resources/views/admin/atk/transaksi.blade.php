@extends('layouts.admin')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-arrow-left-right text-primary me-2"></i> 
                Transaksi ATK
            </h3>
            <p class="text-muted small mb-0">Catatan masuk dan keluar barang alat tulis kantor.</p>
        </div>
        
        <div class="d-flex gap-2">
            <a href="{{ route('admin.atk') }}" 
               class="btn btn-light d-flex align-items-center gap-2 px-4 py-2"
               style="border-radius: 8px;">
                <i class="bi bi-box-seam"></i> 
                <span class="fw-medium">Kembali ke Master ATK</span>
            </a>

            <a href="{{ route('admin.atk.transaksi.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 shadow-sm"
               style="border-radius: 8px;">
                <i class="bi bi-plus-lg"></i> 
                <span class="fw-medium">Tambah Transaksi</span>
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="row mb-4">
        <div class="col-md-5 col-lg-4">
            <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0 text-muted px-3">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-1 py-2" placeholder="Cari nama barang atau no transaksi..." id="searchInput" style="font-size: 0.95rem;">
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" width="8%">No</th>
                            <th class="py-3">No Transaksi</th>
                            <th class="py-3">Nama Barang</th>
                            <th class="py-3">Tipe</th>
                            <th class="py-3 text-center">Qty</th>
                            <th class="py-3 text-end">Harga Satuan</th>
                            <th class="py-3 text-end">Total Harga</th>
                            <th class="py-3">Keterangan</th>
                            <th class="py-3 text-center pe-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.95rem;">
                        @foreach ($data as $item)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td><span class="fw-semibold">{{ $item->no_transaksi }}</span></td>
                            <td>{{ $item->masterAtk->nama_barang ?? '-' }}</td>
                            <td>
                                @if($item->tipe == 'masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @else
                                    <span class="badge bg-danger">Keluar</span>
                                @endif
                            </td>
                            <td class="text-center fw-medium">{{ $item->qty }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end fw-semibold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="text-muted text-truncate" style="max-width: 200px;">{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center text-muted">{{ $item->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            let text = row.textContent.toUpperCase();
            row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
        });
    });
</script>
@endsection