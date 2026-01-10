<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinema App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Favicon / Tab logo -->
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">


<style>
    body {
        min-height: 100vh;
        background: radial-gradient(circle at top, #1f2933, #0b0f1a 70%);
        color: #e5e7eb;
        font-family: "Segoe UI", system-ui, sans-serif;
    }

    /* Navbar */
    .navbar {
        background: rgba(10, 15, 30, 0.95) !important;
        border-bottom: 2px solid #e50914;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.6);
    }

    .navbar-brand {
        font-size: 1.6rem;
        font-weight: 700;
        color: #e50914 !important;
        letter-spacing: 1px;
        transition: opacity 0.3s ease;
    }

    .navbar-brand:hover {
        opacity: 0.85;
    }

    /* User badge */
    .user-badge {
        background: linear-gradient(135deg, #e50914, #b20710);
        color: #fff;
        padding: 0.45rem 1.2rem;
        border-radius: 30px;
        font-size: 0.9rem;
        box-shadow: 0 0 15px rgba(229, 9, 20, 0.6);
        white-space: nowrap;
    }

    /* Main container */
    .container {
        background: rgba(20, 24, 45, 0.95);
        border-radius: 18px;
        padding: 2.2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
        color: #f3f4f6;
    }

    /* Buttons (cinema style) */
    .btn-primary {
        background-color: #e50914;
        border: none;
        box-shadow: 0 0 12px rgba(229, 9, 20, 0.6);
    }

    .btn-primary:hover {
        background-color: #b20710;
        box-shadow: 0 0 20px rgba(229, 9, 20, 0.9);
    }

    /* Links */
    a {
        color: #fca5a5;
        text-decoration: none;
    }

    a:hover {
        color: #fecaca;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.3rem;
        }

        .container {
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .user-badge {
            font-size: 0.8rem;
            padding: 0.35rem 1rem;
        }
    }
</style>

</head>
<body>
    <nav class="px-4 py-3 navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route(name: 'user.movies.index') }}">
                <span class="me-2" style="color: rgb(0, 119, 255)">Western</span>
                <span>Cinema</span>
            </a>
            <div class="ms-auto">
                <span class="user-badge">
                    <i class="bi bi-person-circle me-2"></i>{{ auth()->user()->name }}
                </span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
