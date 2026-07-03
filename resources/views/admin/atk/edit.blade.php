@extends('layouts.admin')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.atk') }}" class="btn btn-light border p-2 me-3 d-flex align-items-center justify-content-center" style="border-radius: 8px; width: 40px; height: 40px;" title="Kembali">
            <i class="bi bi-arrow-left fs-5 text-secondary"></i>
        </a>
        <div>
            <h3 class="fw-bold text-dark mb-1">Edit Barang ATK</h3>
            <p class="text-muted small mb-0">Ubah data inventaris alat tulis kantor.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.atk.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_barang" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Nama Barang</label>
                            <input type="text" class="form-control py-2.5 @error('nama_barang') is-invalid @enderror" 
                                   id="nama_barang" name="nama_barang" 
                                   value="{{ old('nama_barang', $data->nama_barang) }}" 
                                   placeholder="Contoh: Kertas A4 PaperOne 80gr" required style="border-radius: 8px;">
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="satuan" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Satuan Barang</label>
                                <select class="form-select py-2.5 @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required style="border-radius: 8px;">
                                    <option value="Rim" {{ old('satuan', $data->satuan) == 'Rim' ? 'selected' : '' }}>Rim</option>
                                    <option value="Box" {{ old('satuan', $data->satuan) == 'Box' ? 'selected' : '' }}>Box</option>
                                    <option value="Pack" {{ old('satuan', $data->satuan) == 'Pack' ? 'selected' : '' }}>Pack</option>
                                    <option value="Pcs" {{ old('satuan', $data->satuan) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                    <option value="Lusin" {{ old('satuan', $data->satuan) == 'Lusin' ? 'selected' : '' }}>Lusin</option>
                                </select>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="harga" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Harga Satuan</label>
                                <div class="input-group" style="border-radius: 8px; overflow: hidden;">
                                    <span class="input-group-text bg-light text-muted border-end-0">Rp</span>
                                    <input type="number" class="form-control border-start-0 py-2.5 @error('harga') is-invalid @enderror" 
                                           id="harga" name="harga" 
                                           value="{{ old('harga', $data->harga) }}" 
                                           placeholder="0" min="0" required>
                                </div>
                                @error('harga')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="stok_awal" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Stok Awal</label>
                                <input type="number" class="form-control py-2.5 @error('stok_awal') is-invalid @enderror" 
                                       id="stok_awal" name="stok_awal" 
                                       value="{{ old('stok_awal', $data->stok_awal) }}" 
                                       placeholder="0" min="0" required style="border-radius: 8px;">
                                @error('stok_awal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Keterangan <span class="text-muted fw-normal">(Opsional)</span></label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" style="border-radius: 8px;">{{ old('keterangan', $data->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.atk') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px;">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 8px;">
                                <i class="bi bi-cloud-arrow-up me-2"></i> Update Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection