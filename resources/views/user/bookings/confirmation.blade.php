@extends('layouts.app')
@section('title', 'Booking Confirmed')

@section('content')
<style>
/* Page container */
.page-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem 1rem;
    font-family: 'Poppins', sans-serif;
}

/* Success Animation */
.success-animation {
    text-align: center;
    margin-bottom: 2rem;
}

.success-icon {
    font-size: 5rem;
    color: #ef4444; /* red success */
    animation: popIn 0.6s ease-out;
    display: inline-block;
}

@keyframes popIn {
    0% { transform: scale(0); opacity: 0; }
    60% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}

/* Header */
.confirmation-header {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    padding: 2rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    text-align: center;
    box-shadow: 0 10px 25px rgba(220,38,38,0.35);
}

.confirmation-header h4 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
}

.confirmation-subtitle {
    margin-top: 0.5rem;
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Ticket Card */
.ticket-container {
    display: flex;
    max-width: 700px;
    margin: 0 auto 0rem;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(0,0,0,0.08);
    background: rgb(255, 255, 255);

}

/* Ticket Main & Stub */
.ticket-main {
    flex: 3;
    padding: 2rem;
    position: relative;
}

.ticket-stub {
    flex: 1;
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 2rem 1rem;
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%, 0 calc(100% - 30px), 100% calc(100% - 30px));
    font-weight: 700;
    font-size: 1.1rem;
}

/* Perforated edges */
.ticket-main::before,
.ticket-main::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}

.ticket-main::before { left: -10px; }
.ticket-main::after { right: -10px; }

/* Ticket Header */
.ticket-header {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    padding: 1.5rem;
    text-align: center;
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.ticket-header h5 {
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: 1px;
}

/* Detail Rows */
.detail-row {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.3s ease;
}

.detail-row:last-child { border-bottom: none; }
.detail-row:hover { background: #fef2f2; }

.detail-icon {
    font-size: 1.75rem;
    margin-right: 1rem;
    min-width: 40px;
    text-align: center;
    color: #dc2626;
}

.detail-content { flex: 1; }

.detail-label {
    font-weight: 700;
    color: #dc2626;
    font-size: 0.9rem;
    text-transform: uppercase;
    margin-bottom: 0.25rem;
}

.detail-value {
    font-size: 1.1rem;
    color: #1f2937;
    font-weight: 600;
}

/* Seats */
.seats-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.seat-badge {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    padding: 0.5rem 0.9rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9rem;
}

/* Total Section */
.total-section {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    padding: 1rem 2rem;
    text-align: center;
    border-radius: 0 0 10px 10px;

}

/* Action Buttons */
.action-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-primary-custom {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220,38,38,0.4);
}

.btn-secondary-custom {
    background: white;
    border: 2px solid #dc2626;
    color: #dc2626;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.btn-secondary-custom:hover {
    background: #dc2626;
    color: white;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {

    .ticket-container { flex-direction: column; }
    .ticket-stub { clip-path: none; width: 100%; padding: 1.5rem; }
    .detail-row { flex-direction: column; align-items: flex-start; padding: 0.75rem 0.5rem; }
    .seats-list { justify-content: flex-start; }
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
                <div class="detail-value" ">
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
