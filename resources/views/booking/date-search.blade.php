<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <p class="text-gray-600">
                    You have selected our <strong>{{ $roomType }}</strong> room.
                </p>
                <p class="text-gray-600 mt-2">Please select the dates for check in and check out:</p>
            </div>
        </div>
        <div class="bg-white shadow-sm rounded-lg divide-y mt-4">
            <div class="p-6">
                @if (Auth::user())
                <form action="{{ url('selectAvailableRoom') }}" method="POST">
                @else
                <form action="{{ url('search_room_noId') }}" method="POST">
                @endif
                @csrf
                    <x-text-input name="roomType" value="{{ $roomType }}" hidden/>
                    <!-- Check-In Date -->
                    <div class="mt-4">
                        <x-input-label for="checkInDato" :value="__('When do you want the room?')" />
                        <x-text-input id="checkInDato" class="block mt-1 w-full" type="date" name="checkInDato" :value="old('checkInDato')" required />
                    </div>

                    <!-- Check-Out Date -->
                    <div class="mt-4">
                        <x-input-label for="checkOutDato" :value="__('When are you leaving?')" />
                        <x-text-input id="checkOutDato" class="block mt-1 w-full" type="date" name="checkOutDato" :value="old('checkOutDato')" required />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="ms-3">
                            Proceed to payment
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
