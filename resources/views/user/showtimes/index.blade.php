@extends('layouts.app')
@section('title', 'Showtimes - ' . $movie->title)

@section('content')
<style>
    .back-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .back-link:hover {
        color: #764ba2;
        gap: 0.75rem;
    }
    
    .movie-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .movie-header h4 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .showtime-card {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        background: white;
    }
    
    .showtime-card:hover {
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        transform: translateX(5px);
    }
    
    .showtime-info {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        color: #2d3748;
    }
    
    .info-icon {
        font-size: 1.25rem;
    }
    
    .info-label {
        font-weight: 600;
        color: #667eea;
    }
    
    .price-tag {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .btn-select-seats {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-select-seats:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(72, 187, 120, 0.4);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
        background: #f7fafc;
        border-radius: 12px;
        margin-top: 2rem;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    .showtimes-container {
        margin-top: 1rem;
    }
    
    @media (max-width: 768px) {
        .movie-header h4 {
            font-size: 1.35rem;
        }
        
        .showtime-card {
            padding: 1.25rem;
        }
        
        .showtime-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .btn-select-seats {
            width: 100%;
            text-align: center;
            margin-top: 1rem;
        }
    }
</style>

<a href="{{ route('user.movies.index') }}" class="back-link">
    ← Back to Movies
</a>

<div class="movie-header">
    <h4>
        <span>🎬</span>
        <span>{{ $movie->title }} — Showtimes</span>
    </h4>
</div>

<div class="showtimes-container">
    @forelse($showtimes as $showtime)
        <div class="showtime-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="showtime-info">
                    <div class="info-item">
                        <span class="info-icon">🎭</span>
                        <span><span class="info-label">Hall </span>{{$showtime->hall->name}}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">📅</span>
                        <span>{{ \Carbon\Carbon::parse($showtime->start_time)->format('M d, Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">🕐</span>
                        <span>{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                    </div>
                    <div class="price-tag">
                        ${{ number_format($showtime->price, 2) }}
                    </div>
                </div>
                <a href="{{ route('user.seats.index', $showtime->id) }}" class="btn-select-seats">
                    Select Seats →
                </a>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-icon">🎟️</div>
            <h4>No Showtimes Available</h4>
            <p>There are currently no showtimes scheduled for this movie.</p>
            <a href="{{ route('user.movies.index') }}" class="btn-select-seats mt-3">
                Browse Other Movies
            </a>
        </div>
    @endforelse
</div>
@endsection