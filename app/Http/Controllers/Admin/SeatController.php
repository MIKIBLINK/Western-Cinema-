<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Seat::with('hall')
            ->orderBy('hall_id')
            ->orderBy('seat_row')
            ->orderBy('seat_number')
            ->get();
        return view('admin.seats.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $halls = Hall::all();
        return view('admin.seats.create', compact('halls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hall_id' => 'required|exists:halls,id',
            'seat_row' => 'required|regex:/^[A-Z]-[A-Z]$/',
            'seat_number' => 'required|integer|min:1|max:50',
        ]);

        [$start, $end] = explode('-', strtoupper($request->seat_row));
        $rows = range($start, $end);

        foreach ($rows as $row) {
            for ($i = 1; $i <= $request->seat_number; $i++) {
                Seat::firstOrCreate([
                    'hall_id' => $request->hall_id,
                    'seat_row' => $row,
                    'seat_number' => $i,
                ]);
            }
        }

        return redirect()->route('admin.seats.index')->with('success', 'Seats generated successfully!');
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
    public function edit(Seat $seat)
    {
        $halls = Hall::all();
        return view('admin.seats.edit', compact('seat', 'halls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'hall_id' => 'required|exists:halls,id',
            'seat_row' => 'required|string|max:1',
            'seat_number' => 'required|integer|min:1',
        ]);

        $seat->update($request->all());

        return redirect()->route('admin.seats.index')->with('success', 'Seat updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return back()->with('success', 'Seat deleted!');
    }
}
