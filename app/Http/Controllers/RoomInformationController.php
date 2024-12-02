<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RoomInformationController extends Controller
{
    /**
     * View Room Information.
     */
        public function index(): View
        {
            $rooms = Room::all(); // Gets all the data from model Room, which corresponds to the database
            $roomTypesDisplayed = []; // Makes an array
            return view('roomInformation', compact('rooms', 'roomTypesDisplayed')); // Returns view with compact sending the variables to the view
        }
    }


