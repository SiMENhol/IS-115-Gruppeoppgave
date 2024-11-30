<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <p class="text-gray-600">
                    You have selected the date from <strong>{{ $userCheckIn }}</strong> until <strong>{{ $userCheckOut }}</strong>.
                </p>
                <p class="text-gray-600 mt-2">Please select the rooms for each requirement:</p>
            </div>
        </div>

        <!-- Form for Confirm Booking -->
        <form action="{{ url('confirm_booking') }}" method="POST" class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @csrf

            <!-- Pass Check-In and Check-Out Dates -->
            <input type="hidden" name="userCheckIn" value="{{ $userCheckIn }}">
            <input type="hidden" name="userCheckOut" value="{{ $userCheckOut }}">

            <!-- Iterate Over Available Rooms -->
            @foreach ($availableRooms as $roomIndex => $rooms)
                <div class="p-6 flex flex-col space-y-4 border-b">
                    <h4 class="font-semibold text-lg">Room {{ $roomIndex + 1 }}</h4>

                    <!-- Room Selection -->
                    <label for="room_{{ $roomIndex }}" class="font-bold text-gray-600">Select a Room:</label>
                    <select name="selectedRooms[{{ $roomIndex }}]" id="room_{{ $roomIndex }}" class="border p-2 rounded" required>
                        <option value="" disabled selected>Select Room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->roomId }}">
                                {{ $room->roomType }} ({{ $room->places }} places) - {{ $room->price }} NOK - ID: {{ $room->roomId }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <!-- Submit Button -->
            <div class="p-6">
                <button type="submit" >
                    Confirm Selection
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
