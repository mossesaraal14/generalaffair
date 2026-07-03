@extends('layouts.admin')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="bi bi-box-seam-fill text-primary me-2"></i> Data ATK</h3>
            <p class="text-muted small mb-0">Kelola persediaan alat tulis kantor secara real-time.</p>
        </div>
        <a href="{{ route('admin.atk.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 shadow-sm" style="border-radius: 8px;">
            <i class="bi bi-plus-lg"></i> 
            <span class="fw-medium">Tambah Barang</span>
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-5 col-lg-4">
            <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0 text-muted px-3">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-1 py-2" placeholder="Cari nama barang..." id="searchInput" style="font-size: 0.95rem;">
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
                            <th class="ps-4 py-3" width="6%">No</th>
                            <th class="py-3">Nama Barang</th>
                            <th class="py-3" width="10%">Satuan</th>
                            <th class="py-3 text-end" width="15%">Harga</th>
                            <th class="py-3 text-center" width="12%">Stok Awal</th>
                            <th class="py-3 text-center" width="12%">Stok Sekarang</th>
                            <th class="py-3" width="20%">Keterangan</th>
                            <th class="py-3 text-center pe-4" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.95rem;">
                        @foreach ($data as $atk)    
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $atk->nama_barang }}</span>
                            </td>
                            <td><span class="badge bg-light text-dark px-2.5 py-1.5 border">{{ $atk->satuan }}</span></td>
                            <td class="text-end fw-medium text-dark">Rp {{ number_format($atk->harga, 0, ',', '.') }}</td>
                            <td class="text-center text-muted">{{ $atk->stok_awal }}</td>
                            <td class="text-center text-muted">{{ $atk->stok_sekarang }}</td>
                            <td class="text-muted text-truncate" style="max-width: 180px;">{{ $atk->keterangan ?? '-' }}</td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.atk.edit', $atk->id) }}" class="btn btn-sm btn-outline-warning border-0 p-2" title="Ubah">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </a>
                                    <a href="{{ route('admin.atk.destroy', $atk->id) }}" class="btn btn-sm btn-outline-danger border-0 p-2" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash3 fs-5"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Fitur pencarian javascript bawaan
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