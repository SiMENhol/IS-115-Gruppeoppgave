<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;




class BookingController extends Controller
{
        public function index(): View
        {
            return view('booking', [
                'booking' => Booking::with('user')->latest()->get(),
            ]);
        }


        public function viewdetail(): View
        {
            return view('detailedroom');
        }
        public function viewroom(): View
        {
            return view('selectroom');
        }
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        public function add_booking(Request $request)
        {
            $request->validate([
                'checkInDato'=>'required|date',
                'checkOutDato'=>'date|after:checkInDato'
            ]);

                // Convert input dates to Carbon instances
                $checkInDate = Carbon::parse($request->checkInDato);
                $checkOutDate = Carbon::parse($request->checkOutDato);
                $roomId = $request->roomId;

                // Check if there are any bookings that overlap with the requested dates for the selected room
                $isRoomAvailable = !Booking::where('roomId', $roomId)
                ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('checkInDato', [$checkInDate, $checkOutDate])
                  ->orWhereBetween('checkOutDato', [$checkInDate, $checkOutDate])
                  ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                      $query->where('checkInDato', '<=', $checkInDate)
                            ->where('checkOutDato', '>=', $checkOutDate);
                  });
        })
        ->exists();

        if ($isRoomAvailable) {
            $data = new Booking;

            // Assign values from form fields to the Booking model

            $data->userId = Auth::user()->id; // Set userId to the currently logged-in user's ID
            $data->roomId = $roomId;
            $data->checkInDato = $checkInDate;
            $data->checkOutDato = $checkOutDate;
            $data->reservationStatus = 'booked';

            $data->save();
            return redirect()->back()->with('message', 'Booking created successfully.');
        } else {
            // Room is not available
            return redirect()->back()->with('message', 'The selected room is not available for the chosen dates.');
        }
    }

    public function search_room(Request $request)
    {
        $roomId = request('roomId');
        $requiredPlaces = request('places');
        $userCheckIn = request('checkInDato');
        $userCheckOut = request('checkOutDato');

        $roomType = $request->roomType;
        $isRoomAvailable = Room::query()
        ->leftJoin('reservation', 'room.roomId', '=', 'reservation.roomId')

        ->where('room.places', '>=', $requiredPlaces)
        ->where(function($query) use ($userCheckIn, $userCheckOut) {
            $query->whereNull('reservation.checkInDato')
                  ->orWhereNull('reservation.checkOutDato')
                  ->orWhere('reservation.checkOutDato', '<=', $userCheckIn)
                  ->orWhere('reservation.checkInDato', '>=', $userCheckOut);

        })
        ->selectRaw('
    MIN(room.roomId) as roomId,
    room.roomType,
    MIN(room.places) as places,
    room.roomDesc,
    room.price,
    MIN(reservation.checkOutDato) as checkOutDato,
    MIN(reservation.checkInDato) as checkInDato
')
        ->groupBy('room.roomType', 'room.roomDesc', 'room.price')
        ->orderBy('places', 'asc')
        ->get();


        return view('selectroom', ['rooms' => $isRoomAvailable, 'roomId' => $roomId, 'userCheckIn' => $userCheckIn, 'userCheckOut' => $userCheckOut]);
    }

            /**
         * Display the specified resource.
         */
        public function confirm_booking(Request $request, $roomId)
        {
            $roomId = request('roomId');
            $userCheckIn = request('userCheckIn');
            $userCheckOut = request('userCheckOut');
            $roomInfo = Room::query()
                ->leftJoin('reservation', 'room.roomId', '=', 'reservation.roomId')
                ->select('room.roomId', 'room.roomType', 'room.places', 'room.roomDesc', 'room.price')
                ->where('room.roomId', $roomId)
                ->get();

            return view('confirmbooking', ['room' => $roomInfo, 'roomId' => $roomId, 'userCheckIn' => $userCheckIn, 'userCheckOut' => $userCheckOut]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request): RedirectResponse
        {
            $validated = $request->validateWithBag('store', [
                'message' => 'required|string|max:255',
            ]);

            $request->user()->booking()->create($validated);

            return redirect(route('booking.index'));
        }

        /**
         * Display the specified resource.
         */
        public function show(Booking $rom)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Booking $rom)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Booking $rom)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Booking $rom)
        {
            //
        }

    }


