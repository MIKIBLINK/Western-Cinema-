@extends('layouts.app')
@section('title', 'Booking Confirmed')

@section('content')
<style>
    .success-animation {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .success-icon {
        font-size: 5rem;
        animation: scaleIn 0.5s ease-out;
        display: inline-block;
    }
    
    @keyframes scaleIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .confirmation-header {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        padding: 2.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
        text-align: center;
    }
    
    .confirmation-header h4 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }
    
    .confirmation-subtitle {
        margin-top: 0.5rem;
        font-size: 1.1rem;
        opacity: 0.95;
    }
    
    .ticket-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        border: 2px dashed #e2e8f0;
        position: relative;
    }
    
    .ticket-container::before,
    .ticket-container::after {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        background: #f7fafc;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
    }
    
    .ticket-container::before {
        left: -15px;
    }
    
    .ticket-container::after {
        right: -15px;
    }
    
    .ticket-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
    }
    
    .ticket-header h5 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }
    
    .ticket-body {
        padding: 2rem;
    }
    
    .detail-row {
        display: flex;
        align-items: flex-start;
        padding: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        transition: background 0.3s ease;
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-row:hover {
        background: #f7fafc;
    }
    
    .detail-icon {
        font-size: 1.75rem;
        margin-right: 1rem;
        min-width: 40px;
        text-align: center;
    }
    
    .detail-content {
        flex: 1;
    }
    
    .detail-label {
        font-weight: 700;
        color: #667eea;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .detail-value {
        font-size: 1.1rem;
        color: #2d3748;
        font-weight: 600;
    }
    
    .seats-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .seat-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .total-section {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        padding: 1.5rem 2rem;
        margin: -2rem -2rem 0 -2rem;
        text-align: center;
    }
    
    .total-label {
        font-size: 1rem;
        opacity: 0.95;
        margin-bottom: 0.25rem;
    }
    
    .total-amount {
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-secondary-custom {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-secondary-custom:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }
    
    .info-note {
        background: #ebf8ff;
        border-left: 4px solid #4299e1;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-top: 2rem;
        color: #2c5282;
    }
    
    .info-note strong {
        color: #2c5282;
    }
    
    @media (max-width: 768px) {
        .confirmation-header h4 {
            font-size: 1.5rem;
        }
        
        .success-icon {
            font-size: 4rem;
        }
        
        .ticket-body {
            padding: 1.5rem;
        }
        
        .detail-row {
            padding: 1rem;
            flex-direction: column;
        }
        
        .detail-icon {
            margin-bottom: 0.5rem;
        }
        
        .total-amount {
            font-size: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-primary-custom,
        .btn-secondary-custom {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="success-animation">
    <div class="success-icon">🎉</div>
</div>

<div class="confirmation-header">
    <h4>
        <span>✅</span>
        <span>Booking Confirmed!</span>
    </h4>
    <p class="confirmation-subtitle">Your tickets have been successfully reserved</p>
</div>

<div class="ticket-container">
    <div class="ticket-header">
        <h5>🎟️ Your Cinema Ticket</h5>
    </div>
    
    <div class="ticket-body">
        <div class="detail-row">
            <div class="detail-icon">🎬</div>
            <div class="detail-content">
                <div class="detail-label">Movie</div>
                <div class="detail-value">{{ $booking->showtime->movie->title }}</div>
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-icon">🎭</div>
            <div class="detail-content">
                <div class="detail-label">Hall</div>
                <div class="detail-value">Hall {{ $booking->showtime->hall->name }}</div>
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-icon">📅</div>
            <div class="detail-content">
                <div class="detail-label">Date & Time</div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('l, F d, Y') }}
                </div>
                <div class="detail-value" style="color: #667eea; margin-top: 0.25rem;">
                    {{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}
                </div>
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-icon">💺</div>
            <div class="detail-content">
                <div class="detail-label">Your Seats</div>
                <div class="seats-list">
                    @foreach($booking->seats as $seat)
                        <span class="seat-badge">
                            🪑 {{ $seat->seat_row }}{{ $seat->seat_number }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="total-section">
            <div class="total-label">Total Amount Paid</div>
            <div class="total-amount">${{ number_format($booking->total_price, 2) }}</div>
        </div>
    </div>
</div>




<div class="info-note">
    <strong>📌 Important:</strong> Please arrive at least 15 minutes before showtime. Show this confirmation at the entrance to collect your tickets.
</div>

<div class="action-buttons">
    <a href="{{ route('user.movies.index') }}" class="btn-primary-custom">
        🎬 Browse More Movies
    </a>
    <a href="#" onclick="window.print(); return false;" class="btn-secondary-custom">
        🖨️ Print Ticket
    </a>
</div>

@endsection