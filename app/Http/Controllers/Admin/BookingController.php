<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\User;
use App\Models\Booking;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Booking::with(['user', 'showtime', 'seats'])->latest()->get();
        return view('admin.bookings.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $showtimes = Showtime::with('movie', 'hall')->get();
        $seats = Seat::all(); // or filter by showtime hall later
        return view('admin.bookings.create', compact('users', 'showtimes', 'seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'user_id' => 'required|exists:users,id',
        'showtime_id' => 'required|exists:showtimes,id',
        'seat_ids' => 'required|array|min:1',
        'seat_ids.*' => 'exists:seats,id',
        ]);

        $showtime = Showtime::findOrFail($request->showtime_id);
        $totalPrice = $showtime->price * count($request->seat_ids);

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'showtime_id' => $request->showtime_id,
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        $booking->seats()->attach($request->seat_ids);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $users = User::all();
        $showtimes = Showtime::with('movie', 'hall')->get();
        $seats = Seat::where('hall_id', $booking->showtime->hall_id)->get(); // only seats in this hall
        return view('admin.bookings.edit', compact('booking', 'users', 'showtimes', 'seats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:reserved,pending,paid,cancelled',
        ]);

        $oldStatus = $booking->status;
        $newStatus = $request->status;

        $booking->update([
            'status' => $newStatus,
        ]);

        // If admin changes status to PAID and payment does not exist → create payment
        if ($oldStatus !== 'paid' && $newStatus === 'paid' && !$booking->payment) {
            $booking->payment()->create([
                'amount' => $booking->total_price,
                'method' => 'admin',
                'status' => 'paid',
                'transaction_ref' => 'ADMIN-' . strtoupper(uniqid()),
            ]);
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete(); // pivot table entries are removed automatically
        return back()->with('success', 'Booking deleted!');
    }
}
