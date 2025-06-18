<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
        }
        
        .admin-sidebar {
            background: var(--primary-color);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .admin-nav-link {
            color: rgba(255,255,255,0.8);
            padding: 1rem 1.5rem;
            display: block;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .admin-nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .admin-nav-link.active {
            background: var(--secondary-color);
            color: white;
        }
        
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary-color);
        }
        
        .stat-label {
            color: #7f8c8d;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 px-0">
                <div class="admin-sidebar">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <nav>
                        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('admin.contacts') }}" class="admin-nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                            <i class="fas fa-envelope me-2"></i>Messages
                        </a>
                        <a href="{{ route('home') }}" class="admin-nav-link" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>View Site
                        </a>
                    </nav>
                </div>
            </div>
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
