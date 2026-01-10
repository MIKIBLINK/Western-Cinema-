@extends('layouts.app')
@section('title', 'Movies - Now Showing')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .page-header h3 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .movie-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
    }
    
    .movie-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.3);
    }
    
    .movie-card .card-img-top {
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .movie-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .movie-card .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
    }
    
    .movie-card h5 {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
        min-height: 3rem;
    }
    
    .movie-card p {
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.6;
        flex-grow: 1;
        margin-bottom: 1rem;
    }
    
    .btn-view-showtimes {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.65rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    
    .btn-view-showtimes:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .page-header h3 {
            font-size: 1.5rem;
        }
        
        .movie-card .card-img-top {
            height: 300px;
        }
        
        .movie-card h5 {
            font-size: 1.1rem;
            min-height: auto;
        }
    }
</style>

<div class="page-header">
    <h3>
        <span>🎬</span>
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