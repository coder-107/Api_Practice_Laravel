<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <title>Admin Panel</title>

    <style>
        /* Custom styles can go here */
        .content-wrapper {
            margin-top: 50px;
            margin-left: 250px;
            padding: 15px;
            height: calc(100vh - 50px);
            overflow-y: auto;
        }

        .main-sidebar {
            height: 100vh;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0; /* Remove left margin on small screens */
            }

            .main-sidebar {
                position: fixed; /* Fix sidebar position */
                z-index: 100; /* Ensure it stays on top */
                transition: all 0.3s ease; /* Smooth transition for sidebar */
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        {{ Auth::user()->name }} <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/admin/dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">AdminLTE</span>
            </a>

            <!-- Sidebar Menu -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- Uncomment if you have a user profile picture -->
                        <!-- <img src="{{ Auth::user()->profile_picture }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}"> -->
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu Items -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}" class="nav-link active">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Manage User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>Manage Products</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>Manage Roles</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('blog.home') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>Manage Blogs</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

</body>

</html>
