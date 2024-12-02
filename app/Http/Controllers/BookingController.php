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

                if ($availableRoomsForThisSelection->isEmpty()) {
                    return redirect()->back()->withErrors(['message' => "There is no available room(s) for the selected dates"]);
                }

            $availableRooms[$index + 1] = $availableRoomsForThisSelection;

            // Mark assigned room IDs as used
            foreach ($availableRoomsForThisSelection as $room) {
                $usedRoomIds[] = $room->roomId;
            }
        }

        return view('booking.room-search', [
            'availableRooms' => $availableRooms,
            'numRooms' => $validated['numRooms'],
            'userCheckIn' => $userCheckIn->toDateString(),
            'userCheckOut' => $userCheckOut->toDateString(),

        ]);
    }

    public function booking_overview(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'selectedRooms' => 'required|array|min:1',
            'selectedRooms.*' => 'required|exists:room,roomId',
            'userCheckIn' => 'required|date|after_or_equal:today',
            'userCheckOut' => 'required|date|after:userCheckIn',
        ]);

        // Parse check-in and check-out dates
        $userCheckIn = Carbon::parse($validated['userCheckIn']);
        $userCheckOut = Carbon::parse($validated['userCheckOut']);

        // Ensure that check-in date is always before check-out date
        if ($userCheckIn->greaterThanOrEqualTo($userCheckOut)) {
            return redirect()->back()->withErrors(['message' => 'The check-in date must be before the check-out date.']);
        }

        // Calculate the number of nights
        $numNights = $userCheckIn->diffInDays($userCheckOut);

        // Fetch room details
        $selectedRooms = Room::whereIn('roomId', $validated['selectedRooms'])->get();

        // Calculate total price
        $totalPrice = $selectedRooms->sum(function ($room) use ($numNights) {
            return $room->price * $numNights;
        });

        return view('booking.booking-overview', [
            'selectedRooms' => $selectedRooms,
            'userCheckIn' => $userCheckIn->toDateString(),
            'userCheckOut' => $userCheckOut->toDateString(),
            'totalPrice' => $totalPrice,
            'numNights' => $numNights,
        ]);
    }

    public function create_booking(Request $request)
    {
        $validated = $request->validate([
            'selectedRooms' => 'required|string',
            'userCheckIn' => 'required|date|after_or_equal:today',
            'userCheckOut' => 'required|date|after:userCheckIn',
        ]);

        $userCheckIn = $validated['userCheckIn'];
        $userCheckOut = $validated['userCheckOut'];

        // Convert selectedRooms back to array
        $roomIds = explode(',', $validated['selectedRooms']);

        // Ensure no overlapping bookings
        foreach ($roomIds as $roomId) {
            if (!$this->isRoomAvailable($roomId, $userCheckIn, $userCheckOut)) {
                return redirect()->back()->withErrors(['message' => "Room $roomId is already booked during the selected dates."]);
            }
        }
        //Check for det latest
        $latestGroupBookingId = Booking::max('groupBookingId');
        $groupBookingId = $latestGroupBookingId ? $latestGroupBookingId + 1 : 1;
        // Create bookings
        $reservations = [];
        foreach ($roomIds as $roomId) {
            $reservations[] = Booking::create([
                'roomId' => $roomId,
                'userId' => Auth::id(),
                'checkInDato' => $userCheckIn,
                'checkOutDato' => $userCheckOut,
                'reservationStatus' => 'booked',
                'groupBookingId' => $groupBookingId,

            ]);
        }

        return view('booking.create-booking', [
            'reservations' => $reservations,
            'checkIn' => $userCheckIn,
            'checkOut' => $userCheckOut,
        ]);
    }
    public function booking_payment(Request $request)
    {
        $userCheckIn = $request->input('userCheckIn');
        $userCheckOut = $request->input('userCheckOut');
        $selectedRooms = explode(',', $request->input('selectedRooms'));
        $totalPrice = $request->input('totalPrice');


        return view('booking.booking-payment', [
            'userCheckIn' => $userCheckIn,
            'userCheckOut' => $userCheckOut,
            'selectedRooms' => $selectedRooms,
            'totalPrice' => $totalPrice,
        ]);
    }
    public function processing_payment(Request $request)
    {
        // Pass data from payment form to the processing page
        $userCheckIn = $request->input('userCheckIn');
        $userCheckOut = $request->input('userCheckOut');
        $selectedRooms = $request->input('selectedRooms');
        $totalPrice = $request->input('totalPrice');

        return view('booking.processing-payment', [
            'userCheckIn' => $userCheckIn,
            'userCheckOut' => $userCheckOut,
            'selectedRooms' => $selectedRooms,
            'totalPrice' => $totalPrice,
        ]);
    }


    public function search_room_noId(Request $request)
    {
        return view('booking.search-room-noId');
    }

    public function search_date(Request $request)
    {
        $validated = $request->validate([
            'roomType' => 'required|string|max:255',
        ]);

        $roomType = $validated['roomType'];

        return view('booking.date-search', [
            'roomType' => $roomType,

        ]);
    }
}
