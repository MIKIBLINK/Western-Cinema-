<?php

namespace App\Http\Controllers\User;

use App\Models\Booking;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('showtime.movie', 'seats')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id',
            'action' => 'required|in:reserve,pay',
        ]);

        return DB::transaction(function () use ($request) {

            $showtime = Showtime::findOrFail($request->showtime_id);

            // Check seat conflicts
            $alreadyBooked = DB::table('booking_seats')
                ->join('bookings', 'bookings.id', '=', 'booking_seats.booking_id')
                ->where('bookings.showtime_id', $showtime->id)
                ->whereIn('booking_seats.seat_id', $request->seat_ids)
                ->whereIn('bookings.status', ['reserved', 'pending', 'paid'])
                ->exists();

            if ($alreadyBooked) {
                return back()->withErrors(['seat_ids' => 'One or more selected seats are already booked.']);
            }

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'showtime_id' => $showtime->id,
                'status' => $request->action === 'pay' ? 'pending' : 'reserved',
                'total_price' => $showtime->price * count($request->seat_ids),
            ]);

            $booking->seats()->sync($request->seat_ids);

            if ($request->action === 'pay') {
                return redirect()->route('user.payments.qr', $booking);
            }

            return redirect()->route('user.bookings.confirmation', $booking);
        });
    }

    public function qr(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        if ($booking->status !== 'pending') {
            return redirect()->route('user.bookings.confirmation', $booking);
        }

        return view('user.payments.qr', compact('booking'));
    }


    public function markPaid(Booking $booking)
{
    abort_if($booking->user_id !== auth()->id(), 403);

    if ($booking->status !== 'pending') {
        return redirect()->route('user.bookings.confirmation', $booking);
    }

    if ($booking->payment) {
        return back()->withErrors('Already paid.');
    }

    $booking->update(['status' => 'paid']);

    $booking->payment()->create([
        'amount' => $booking->total_price,
        'method' => 'qr',
        'status' => 'paid',
        'transaction_ref' => 'QR-' . strtoupper(uniqid()),
    ]);

    return redirect()->route('user.bookings.confirmation', $booking)
        ->with('success', 'Payment successful!');
}

    public function show(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        $booking->load('showtime.movie', 'seats');

        return view('user.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        if ($booking->status === 'paid') {
            return back()->withErrors('Paid bookings cannot be cancelled.');
        }

        $booking->delete();

        return redirect()->route('user.bookings.index')->with('success', 'Booking cancelled.');
    }

    public function confirmation(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        $booking->load('showtime.movie', 'seats');

        return view('user.bookings.confirmation', compact('booking'));
    }
}
