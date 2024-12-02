<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <form method="POST" action="{{ route('room.update', ['roomId' => $room->roomId]) }}">
        @csrf
        @method('patch')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>
        <!-- Room ID (Display Only) -->
        <div class="mt-4">
            <x-input-label for="roomId" :value="__('Room ID')" />
            <x-text-input id="roomId" class=" mt-1 w-full" type="number" name="roomId" :value="$room->roomId" readonly />
            <x-input-error :messages="$errors->get('roomId')" class="mt-2" />
        </div>
        <!-- Room Type -->
        <div class="mt-4">
            <x-input-label for="roomType" :value="__('Room Type')" />
            <select id="roomType" name="roomType" class="block mt-1 w-full" required>
                <option value="Solo" {{ $room->roomType == "Solo" ? 'selected' : '' }}>Solo</option>
                <option value="Double" {{ $room->roomType == "Double" ? 'selected' : '' }}>Double</option>
                <option value="Twin" {{ $room->roomType == "Twin" ? 'selected' : '' }}>Twin</option>
                <option value="Queen" {{ $room->roomType == "Queen" ? 'selected' : '' }}>Queen</option>
                <option value="Suite" {{ $room->roomType == "Suite" ? 'selected' : '' }}>Suite</option>
            </select>
            <x-input-error :messages="$errors->get('roomType')" class="mt-2" />
        </div>

        <!-- Places -->
        <div class="mt-4">
            <x-input-label for="places" :value="__('Number of Places')" />
            <x-text-input id="places" class="block mt-1 w-full" type="number" name="places" :value="$room->places" required min="1" />
            <x-input-error :messages="$errors->get('places')" class="mt-2" />
        </div>

        <!-- Places -->
        <div class="mt-4">
            <x-input-label for="beds" :value="__('Number of beds')" />
            <x-text-input id="beds" class="block mt-1 w-full" type="text" name="beds" :value="$room->beds" required min="1" />
            <x-input-error :messages="$errors->get('beds')" class="mt-2" />
        </div>


        <!-- Room Description -->
        <div class="mt-4">
            <x-input-label for="roomDesc" :value="__('Room Description')" />
            <textarea x-model id="roomDesc" class="block mt-1 w-full" name="roomDesc" rows="4">{{ $room->roomDesc }}</textarea>
            <x-input-error :messages="$errors->get('roomDesc')" class="mt-2" />
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="$room->price" required min="0" step="0.01" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
    </form>
        </div>
    </div>
</x-app-layout>
