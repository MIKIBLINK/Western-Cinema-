<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Movie::all();
        return view('admin.movies.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:20',
            'rating' => 'nullable|string|max:10',
            'poster' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title','description','duration','rating']);

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $posterName = time() .'.'. $poster->getClientOriginalExtension();
            $poster->move(public_path('images/poster'),$posterName);
            $data['poster'] = 'images/poster/' . $posterName; 
        }


        Movie::create($data);
        return redirect()->route('admin.movies.index')->with('success','Movie added successfully!');
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
        $row = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255' . $movie->id,
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:20',
            'rating' => 'nullable|string|max:10',
            'poster' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title','description','duration','rating']);

        if ($request->hasFile('poster')) {

            if ($movie->poster && file_exists(public_path(''. $movie->poster))) {
                unlink(public_path(''. $movie->poster));
            }

            $poster = $request->file('poster');
            $posterName = time() .'.'. $poster->getClientOriginalExtension();
            $poster->move(public_path('images/poster'),$posterName);
            $data['poster'] = 'images/poster/' . $posterName; 
        }


        $movie->update($data);

        return redirect()->route('admin.movies.index')->with('success','Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->poster && file_exists(public_path(''. $movie->poster))) {
                unlink(public_path(''. $movie->poster));
            }
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success','Movie deleted successfully!');
    }
}
