<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinema App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95) !important;
            border-bottom: 3px solid #667eea;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea !important;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .user-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.95rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem !important;
            }
            
            .navbar-brand {
                font-size: 1.25rem;
            }
            
            .user-badge {
                font-size: 0.85rem;
                padding: 0.4rem 1rem;
            }
            
            .container {
                padding: 1.5rem;
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('user.movies.index') }}">
                <span class="me-2">🎬</span>
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