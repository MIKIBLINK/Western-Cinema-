<?php

namespace App\Http\Controllers\User;

use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Showtime $showtime)
    {
        // Get all seats for the hall
        $seats = Seat::where('hall_id', $showtime->hall_id)
            ->orderBy('seat_row')
            ->orderBy('seat_number')
            ->get();

        $bookedSeatIds = $showtime->bookings()
            ->with('seats:id')
            ->get()
            ->pluck('seats.*.id')
            ->flatten()
            ->unique()
            ->toArray();

        return view('user.seats.index', compact('showtime', 'seats', 'bookedSeatIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}