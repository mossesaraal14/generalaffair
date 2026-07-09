<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center p-5">
                    <h1 class="display-4 fw-bold text-primary mb-4">
                        {{ Auth::id() }}
                    </h1>
                    <p class="text-muted mb-4">ID User yang sedang login</p>

                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger px-5 py-2">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>