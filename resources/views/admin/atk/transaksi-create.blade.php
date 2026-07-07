@extends('layouts.admin')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.atk') }}" class="btn btn-light border p-2 me-3 d-flex align-items-center justify-content-center" style="border-radius: 8px; width: 40px; height: 40px;" title="Kembali">
            <i class="bi bi-arrow-left fs-5 text-secondary"></i>
        </a>
        <div>
            <h3 class="fw-bold text-dark mb-1">Tambah Barang ATK</h3>
            <p class="text-muted small mb-0">Input data inventaris alat tulis kantor yang baru ke dalam sistem.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.atk.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_barang" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">ID Transaksi</label>
                            <input type="text" class="form-control py-2.5 @error('id_transaksi') is-invalid @enderror" id="id_transaksi" name="id_transaksi" required value="ATK/{{ $month }}/{{ $year }}/{{ $urutan }}" style="border-radius: 8px;" readonly>
                            @error('id_transaksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Nama Barang</label>
                                <select class="form-select py-2.5 @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" required style="border-radius: 8px;">
                                    <option value="" selected disabled>Pilih Item...</option>
                                    @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tipe" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Tipe</label>
                                <select class="form-select py-2.5 @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required style="border-radius: 8px;">
                                    <option value="" selected disabled>Pilih Tipe...</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                                @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label for="qty" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Qty</label>
                                    <input type="number" class="form-control py-2.5 @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="0" min="0" required value="{{ old('qty') }}" style="border-radius: 8px;">
                                    <div class="form-text text-muted" style="font-size: 0.8rem;">*Stok sekarang otomatis menyamai stok awal saat pertama dibuat.</div>
                                    @error('qty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Keterangan <span class="text-muted fw-normal">(Opsional)</span></label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan catatan lokasi penyimpanan, spesifikasi tambahan, dll..." style="border-radius: 8px;">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.atk') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px;">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 8px;">
                                <i class="bi bi-cloud-arrow-up me-2"></i> Simpan Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection