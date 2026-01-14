@extends('layouts.app')
@section('title', 'Booking Confirmed')

@section('content')
<style>
    /* Layout & Fonts */
    .page-container { max-width: 850px; margin: 3rem auto; font-family: 'Poppins', sans-serif; padding: 0 15px; }

    /* Ticket Structure */
    .ticket {
        display: flex;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        border: 1px solid #eee;
    }

    .ticket-left { flex: 2; padding: 40px; }

    /* Right Branding Side */
    .ticket-right {
        flex: 1;
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        padding: 20px;
        border-left: 2px dashed rgba(255,255,255,0.3);
        text-align: center;
    }

    /* QR Code Display */
    .qr-container {
        background: white;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .qr-container img { display: block; width: 150px; height: 150px; border: none; }

    /* Typography */
    .detail-label { color: #dc2626; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 2px; letter-spacing: 0.5px; }
    .detail-value { font-size: 1.15rem; font-weight: 600; color: #07469e; margin-bottom: 18px; }

    .seat-badge {
        background: #fee2e2;
        color: #dc2626;
        padding: 5px 12px;
        border-radius: 6px;
        font-weight: 700;
        margin-right: 6px;
        font-size: 0.9rem;
    }

    /* Action Buttons */
    .btn-print {
        background: #dc2626;
        color: white;
        border: none;
        padding: 14px 35px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .btn-print:hover { transform: translateY(-2px); background: #b91c1c; }

    /* Responsive Design */
    @media (max-width: 768px) {
        .ticket { flex-direction: column; }
        .ticket-right { border-left: none; border-top: 2px dashed #ddd; padding: 40px 20px; }
    }
</style>

<div class="page-container">
    <div class="mb-4 text-center">
        <h1 style="color: #059669; font-weight: 800;">🎉 Booking Confirmed!</h1>
        <p class="" style="color: rgb(255, 143, 68)">Show this QR code at the cinema entrance.</p>
    </div>

    <div class="ticket">
        <div class="ticket-left">
            <div class="detail-label">Movie Title</div>
            <div class="detail-value">{{ $booking->showtime->movie->title }}</div>

            <div class="d-flex" style="gap: 50px;">
                <div>
                    <div class="detail-label">Date</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('M d, Y') }}</div>
                </div>
                <div>
                    <div class="detail-label">Time</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}</div>
                </div>
            </div>

            <div class="detail-label">Hall / Theater</div>
            <div class="detail-value">{{ $booking->showtime->hall->name }}</div>

            <div class="detail-label">Confirmed Seats</div>
            <div class="mt-2">
                @foreach($booking->seats as $seat)
                    <span class="seat-badge">{{ $seat->seat_row }}{{ $seat->seat_number }}</span>
                @endforeach
            </div>
        </div>

        <div class="ticket-right">
            @php
                $adminUrl = route('admin.bookings.index', ['search' => $booking->id]);
                $encodedUrl = urlencode($adminUrl);
                // Reliable external API for QR generation
                $qrCodeApi = "https://quickchart.io/qr?text={$encodedUrl}&size=150&centerImageUrl=https://img.icons8.com/ios-filled/50/000000/movie-projector.png";
            @endphp

            <div class="qr-container">
                <img src="{{ $qrCodeApi }}"
                     alt="Booking QR"
                     onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $encodedUrl }}'">
            </div>

            <div style="font-weight: 800; letter-spacing: 1.5px; font-size: 0.9rem;">SCAN TO CHECK-IN</div>
            <div style="opacity: 0.8; font-size: 0.8rem; margin-top: 5px;">Booking ID: #{{ $booking->id }}</div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <button onclick="window.print()" class="btn-print">
            🖨️ Print Ticket / Save PDF
        </button>
        <div class="mt-3" style="color: navy">
            <a href="{{ route('user.movies.index') }}" class="text-decoration-none" style="color: #2c5dff;">Return to Movies</a>
        </div>
    </div>
</div>
@endsection
