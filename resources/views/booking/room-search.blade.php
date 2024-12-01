<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <p class="text-gray-600">
                    You have selected the date from <strong>{{ $userCheckIn }}</strong> until <strong>{{ $userCheckOut }}</strong>.
                </p>
                <p class="text-gray-600 mt-2">Please select the room(s) for each requirement:</p>
            </div>
        </div>
        <form action="{{ url('booking_overview') }}" method="POST" class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @csrf
            <input type="hidden" name="userCheckIn" value="{{ $userCheckIn }}">
            <input type="hidden" name="userCheckOut" value="{{ $userCheckOut }}">

            @foreach ($availableRooms as $roomIndex => $rooms)
                <div class="p-6 flex flex-col space-y-4 border-b">
                    <h4 class="font-semibold text-lg">Room {{ $roomIndex - 1 }}</h4>
                    <label for="room_{{ $roomIndex }}" class="font-bold text-gray-600">Select a Room:</label>
                    <select name="selectedRooms[{{ $roomIndex }}]" id="room_{{ $roomIndex }}" class="border p-2 rounded" required>
                        <option value="" disabled selected>Select Room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->roomId }}">
                                {{ $room->roomType }} ({{ $room->places }} guest) - {{ $room->price }} NOK
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <div class="p-4 flex justify-center" >
                <x-primary-button class="ms-3">
                    Proceed to payment
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
