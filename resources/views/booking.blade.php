<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">


<div class="">
    <x-input-label style="font-size:40px" value="Find your room!" />
<div>
@if(session()->has('message'))

{{session()->get('message')}}

@endif
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">


</div>
@if (Auth::user())
<form action="{{ url('search_room') }}" method="POST">
@else
<form action="{{ url('search_room_noId') }}" method="POST">
@endif

            @csrf


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

                <div x-data="{ numRooms: 1 }" class="mb-6">
                    <label for="numRooms" class="text-gray-900 dark:text-gray-100 mb-2 block">How many rooms would you need?</label>
                    <select id="numRooms" name="numRooms" x-model="numRooms" class="border p-2 rounded w-48 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template x-for="room in Array.from({ length: numRooms }, (_, i) => i + 1)" :key="room">
                            <div class="border p-4 rounded shadow-sm bg-gray-50">
                                <h4 class="text-gray-900 dark:text-gray-100 mb-2">Room <span x-text="room"></span></h4>
                                <div class="flex items-center">
                                    <label class="text-gray-900 dark:text-gray-100 mr-2">Guests:</label>
                                    <input type="number" :name="`rooms[${room}][places]`" min="1" value="1" class="border p-1 rounded w-16">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                @if ($errors->any())
                <div class=" text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                         @endforeach
                    </ul>
                </div>
                 @endif

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ml-4">
                        {{ __('Search for available room') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="flex items-center justify-start">
                <svg class="h-8 w-8 text-slate-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <p>Contact us for help to book more than 5 rooms.</p>
        </div>

    </div>
</x-app-layout>
