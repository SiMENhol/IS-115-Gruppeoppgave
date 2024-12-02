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
        $rooms = Room::all(); // Gets all the data from model Room, which corresponds to the database
        return view('admin.room.room', compact('rooms')); // Returns view with compact sending the variables to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room.create');
    }

    /**
     * Save a newly created room to the database.
     */
    public function store(Request $request)
    {
        {
            $validatedData = $request->validate([ // Validates the input from the form
                'roomType' => 'required|string|max:255',
                'places' => 'required|integer|in:0,1,2,3,4',
                'beds' => 'required|integer|in:0,1,2,3,4',
                'roomDesc' => 'nullable|string',
                'price' => 'required|integer|min:0',
            ]);

            Room::create($validatedData); // Creates a entry in the database from the data in validates

            return redirect()->route('room'); // Redirect after done
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($roomId) // string $id)
    {
        $room = Room::findOrFail($roomId); // Find the room by ID or throw a 404 error

        return view('admin.room.edit', compact('room')); // Redirect after done
    }

    /**
     * Update the specified resource in database.
     */
    public function update(Request $request, $roomId)
    {
        $validatedData = $request->validate([ // Validates the input from the form
            'roomType' => 'required|string|max:255',
            'places' => 'required|integer|in:0,1,2,3,4',
            'beds' => 'required|integer|in:0,1,2,3,4',
            'roomDesc' => 'nullable|string',
            'price' => 'required|integer|min:0',
        ]);

        $room = Room::findOrFail($roomId); // Find the room by ID or throw a 404 error
        $room->update($validatedData); // Updates a entry in the database from the data in validates

        return redirect()->route('room'); // Redirect after done
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roomId)
    {
    // Find the room by ID or throw a 404 error
    $room = Room::findOrFail($roomId);

    // Delete the room from the database
    $room->delete();

    // Redirect to the room listing with a success message
    return redirect()->route('room')->with('success', 'Room deleted successfully.');
    }

}
