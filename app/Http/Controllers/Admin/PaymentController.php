<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
        {
            $rows = Payment::with([
                'booking.user',
                'booking.showtime.movie'
            ])->latest()->get();

        return view('admin.payments.index', compact('rows'));
    }


    public function markPaid(Booking $booking)
    {
        if ($booking->payment) {
            return back()->withErrors('Payment already exists.');
        }

        $booking->update(['status' => 'paid']);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => 'admin',
            'status' => 'paid',
            'transaction_ref' => 'ADMIN-' . strtoupper(uniqid()),
        ]);

        return back()->with('success', 'Marked as paid.');
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed',
        ]);

        $payment->update([
            'status' => $request->status,
        ]);

        $payment->booking->update([
            'status' => $request->status === 'paid' ? 'paid' : 'pending',
        ]);

        return back()->with('success', 'Payment updated.');
    }
}
