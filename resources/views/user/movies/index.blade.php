@extends('layouts.app')
@section('title', 'Movies - Now Showing')

@section('content')
<style>
    .page-header {
        background: radial-gradient(circle at center, #e50914, #7a0a10);
        color: #fff;
        padding: 2.2rem;
        border-radius: 18px;
        margin-bottom: 2.5rem;
        box-shadow: 0 15px 40px rgba(229, 9, 20, 0.5);
    }

    .page-header h3 {
        font-size: 2.1rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .movie-card {
        background: #0f172a;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.7);
    }

    .movie-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 60px rgba(229, 9, 20, 0.4);
    }

    .movie-card .card-img-top {
        height: 420px;
        object-fit: cover;
        filter: brightness(0.95);
        transition: filter 0.3s ease, transform 0.3s ease;
    }

    .movie-card:hover .card-img-top {
        filter: brightness(1.05);
        transform: scale(1.05);
    }

    .movie-card .card-body {
        padding: 1.4rem;
        display: flex;
        flex-direction: column;
        background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0.3));
    }

    .movie-card h5 {
        color: #f9fafb;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.6rem;
    }

    .movie-card p {
        color: #d1d5db;
        font-size: 0.9rem;
        line-height: 1.6;
        flex-grow: 1;
    }

    .btn-view-showtimes {
        margin-top: 1rem;
        background: #e50914;
        color: #fff;
        padding: 0.65rem 1.1rem;
        border-radius: 10px;
        font-weight: 600;
        text-align: center;
        box-shadow: 0 0 18px rgba(229, 9, 20, 0.6);
        transition: all 0.3s ease;
    }

    .btn-view-showtimes:hover {
        background: #b20710;
        box-shadow: 0 0 28px rgba(229, 9, 20, 0.9);
        color: #fff;
    }

    .empty-state {
        background: #020617;
        border-radius: 18px;
        padding: 4rem 2rem;
        color: #9ca3af;
        text-align: center;
        box-shadow: inset 0 0 40px rgba(229, 9, 20, 0.2);
    }

    .empty-state-icon {
        font-size: 4.2rem;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        color: #f9fafb;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .page-header h3 {
            font-size: 1.6rem;
        }

        .movie-card .card-img-top {
            height: 300px;
        }
    }
</style>


<div class="page-header">
    <h3>
        <span></span>
        <span>Now Showing</span>
    </h3>
</div>

<div class="row g-4">
    @forelse($movies as $movie)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card movie-card">
                <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $movie->title }}</h5>
                    <p class="card-text">{{ Str::limit($movie->description, 80) }}</p>


                        <a href="{{ route('user.showtimes.index', $movie->id) }}" class="btn-view-showtimes">
                            View Showtimes →
                    </a>
                </div>
            </div>

        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-state-icon">🎭</div>
                <h4>No Movies Currently Showing</h4>
                <p>Check back soon for upcoming releases!</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
