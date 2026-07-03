<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Management - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Sidebar Modern Styling */
        .sidebar {
            min-height: 100vh;
            background: #1e2229; /* Warna slate dark yang lebih modern dibanding hitam pekat */
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        
        .sidebar-brand {
            letter-spacing: 0.5px;
        }

        .nav-container {
            padding: 0 14px; /* Memberikan ruang agar menu tidak menempel ke tepi */
        }

        .nav-link {
            color: #94a3b8; /* Warna abu-abu lembut (slate-400) */
            padding: 12px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 8px; /* Sudut melengkung modern */
            margin-bottom: 4px;
            transition: all 0.2s ease-in-out;
        }

        /* Efek Hover */
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #f8fafc;
            transform: translateX(4px); /* Efek geser halus saat di-hover */
        }

        /* Menu Aktif */
        .nav-link.active {
            background: #3b82f6; /* Warna accent biru modern */
            color: white !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); /* Efek glow tipis */
        }

        .nav-link i {
            font-size: 1.1rem;
            transition: transform 0.2s;
        }

        .nav-link:hover i {
            transform: scale(1.1); /* Ikon sedikit membesar saat di-hover */
        }

        /* Main Content Background */
        .main-content {
            background: #f8fafc;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar text-white" style="width: 260px;">
            <div class="p-4 mb-3 d-flex flex-column border-bottom border-secondary border-opacity-10">
                <h4 class="mb-0 fw-bold sidebar-brand d-flex align-items-center gap-2">
                    <i class="bi bi-laptop-fill text-primary"></i> General Affair
                </h4>
                <small class="text-muted mt-1 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 1px;">Admin Panel</small>
            </div>
            
            <div class="nav-container">
                <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
                </a>
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-pc-display-horizontal me-3"></i> IT Assets
                </a>
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-ticket-perforated-fill me-3"></i> IT Tickets
                </a>
                <a href="{{ route('admin.atk') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.atk') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill me-3"></i> ATK
                </a>
            </div>
        </div>

        <div class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
                <div class="container-fluid">
                    <h5 class="mb-0 fw-semibold">Admin Dashboard</h5>
                    
                    <div class="d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-gear me-2"></i> Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider opacity-50"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="main-content p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>