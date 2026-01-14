<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Eager load relationships to prevent the "property on null" crash
        $rows = Payment::with(['booking.user', 'booking.showtime.movie'])->latest()->get();
        return view('admin.payments.index', compact('rows'));
    }

    /**
     * Show the form for editing the specified payment.
     * This fixes the "Call to undefined method" error.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the payment status or details.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,failed,completed',
        ]);

        $payment->update($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully');
    }

    public function show($id)
    {
        $payment = Payment::with(['booking.user', 'booking.showtime.movie'])->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully');
    }
}
