<?php

namespace App\Http\Controllers\User;

use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Movie $movie)
    {
        $showtimes = Showtime::where('movie_id', $movie->id)->get();
        return view('user.showtimes.index', compact('movie', 'showtimes'));
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
