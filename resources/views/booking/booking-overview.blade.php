<x-app-layout>
    <div class="max-w-2xl flex mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <p class="text-gray-600">
                    You have selected the following dates: <strong>{{ $userCheckIn }}</strong> to <strong>{{ $userCheckOut }}</strong>.
                </p>
                <p class="text-gray-600 mt-2">Number of Nights: <strong>{{ $numNights }}</strong></p>
                <p class="text-gray-600 mt-2">Please review your booking details below:</p>
            </div>

            <div class="p-6">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Room</th>
                            <th class="text-left">Price Per Night</th>
                            <th class="text-left">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selectedRooms as $room)
                            <tr>

                                <td>{{ $room->roomType }}</td>
                                <td>{{ $room->price }} NOK</td>
                                <td>{{ $room->price * $numNights }} NOK</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6">
                <p class="text-gray-600 font-bold">
                    Total Price for {{ $numNights }} Night(s): {{ $totalPrice }} NOK
                </p>
            </div>

            <form action="{{ url('booking_payment') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="userCheckIn" value="{{ $userCheckIn }}">
                <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                <input type="hidden" name="userCheckOut" value="{{ $userCheckOut }}">
                <input type="hidden" name="selectedRooms" value="{{ implode(',', $selectedRooms->pluck('roomId')->toArray()) }}">

                <div class="p-4 flex justify-center" >
                    <x-primary-button class="ms-3">
                        <a href="{{ route('dashboard') }}" class="text-white no-underline">
                            Go back to Dashboard
                        </a>
                    </x-primary-button>

                    <x-primary-button class="ms-3">
                        Pay now!
                    </x-primary-button>
                    </div>
            </form>
        </div>
    </div>



</x-app-layout>
