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
    <x-input-label style="font-size:40px" value="Find your room!" />
<div>
@if(session()->has('message'))

{{session()->get('message')}}

@endif
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">


</div>
        <form action="{{ url('search_room') }}" method="POST">

                @csrf



                        <!-- Places -->
        <div class="mt-4">
            <x-input-label for="places" :value="__('How many guests are you?')" />
            <x-text-input id="places" class="block mt-1 w-full" type="number" name="places" :value="old('places')" required />
            <x-input-error :messages="$errors->get('places')" class="mt-2" />
        </div>




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

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Search for available room') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
