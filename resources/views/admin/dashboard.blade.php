<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <title>Western Cinema| Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Cinema Management Dashboard" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --cinema-black: #050505;
            --cinema-card: #111111;
            --cinema-red: #e50914;
            --cinema-blue: #007bff;
            --cinema-text: #e2e8f0;
        }

        body {
            background-color: var(--cinema-black) !important;
            color: var(--cinema-text) !important;
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar Styling */
        .startbar {
            background: var(--cinema-black) !important;
            border-right: 1px solid rgba(0, 123, 255, 0.2) !important;
        }

        .startbar .nav-link {
            color: #94a3b8 !important;
            margin: 2px 10px;
            transition: all 0.3s ease;
        }

        .startbar .nav-link:hover {
            color: #fff !important;
            background: rgba(229, 9, 20, 0.1) !important;
        }

        .startbar .nav-link.active {
            color: #fff !important;
            background: linear-gradient(90deg, rgba(0, 123, 255, 0.2) 0%, transparent 100%) !important;
            box-shadow: inset 4px 0 0 var(--cinema-blue);
        }

        .startbar .menu-icon {
            color: var(--cinema-red) !important;
        }

        /* Topbar Styling */
        .topbar {
            background: rgba(5, 5, 5, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--cinema-red) !important;
        }

        /* Card & UI Elements */
        .card {
            background: var(--cinema-card) !important;
            border: 1px solid #222 !important;
        }

        .btn-primary {
            background: var(--cinema-red) !important;
            border: none !important;
            box-shadow: 0 0 15px rgba(229, 9, 20, 0.3);
        }

        .table thead th {
            background-color: #001a33 !important;
            color: var(--cinema-blue) !important;
        }

        /* Status Pulse */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.3; }
            100% { opacity: 1; }
        }
        .live-dot {
            color: var(--cinema-red);
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body>

    <div class="topbar d-print-none">
        <div class="container-xxl">
            <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
                <ul class="mb-0 topbar-item list-unstyled d-inline-flex align-items-center">
                    <li>
                        <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                            <i class="iconoir-menu-scale"></i>
                        </button>
                    </li>
                    <li class="mx-3 welcome-text">
                        <h3 class="mb-0 text-white fw-bold">
                            <span class="live-dot">●</span> Western Cinema<span style="color: var(--cinema-blue);">CONTROL</span>
                        </h3>
                    </li>
                </ul>

                <ul class="mb-0 topbar-item list-unstyled d-inline-flex align-items-center">
                    <li class="topbar-item">
                        <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                            <i class="icofont-moon dark-mode"></i>
                            <i class="icofont-sun light-mode"></i>
                        </a>
                    </li>

                    <li class="dropdown topbar-item">
                        <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button">
                            <img src="{{ asset('images/logo.png') }}" alt="" class="thumb-lg rounded-circle">
                        </a>
                        <div class="py-0 dropdown-menu dropdown-menu-end">
                            <div class="py-2 d-flex align-items-center dropdown-item bg-secondary-subtle">
                                <div class="flex-grow-1 ms-2 text-truncate">
                                    <h6 class="my-0 fw-medium text-dark fs-13">William Martin</h6>
                                    <small class="mb-0 text-muted">Administrator</small>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="align-text-bottom las la-power-off fs-18 me-1"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="startbar d-print-none">
        <div class="px-4 py-4 mb-2 brand">
            <div style="border: 1px solid var(--cinema-red); padding: 10px; background: rgba(229,9,20,0.05); text-align: center;">
                <h4 class="mb-0 fw-bold" style="letter-spacing: 2px;">
                    <span style="color: #fff;">CINEMA</span><span style="color: var(--cinema-blue);">WESTERN</span>
                </h4>
            </div>
        </div>

        <div class="startbar-menu">
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <ul class="navbar-nav w-100">
    <li class="px-4 mb-2 menu-label small text-muted">OPERATIONS</li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/movies*') ? 'active' : '' }}" href="{{route('admin.movies.index')}}">
            <i class="iconoir-media-video menu-icon"></i> <span>Movies</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/halls*') ? 'active' : '' }}" href="{{route('admin.halls.index')}}">
            <i class="iconoir-learning menu-icon"></i> <span>Theater Halls</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/showtimes*') ? 'active' : '' }}" href="{{route('admin.showtimes.index')}}">
            <i class="iconoir-alarm menu-icon"></i> <span>Showtimes</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/seats*') ? 'active' : '' }}" href="{{route('admin.seats.index')}}">
            <i class="iconoir-multiple-pages menu-icon" style="color: var(--cinema-blue) !important;"></i>
            <span class="fw-bold" style="color: var(--cinema-blue);">Seat Map</span>
        </a>
    </li>

    <li class="px-4 mt-3 mb-2 menu-label small text-muted">SALES & DATA</li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}" href="{{route('admin.bookings.index')}}">
            <i class="iconoir-report-columns menu-icon"></i> <span>Bookings</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/payments*') ? 'active' : '' }}" href="{{route('admin.payments.index')}}">
            <i class="iconoir-wallet menu-icon"></i> <span>Payments</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{route('admin.users.index')}}">
            <i class="iconoir-user-group menu-icon"></i> <span>Customers</span>
        </a>
    </li>
</ul>

                <div class="mt-5 text-center update-msg">
                    <p class="mb-3 text-muted">System Status: <span class="text-success">Online</span></p>
                    <a href="/" class="btn btn-outline-primary btn-sm">View Site</a>
                </div>
            </div>
        </div>
    </div>
    <div class="startbar-overlay d-print-none"></div>

    <div class="page-wrapper">
        <div class="page-content">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/app.js')}}"></script>
</body>
</html>
