<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $rooms = Room::all(); // Retrieve all records from the users table
        return view('room.room', compact('rooms')); // Pass data to the view
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $validatedData = $request->validate([
                'roomType' => 'required|string|max:255',
                'places' => 'required|integer|min:1',
                'roomStatus' => 'required|integer|in:0,1,2,3',
                'roomDesc' => 'nullable|string',
                'price' => 'required|integer|min:0',

            ]);

            Room::create($validatedData);

            // Redirect to a page with success message
            return redirect()->route('room');
        }
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
    public function edit($roomId)//string $id)
    {
        $room = Room::findOrFail($roomId); // Find the room by ID or throw a 404 error

        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $roomId)
    {
        $validatedData = $request->validate([
            'roomType' => 'required|string|max:255',
            'places' => 'required|integer|min:1',
            'roomStatus' => 'required|integer|in:0,1,2,3',
            'roomDesc' => 'nullable|string',
            'price' => 'required|integer|min:0',
        ]);

        $room = Room::findOrFail($roomId);
        $room->update($validatedData);

        return redirect()->route('room');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
