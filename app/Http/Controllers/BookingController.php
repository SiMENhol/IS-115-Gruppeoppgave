<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\SearchRoomRequest;

class BookingController extends Controller
{
    /**
     * Display the list of bookings.
     */
    public function index(): View
    {
        return view('booking', [
            'booking' => Booking::with('user')->latest()->get(), // Retrieve all bookings with associated user data, ordered by the latest
        ]);
    }

    /**
     * Search for rooms based on user criteria.
     */
    public function search_room(SearchRoomRequest $request)
    {

        $validated = $request->validated(); // Extract the room requirements from the request.
        $rooms = $validated['rooms']; // Extract the room requirements from the request.

        // Parse and set the user's check-in and check-out dates with specific times.
        $userCheckIn = Carbon::parse($validated['checkInDato'])->setTime(15, 0);
        $userCheckOut = Carbon::parse($validated['checkOutDato'])->setTime(12, 0);

        // Initialize variables for tracking availability.
        $availableRooms = []; // Stores available rooms for each requested room type.
        $usedRoomIds = []; // Tracks room IDs that have already been assigned.

        // Loop through each room type requested by the user.
        foreach ($rooms as $index => $details) {
            $availableRoomsForThisSelection = $this->getAvailableRooms( // Check availability for the current room type.
                $details['places'],
                $usedRoomIds,
                $userCheckIn,
                $userCheckOut
            );

            // If no rooms are available for the current selection, redirect with an error message.
            if ($availableRoomsForThisSelection->isEmpty()) {
                return redirect()->back()->withErrors(['message' => "No rooms available for the selected dates."]);
            }


            $availableRooms[$index + 1] = $availableRoomsForThisSelection; // Add the available rooms for this selection to the result array.
            $usedRoomIds = array_merge($usedRoomIds, $availableRoomsForThisSelection->pluck('roomId')->toArray()); // Update the list of used room IDs to prevent duplication in subsequent selections.
        }

        // Render the room search results page with the available rooms and user search criteria.
        return view('booking.room-search', [
            'availableRooms' => $availableRooms,
            'numRooms' => $validated['numRooms'],
            'userCheckIn' => $userCheckIn->toDateString(),
            'userCheckOut' => $userCheckOut->toDateString(),
        ]);
    }

    /**
     * Display a booking overview with total price and details.
     */
    public function booking_overview(Request $request)
    {

        $validated = $request->only(['selectedRooms', 'userCheckIn', 'userCheckOut']); // Extract the selected room IDs and dates from the request

        // Parse check-in and check-out dates
        $userCheckIn = Carbon::parse($validated['userCheckIn']);
        $userCheckOut = Carbon::parse($validated['userCheckOut']);

        // Ensure that check-in date is always before check-out date
        if ($userCheckIn->greaterThanOrEqualTo($userCheckOut)) {
            return redirect()->back()->withErrors(['message' => 'The check-in date must be before the check-out date.']);
        }

        // Calculate the number of nights
        $numNights = $userCheckIn->diffInDays($userCheckOut);

        // Fetch room details for the selected rooms
        $selectedRooms = Room::whereIn('roomId', $validated['selectedRooms'])->get();

        // Calculate the total price for the booking
        $totalPrice = $selectedRooms->sum(function ($room) use ($numNights) {
            return $room->price * $numNights;
        });

        // Render the booking overview page
        return view('booking.booking-overview', [
            'selectedRooms' => $selectedRooms,
            'userCheckIn' => $userCheckIn->toDateString(),
            'userCheckOut' => $userCheckOut->toDateString(),
            'totalPrice' => $totalPrice,
            'numNights' => $numNights,
        ]);
    }

