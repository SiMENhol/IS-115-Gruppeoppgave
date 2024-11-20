<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2">
        <small class="ml-2 text-sm text-gray-600">You have selected the date from {{ $userCheckIn }} until {{ $userCheckOut }}</small>
        <br>
        <small class="ml-2 text-sm text-gray-600"> More information ...</small>
    </div>
        </div>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($rooms as $room)

                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">
                            <!-- Midlertidig bilde -->
                            <img src="https://sonspa.no/wp-content/uploads/2018/05/Enkeltrom-scaled.jpg"></td>
                            <div class="flex justify-between items-center">
                                <div>

                                    <small class="ml-2 text-sm text-gray-600">{{ $room->places }} personer</small>
                                    <small class="ml-2 text-sm text-gray-600">{{ $room->roomId }} room id</small>
                                    <small class="ml-2 text-sm text-gray-600">{{ $room->roomType }} roomType</small>
                                    <small class="ml-2 text-sm text-gray-600">{{ $room->roomDesc }} roomDesc</small>
                                    <small class="ml-2 text-sm text-gray-600">{{ $room->price }} price</small>




                                    <a href="{{ url('confirmbooking', ['roomId' => $room->roomId, $userCheckIn, $userCheckOut ]) }}">Book</a>

                                </div>
                            </div>

                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
