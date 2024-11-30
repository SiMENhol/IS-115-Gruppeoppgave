<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
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


    private function isRoomAvailable($roomId, $checkInDate, $checkOutDate): bool
    {
        return !Booking::where('roomId', $roomId)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('checkInDato', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('checkOutDato', [$checkInDate, $checkOutDate])
                    ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->where('checkInDato', '<=', $checkInDate)
                            ->where('checkOutDato', '>=', $checkOutDate);
                    });
            })
            ->exists();
    }

    public function search_room(Request $request)
    {
        $validated = $request->validate([
            'numRooms' => 'required|integer|min:1|max:10',
            'rooms.*.places' => 'required|integer|min:1',
            'checkInDato' => 'required|date|after_or_equal:today',
            'checkOutDato' => 'required|date|after:checkInDato',
        ]);

        $rooms = $validated['rooms'];
        $userCheckIn = Carbon::parse($validated['checkInDato'])->setTime(15, 0);
        $userCheckOut = Carbon::parse($validated['checkOutDato'])->setTime(12, 0);

        $usedRoomIds = []; // Track assigned room IDs
        $availableRooms = [];

        foreach ($rooms as $index => $details) {
            $requiredPlaces = $details['places'];

            // Fetch available rooms that meet the requirement and are not already assigned
            $availableRoomsForThisSelection = Room::query()
                ->where('places', '>=', $requiredPlaces)
                ->whereNotIn('roomId', $usedRoomIds) // Exclude already selected rooms
                ->whereDoesntHave('bookings', function ($query) use ($userCheckIn, $userCheckOut) {
                    $query->whereBetween('checkInDato', [$userCheckIn, $userCheckOut])
                        ->orWhereBetween('checkOutDato', [$userCheckIn, $userCheckOut])
                        ->orWhere(function ($query) use ($userCheckIn, $userCheckOut) {
                            $query->where('checkInDato', '<=', $userCheckIn)
                                ->where('checkOutDato', '>=', $userCheckOut);
                        });
                })
                ->get()
                ->groupBy('roomType') // Group by room type
                ->map(function ($group) {
                    return $group->first(); // Get the first room of each type
                })
                ->values(); // Reset keys

            $availableRooms[$index + 1] = $availableRoomsForThisSelection;

            // Mark assigned room IDs as used
            foreach ($availableRoomsForThisSelection as $room) {
                $usedRoomIds[] = $room->roomId;
            }
        }

        return view('selectroom', [
            'availableRooms' => $availableRooms,
            'numRooms' => $validated['numRooms'],
            'userCheckIn' => $userCheckIn->toDateString(),
            'userCheckOut' => $userCheckOut->toDateString(),
        ]);
    }

    public function confirm_booking(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'selectedRooms' => 'required|array|min:1',
            'selectedRooms.*' => 'required|exists:room,roomId',
            'userCheckIn' => 'required|date|after_or_equal:today',
            'userCheckOut' => 'required|date|after:userCheckIn',
        ]);

        $userCheckIn = $validated['userCheckIn'];
        $userCheckOut = $validated['userCheckOut'];

        // Ensure no overlapping bookings for the selected rooms
        foreach ($validated['selectedRooms'] as $roomId) {
            if (!$this->isRoomAvailable($roomId, $userCheckIn, $userCheckOut)) {
                return redirect()->back()->withErrors(['message' => "Room $roomId is already booked during the selected dates."]);
            }
        }

        // Create bookings for each selected room
        $reservations = [];
        foreach ($validated['selectedRooms'] as $roomId) {
            $reservations[] = Booking::create([
                'roomId' => $roomId,
                'userId' => Auth::id(),
                'checkInDato' => $userCheckIn,
                'checkOutDato' => $userCheckOut,
                'reservationStatus' => 'booked',
            ]);
        }

        // Return the confirmation view
        return view('bookincomplete', [
            'reservations' => $reservations,
            'checkIn' => $userCheckIn,
            'checkOut' => $userCheckOut,
        ]);
    }
}
