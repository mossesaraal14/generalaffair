@extends('layouts.admin')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Selamat Datang Kembali, Admin</h3>
            <p class="text-muted small mb-0">Berikut adalah ringkasan sistem IT Management Anda hari ini.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-2" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.5px;">IT Assets</span>
                            <h2 class="fw-bold text-dark my-2">248</h2>
                            <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i> Terdata aktif</span>
                        </div>
                        <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-pc-display-horizontal fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-2" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.5px;">IT Tickets</span>
                            <h2 class="fw-bold text-dark my-2">12</h2>
                            <span class="text-warning small fw-medium"><i class="bi bi-exclamation-circle"></i> Perlu tindakan</span>
                        </div>
                        <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-ticket-perforated-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-2" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.5px;">Stok ATK</span>
                            <h2 class="fw-bold text-dark my-2">87</h2>
                            <span class="text-secondary small fw-medium">Item tersedia</span>
                        </div>
                        <div class="p-3 bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-box-seam-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection