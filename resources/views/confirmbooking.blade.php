<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @if ($errors)

@foreach ($errors->all() as $errors )
<li>
    {{$errors}}
    </li>

@endforeach

@endif

<div class="">
    <x-input-label style="font-size:40px" value="Booking the room" />
<div>
@if(session()->has('message'))

{{session()->get('message')}}

@endif
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">


</div>
            <form action="{{ url('add_booking') }}" method="POST">
                @csrf

                <!-- User ID -->
                <div class="mt-4">
                    <x-text-input id="userId" class="mt-4 bg-primary d-inline-block" type="text" name="userId" :value="Auth::user()->id" />
                </div>

                <!-- Room ID -->
                <div class="mt-4">
                    <x-text-input id="roomId" class="block mt-1 w-full" type="text" name="roomId" :value="$roomId" />
                </div>

                <!-- Check-In Date -->
                <div class="mt-4">
                    <x-input-label for="checkInDato" :value="__('Check-In Date')" />
                    <x-text-input id="checkInDato" class="block mt-1 w-full" type="date" name="checkInDato" :value="$userCheckIn"  />
                </div>

                <!-- Check-Out Date -->
                <div class="mt-4">
                    <x-input-label for="checkOutDato" :value="__('Check-Out Date')" />
                    <x-text-input id="checkOutDato" class="block mt-1 w-full" type="date" name="checkOutDato" :value="$userCheckOut" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Add Booking') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