    /**
     * Create bookings for the selected rooms.
     */
    public function create_booking(Request $request)
    {

        $validated = $request->only(['selectedRooms', 'userCheckIn', 'userCheckOut']); // Extract the selected rooms and dates from the request

        // Parse the check-in and check-out dates
        $userCheckIn = $validated['userCheckIn'];
        $userCheckOut = $validated['userCheckOut'];
        $totalPrice = $request['totalPrice'];

        // Convert the comma-separated list of room IDs into an array
        $roomIds = explode(',', $validated['selectedRooms']);

        // Loop through each room ID to check if it is available
        foreach ($roomIds as $roomId) {
            if (!$this->isRoomAvailable($roomId, $userCheckIn, $userCheckOut)) {
                return redirect()->back()->withErrors(['message' => "Room $roomId is already booked during the selected dates."]);
            }
        }

        // Fetch the latest group booking ID and increment it or set it to 1 if none exist
        $latestGroupBookingId = Booking::max('groupBookingId'); // Retrieve the highest group booking ID
        $groupBookingId = $latestGroupBookingId ? $latestGroupBookingId + 1 : 1; // Increment or start with 1

        // Initialize an array to store the created booking records
        $reservations = [];
        // Loop through each room ID to create booking records
        foreach ($roomIds as $roomId) {
            $reservations[] = Booking::create([
                'roomId' => $roomId, // Assign room ID to the booking
                'userId' => Auth::id(), // Assign the authenticated user's ID
                'checkInDato' => $userCheckIn, // Assign the check-in date
                'checkOutDato' => $userCheckOut, // Assign the check-out date
                'reservationStatus' => 'booked', // Set the status to 'booked'
                'groupBookingId' => $groupBookingId, // Link the booking to the group booking ID
                'price' => $totalPrice, // Assign the price

            ]);
        }

        // Retrieve room details for the group booking
        $rooms = Room::whereIn('roomId', $roomIds)->get();

        // Render the booking confirmation page with the booking details
        return view('booking.create-booking', [
            'reservations' => $reservations, // Pass the booking records to the view
            'checkIn' => $userCheckIn, // Pass the formatted check-in date
            'checkOut' => $userCheckOut, // Pass the formatted check-out date
            'groupBookingId' => $groupBookingId, // Pass the group booking ID
            'rooms' => $rooms, // Pass the actual room data
            'price' => $totalPrice, // Pass total price to the view
        ]);
    }

    /**
     * Display the booking payment page.
     */
    public function booking_payment(Request $request)
    {

        // Extract user input from the request
        $userCheckIn = $request->input('userCheckIn');
        $userCheckOut = $request->input('userCheckOut');
        $selectedRooms = explode(',', $request->input('selectedRooms'));
        $totalPrice = $request->input('totalPrice');

        // Render the booking payment page
        return view('booking.booking-payment', [
            'userCheckIn' => $userCheckIn,
            'userCheckOut' => $userCheckOut,
            'selectedRooms' => $selectedRooms,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Process the booking payment.
     */
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

    /**
     * When the user is searching for a room and is not logged in and there is no Id, return the view.
     */
    public function search_room_noId(Request $request)
    {

        return view('booking.search-room-noId');
    }



    //Under is helper methods



    /**
     * Check if a room is available for the given dates.
     */
    private function isRoomAvailable($roomId, $checkInDate, $checkOutDate): bool
    {
        // Check if the room is booked for any overlapping dates
        return !Booking::where('roomId', $roomId)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('checkInDato', [$checkInDate, $checkOutDate]) // Overlaps within check-in
                    ->orWhereBetween('checkOutDato', [$checkInDate, $checkOutDate]) // Overlaps within check-out
                    ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->where('checkInDato', '<=', $checkInDate)
                            ->where('checkOutDato', '>=', $checkOutDate);
                    });
            })
            ->exists(); // Return true if any overlapping bookings exist
    }

    /**
     * Get available rooms based on the specified criteria.
     */
    private function getAvailableRooms(int $requiredPlaces, array $usedRoomIds, Carbon $checkInDate, Carbon $checkOutDate)
    {

        return Room::query()
            ->where('places', '>=', $requiredPlaces) // Ensure room meets the place requirement
            ->whereNotIn('roomId', $usedRoomIds) // Exclude already selected rooms
            ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('checkInDato', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('checkOutDato', [$checkInDate, $checkOutDate])
                    ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->where('checkInDato', '<=', $checkInDate)
                            ->where('checkOutDato', '>=', $checkOutDate);
                    });
            })
            ->get()
            ->groupBy('roomType') // Group by room type
            ->map(function ($group) {
                return $group->first(); // Get the first room of each type
            })
            ->values();
    }
}
