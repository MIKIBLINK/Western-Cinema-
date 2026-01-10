<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Showtime::with('movie')->latest()->get();
        return view('admin.showtimes.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        $halls = Hall::all();
        return view('admin.showtimes.create', compact('movies', 'halls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'hall_id'  => 'required|exists:halls,id',
            'start_time' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        Showtime::create($request->all());

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime created!');
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
    public function edit(Showtime $showtime)
    {
        $movies = Movie::all();
        $halls = Hall::all();
        return view('admin.showtimes.edit', compact('showtime', 'movies', 'halls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Showtime $showtime)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'hall_id'  => 'required|exists:halls,id',
            'start_time' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        $showtime->update($request->all());

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Showtime $showtime)
    {
        $showtime->delete();
        return back()->with('success', 'Showtime deleted!');
    }
    
}
