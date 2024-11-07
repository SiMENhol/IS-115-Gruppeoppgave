<x-app-layout>
    <form method="POST" action="{{ route('room.store') }}" >
        @csrf
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>
        <!-- Room Type -->
        <div>
            <x-input-label for="roomType" :value="__('Room Type')" />
            <select id="roomType" name="roomType" class="block mt-1 w-full" required autofocus>
                <option value="Solo" {{ old('roomType') == "Solo" ? 'selected' : '' }}>Solo</option>
                <option value="Double" {{ old('roomType') == "Double" ? 'selected' : '' }}>Double</option>
                <option value="Queen" {{ old('roomType') == "Queen" ? 'selected' : '' }}>Queen</option>
                <option value="Suite" {{ old('roomType') == "Suite" ? 'selected' : '' }}>Suite</option>
            </select>
            <x-input-error :messages="$errors->get('roomType')" class="mt-2" />
        </div>

        <!-- Places -->
        <div class="mt-4">
            <x-input-label for="places" :value="__('Places')" />
            <x-text-input id="places" class="block mt-1 w-full" type="number" name="places" :value="old('places')" required />
            <x-input-error :messages="$errors->get('places')" class="mt-2" />
        </div>

        <!-- Room Status -->
        <div class="mt-4">
            <x-input-label for="roomStatus" :value="__('Room Status')" />
            <select id="roomStatus" name="roomStatus" class="block mt-1 w-full" required>
                <option value="0" {{ old('roomStatus') == 0 ? 'selected' : '' }}>Available</option>
                <option value="1" {{ old('roomStatus') == 1 ? 'selected' : '' }}>Booked</option>
                <option value="2" {{ old('roomStatus') == 2 ? 'selected' : '' }}>Cleaning</option>
                <option value="3" {{ old('roomStatus') == 3 ? 'selected' : '' }}>Closed</option>
            </select>
            <x-input-error :messages="$errors->get('roomStatus')" class="mt-2" />
        </div>

        <!-- Room Description -->
        <div class="mt-4">
            <x-input-label for="roomDesc" :value="__('Room Description')" />
            <textarea x-model id="roomDesc" class="block mt-1 w-full" name="roomDesc" rows="4" :value="old('roomDesc')" required></textarea>
            <x-input-error :messages="$errors->get('roomDesc')" class="mt-2" />
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>


        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Room') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
