<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rooms as $room)
                @if (!array_key_exists($room->roomType, $roomTypesDisplayed))
                    @php
                        $roomTypesDisplayed[$room->roomType] = true;
                    @endphp
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img class="w-full h-48 object-cover" src="https://sonspa.no/wp-content/uploads/2018/05/Enkeltrom-scaled.jpg" alt="{{ $room->roomType }}">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-xl font-semibold text-gray-800">{{ $room->roomType }}</span>
                                    <div class="text-sm text-gray-600">
                                        <small>{{ $room->places }} guest(s)</small>
                                        <small class="ml-4">{{ $room->beds }}</small>
                                    </div>
                                </div>
                                <p class="text-xl font-semibold text-gray-900">{{ $room->price }} NOK / night</p>
                            </div>
                            <p class="mt-4 text-gray-700 text-base">{{ $room->roomDesc }}</p>

                            <!-- Booking Button -->
                            @if (Auth::user())
                                <form action="{{ url('search_date') }}" method="POST">
                            @else
                                <form action="{{ url('search_room_noId') }}" method="POST">
                            @endif
                            @csrf
                            <x-text-input hidden name="roomType" value="{{ $room->roomType }}"/>
                            <x-primary-button class="mt-6 px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center">
                                {{ __('Book Now') }}
                            </x-primary-button>

                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
