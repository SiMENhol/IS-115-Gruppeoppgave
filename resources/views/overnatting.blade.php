<style>
    table, th, td {
        color: black;
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
    }
</style>

@php
    $romType = [];
@endphp

<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($rooms as $room)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <img src="https://sonspa.no/wp-content/uploads/2018/05/Enkeltrom-scaled.jpg"></td>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg text-gray-800">{{ $room->roomType }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $room->places }} senger</small>
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $room->price }} kr</p>
                        <p class="mt-4 text-gray-900">{{ $room->roomDesc }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
