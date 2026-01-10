@extends('layouts.app')
@section('title', 'Showtimes - ' . $movie->title)

@section('content')
<style>
/* Back link */
.back-link {
    color: #ff3d00;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.back-link:hover {
    color: #ff6d3a;
    gap: 0.75rem;
}

/* Movie header */
.movie-header {
    background: radial-gradient(circle at top left, #ff416c, #ff4b2b);
    color: white;
    padding: 2rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    box-shadow: 0 12px 35px rgba(255, 65, 0, 0.4);
}

.movie-header h4 {
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

/* Showtime card */
.showtime-card {
    background: #1b1b1b;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
}

.showtime-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 50px rgba(255, 65, 0, 0.5);
}

/* Showtime info */
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
    color: #e0e0e0;
}

.info-label {
    font-weight: 700;
    color: #ff3d00;
}

/* Price tag */
.price-tag {
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: #1b1b1b;
    padding: 0.5rem 1rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 4px 15px rgba(250, 204, 21, 0.4);
}

/* Select Seats button */
.btn-select-seats {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(255, 65, 0, 0.5);
}

.btn-select-seats:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 30px rgba(255, 65, 0, 0.7);
    color: #fff;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #9ca3af;
    background: #121212;
    border-radius: 15px;
    margin-top: 2rem;
    box-shadow: inset 0 0 30px rgba(255, 65, 0, 0.15);
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .movie-header h4 {
        font-size: 1.5rem;
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
            <div class="flex-wrap gap-3 d-flex justify-content-between align-items-center">
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
            <a href="{{ route('user.movies.index') }}" class="mt-3 btn-select-seats">
                Browse Other Movies
            </a>
        </div>
    @endforelse
</div>
@endsection
