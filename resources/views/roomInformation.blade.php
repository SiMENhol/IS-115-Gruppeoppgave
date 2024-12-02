<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($rooms as $room)
                @if (!array_key_exists($room->roomType, $roomTypesDisplayed))
                    @php
                        $roomTypesDisplayed[$room->roomType] = true;
                    @endphp
                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">
                            <!-- Midlertidig bilde -->
                            <img src="https://sonspa.no/wp-content/uploads/2018/05/Enkeltrom-scaled.jpg">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-lg text-gray-800">{{ $room->roomType }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $room->places }} guest(s)</small>
                                    <small class="ml-2 text-sm text-gray-600">{{ $room->beds }}</small>
                                </div>
                            </div>
                            <p class="mt-4 text-xl text-gray-900">{{ $room->price }} kr</p>
                            <p class="mt-4 text-gray-900">{{ $room->roomDesc }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
