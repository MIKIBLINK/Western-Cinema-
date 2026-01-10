<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Hall::all();
        return view('admin.halls.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.halls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'total_seats' => 'required|integer|min:1'
        ]);

        Hall::create($request->all());
        return redirect()->route('admin.halls.index')->with('success', 'Hall created successfully.');
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
    public function edit(Hall $hall)
    {
        return view('admin.halls.edit', compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hall $hall)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'total_seats' => 'required|integer|min:1',
        ]);

        $hall->update($request->all());

        return redirect()->route('admin.halls.index')->with('success', 'Hall updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();
        return redirect()->route('admin.halls.index')->with('success', 'Hall deleted successfully.');
    }
}
