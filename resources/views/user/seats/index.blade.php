@extends('layouts.app')

@section('content')
<style>
    .page-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .showtime-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        text-align: center;
    }

    .showtime-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .showtime-info {
        margin-top: 0.75rem;
        font-size: 1rem;
        opacity: 0.95;
    }

    .legend {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
        padding: 1.25rem;
        background: #f7fafc;
        border-radius: 12px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .legend-box {
        width: 30px;
        height: 30px;
        border-radius: 6px;
        border: 2px solid;
    }

    .legend-available {
        background: white;
        border-color: #e2e8f0;
    }

    .legend-selected {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border-color: #48bb78;
    }

    .legend-booked {
        background: #cbd5e0;
        border-color: #cbd5e0;
    }

    .screen-container {
        text-align: center;
        margin-bottom: 3rem;
    }

    .screen {
        background: linear-gradient(to bottom, #2d3748 0%, #4a5568 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px 8px 50% 50%;
        margin: 0 auto 2rem;
        max-width: 600px;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 3px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .seats-container {
        background: #f7fafc;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .seat-row-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        gap: 10px;
    }

    .row-label {
        min-width: 50px;
        font-weight: 700;
        color: #667eea;
        font-size: 1.1rem;
        text-align: center;
        background: white;
        padding: 0.5rem;
        border-radius: 8px;
        border: 2px solid #e2e8f0;
    }

    .seats-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .seat-wrapper {
        position: relative;
    }

    .seat-checkbox {
        display: none;
    }

    .seat-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem 0.75rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        border: 2px solid #e2e8f0;
        font-weight: 600;
        font-size: 0.9rem;
        color: #2d3748;
        min-width: 55px;
        min-height: 60px;
        position: relative;
    }

    .seat-label::before {
        content: '💺';
        font-size: 1.3rem;
        margin-bottom: 0.25rem;
    }

    .seat-label:hover:not(.disabled) {
        transform: translateY(-3px);
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        background: #f0f4ff;
    }

    .seat-checkbox:checked + .seat-label {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        border-color: #48bb78;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.4);
    }

    .seat-checkbox:checked + .seat-label::before {
        content: '✓';
        font-size: 1.5rem;
    }

    .seat-label.disabled {
        background: #cbd5e0;
        color: #a0aec0;
        border-color: #cbd5e0;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .seat-label.disabled::before {
        content: '🚫';
    }

    .booking-summary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        text-align: center;
    }

    .summary-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .summary-details {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .summary-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .summary-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .summary-value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .btn-confirm {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border: none;
        color: white;
        padding: 1.25rem 3rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: block;
        margin: 0 auto;
        max-width: 400px;
        width: 100%;
        cursor: pointer;
    }

    .btn-confirm:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(72, 187, 120, 0.4);
        background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    }.action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-reserve {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-reserve:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-reserve:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-pay {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border: none;
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-pay:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(72, 187, 120, 0.4);
        color: white;
    }

    .btn-pay:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }


    @media (max-width: 768px) {
        .page-container {
            padding: 1rem 0.5rem;
        }

        .showtime-header {
            padding: 1.5rem;
        }

        .showtime-header h3 {
            font-size: 1.2rem;
        }

        .showtime-info {
            font-size: 0.9rem;
        }

        .seats-container {
            padding: 1rem;
        }

        .seat-row-container {
            flex-direction: column;
            gap: 0.5rem;
        }

        .row-label {
            min-width: 100%;
        }

        .seat-label {
            min-width: 48px;
            min-height: 55px;
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }

        .seat-label::before {
            font-size: 1.1rem;
        }

        .seats-row {
            gap: 6px;
        }

        .legend {
            gap: 1rem;
        }

        .summary-details {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>

<div class="page-container">
    <div class="showtime-header">
        <h3>🎟️ Select Seats</h3>
        <div class="showtime-info">
            <strong>{{ $showtime->movie->title }}</strong> | 
            Hall: {{ $showtime->hall->name }} | 
            {{ \Carbon\Carbon::parse($showtime->start_time)->format('M d, Y - h:i A') }}
        </div>
    </div>

    <div class="legend">
        <div class="legend-item">
            <div class="legend-box legend-available"></div>
            <span>Available</span>
        </div>
        <div class="legend-item">
            <div class="legend-box legend-selected"></div>
            <span>Selected</span>
        </div>
        <div class="legend-item">
            <div class="legend-box legend-booked"></div>
            <span>Booked</span>
        </div>
    </div>

    <div class="screen-container">
        <div class="screen">🎬 SCREEN 🎬</div>
    </div>

    <form method="POST" action="{{ route('user.bookings.store') }}" id="bookingForm">
        @csrf
        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

        <div class="seats-container">
            @php
                $currentRow = null;
            @endphp

            @foreach ($seats as $seat)
                @if ($currentRow !== $seat->seat_row)
                    @if ($currentRow !== null)
                            </div>
                        </div>
                    @endif
                    
                    <div class="seat-row-container">
                        <div class="row-label">Row {{ $seat->seat_row }}</div>
                        <div class="seats-row">
                    
                    @php
                        $currentRow = $seat->seat_row;
                    @endphp
                @endif

                @php
                    $isBooked = in_array($seat->id, $bookedSeatIds);
                @endphp

                <div class="seat-wrapper">
                    <input 
                        type="checkbox" 
                        name="seat_ids[]" 
                        value="{{ $seat->id }}"
                        id="seat-{{ $seat->id }}"
                        class="seat-checkbox"
                        data-seat="{{ $seat->seat_row }}{{ $seat->seat_number }}"
                        data-price="{{ $showtime->price }}"
                        {{ $isBooked ? 'disabled' : '' }}>
                    <label 
                        for="seat-{{ $seat->id }}" 
                        class="seat-label {{ $isBooked ? 'disabled' : '' }}">
                        {{ $seat->seat_number }}
                    </label>
                </div>
            @endforeach

            {{-- Close last row --}}
            @if ($currentRow !== null)
                    </div>
                </div>
            @endif
        </div>

        <div class="booking-summary" id="bookingSummary" style="display: none;">
            <div class="summary-title">📋 Booking Summary</div>
            <div class="summary-details">
                <div class="summary-item">
                    <span class="summary-label">Selected Seats</span>
                    <span class="summary-value" id="selectedSeatsText">0</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Amount</span>
                    <span class="summary-value">$<span id="totalPrice">0.00</span></span>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button type="submit" name="action" value="reserve" class="btn-reserve" id="reserveBtn">
                <span>🎫</span>
                Reserve
            </button>
            <button type="submit" name="action" value="pay" class="btn-pay" id="payBtn">
                <span>💳</span>
                Pay Now
            </button>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.seat-checkbox:not([disabled])');
        const confirmBtn = document.getElementById('confirmBtn');
        const bookingSummary = document.getElementById('bookingSummary');
        const selectedSeatsText = document.getElementById('selectedSeatsText');
        const totalPriceText = document.getElementById('totalPrice');
        const seatPrice = {{ $showtime->price }};

        function updateBookingSummary() {
            const selectedSeats = Array.from(checkboxes).filter(cb => cb.checked);
            const seatCount = selectedSeats.length;

            if (seatCount > 0) {
                const seatNames = selectedSeats.map(cb => cb.dataset.seat).join(', ');
                const total = (seatPrice * seatCount).toFixed(2);

                selectedSeatsText.textContent = seatNames;
                totalPriceText.textContent = total;
                bookingSummary.style.display = 'block';
                confirmBtn.disabled = false;
            } else {
                bookingSummary.style.display = 'none';
                confirmBtn.disabled = true;
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBookingSummary);
        });
    });
</script>

@endsection