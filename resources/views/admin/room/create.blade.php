<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <form method="POST" action="{{ route('room.store') }}">
        @csrf
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>

        <!-- Room Type -->
        <div class="mt-4">
            <x-input-label for="roomType" :value="__('Room Type')" />
            <select id="roomType" name="roomType" class="block mt-1 w-full" required>
                <option value="Solo" {{ old('roomType') == "Solo" ? 'selected' : '' }}>Solo</option>
                <option value="Double" {{ old('roomType') == "Double" ? 'selected' : '' }}>Double</option>
                <option value="Twin" {{ old('roomType') == "Twin" ? 'selected' : '' }}>Twin</option>
                <option value="Queen" {{ old('roomType') == "Queen" ? 'selected' : '' }}>Queen</option>
                <option value="Suite" {{ old('roomType') == "Suite" ? 'selected' : '' }}>Suite</option>
            </select>
            <x-input-error :messages="$errors->get('roomType')" class="mt-2" />
        </div>

        <!-- Places -->
        <div class="mt-4">
            <x-input-label for="places" :value="__('Number of Places')" />
            <x-text-input id="places" class="block mt-1 w-full" type="number" name="places" :value="old('places')" required min="1" />
            <x-input-error :messages="$errors->get('places')" class="mt-2" />
        </div>

        <!-- Places -->
        <div class="mt-4">
            <x-input-label for="beds" :value="__('Number of beds')" />
            <x-text-input id="beds" class="block mt-1 w-full" type="text" name="beds" :value="old('beds')"/>
            <x-input-error :messages="$errors->get('beds')" class="mt-2" />
        </div>


        <!-- Room Description -->
        <div class="mt-4">
            <x-input-label for="roomDesc" :value="__('Room Description')" />
            <textarea id="roomDesc" class="block mt-1 w-full" name="roomDesc" rows="4" required>{{ old('roomDesc') }}</textarea>
            <x-input-error :messages="$errors->get('roomDesc')" class="mt-2" />
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required min="0" step="0.01" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Room') }}
            </x-primary-button>
        </div>
    </form>
    </div>
</x-app-layout>
