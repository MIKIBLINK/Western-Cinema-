@extends('layouts.app')

@section('content')
<style>
/* Seats container */
.seats-container {
    background: #fff5f5; /* light red background */
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

/* Seat rows */
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
    color: #dc2626; /* red text */
    font-size: 1rem;
    text-align: center;
    background: white;
    padding: 0.5rem;
    border-radius: 8px;
    border: 2px solid #fca5a5; /* light red border */
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

/* Seat label */
.seat-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0.9rem 0.7rem;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
    border: 2px solid #fca5a5; /* light red */
    font-weight: 600;
    font-size: 0.9rem;
    color: #dc2626; /* red text */
    min-width: 55px;
    min-height: 60px;
    position: relative;
}

.seat-label::before {
    content: '💺';
    font-size: 1.2rem;
    margin-bottom: 0.25rem;
}

.seat-label:hover:not(.disabled) {
    transform: translateY(-3px);
    border-color: #dc2626;
    box-shadow: 0 4px 12px rgba(220,38,38,0.3);
    background: #fee2e2; /* light red hover */
}

/* Selected seat */
.seat-checkbox:checked + .seat-label {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    border-color: #b91c1c; /* dark red */
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(220,38,38,0.5);
}

.seat-checkbox:checked + .seat-label::before {
    content: '✓';
    font-size: 1.4rem;
}

/* Booked seat */
.seat-label.disabled {
    background: #fca5a5; /* booked pinkish red */
    color: #7f1d1d;
    border-color: #fca5a5;
    cursor: not-allowed;
    opacity: 0.7;
}

.seat-label.disabled::before {
    content: '🚫';
}

/* Booking summary */
.booking-summary {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    padding: 1.5rem 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    box-shadow: 0 8px 25px rgba(220,38,38,0.3);
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

/* Action buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-reserve {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    border: none;
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-reserve:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(220,38,38,0.4);
}

.btn-reserve:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.btn-pay {
    background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
    border: none;
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-pay:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(220,38,38,0.4);
}

.btn-pay:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Keep your SCREEN design */
.screen-container {
    text-align: center;
    margin-bottom: 3rem;
}

.screen {
    background: linear-gradient(to bottom, #4a5568 0%, #2d3748 100%);
    color: white;
    padding: 1rem;
    border-radius: 10px 10px 50% 50%;
    margin: 0 auto 2rem;
    max-width: 600px;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 3px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Responsive adjustments */
@media (max-width: 768px) {
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
