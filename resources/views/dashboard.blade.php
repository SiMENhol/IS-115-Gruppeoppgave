<style>
    label {
        margin: 10px;
    }
    input[type=date] {
        min-width: 200px;
    }
    input[type=number] {
        max-width: 100px;
    }
    form {
        margin: 0;
    }
    #searchAvailableRooms {
        border: 2px solid white;
        border-radius: 5px;
        padding: 8px 30px;
        background-color: #007D93;
        color: white;
        font-weight: bold;
        cursor: pointer;
        float: right;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (Auth::user())
                Welcome back {{ Auth::user()->name }}!
            @else
                Welcome!
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ url('search_room') }}" method="POST">
                        @csrf


                        <div class="mt-4 flex items-center space-x-4">
                            <label for="checkInDato" class="text-gray-900 dark:text-gray-100">From:</label>
                            <input type="date" id="checkInDato" name="checkInDato" class="border p-1 rounded w-48" required>



                            <label for="checkOutDato" class="text-gray-900 dark:text-gray-100">To:</label>
                            <input type="date" id="checkOutDato" name="checkOutDato" class="border p-1 rounded w-48" required>
                        </div>


                        <div x-data="{ numRooms: 1 }" class="mb-6 mt-4">
                            <label for="numRooms" class="text-gray-900 dark:text-gray-100">How many rooms would you need?:</label>
                            <select id="numRooms" name="numRooms" x-model="numRooms" class="border p-2 rounded w-48">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            <div class="mt-4 space-y-4 border p-2 rounded w-48">
                                <template x-for="room in Array.from({ length: numRooms }, (_, i) => i + 1)" :key="room">
                                    <div class="border p-4 rounded shadow-sm">
                                        <h4 class="text-gray-900 dark:text-gray-100">Room <span x-text="room"></span></h4>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <label class="text-gray-900 dark:text-gray-100">Guests:</label>
                                            <input type="number" :name="`rooms[${room}][places]`" min="1" value="1" class="border p-1 rounded w-16">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>


                        <button type="submit" id="searchAvailableRooms" >
                            Look for room
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            <img style="width:100%; height:500px;" src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/257878219.jpg?k=96661c8471677c814e6df155d529c64ad61692dfc07e74c47dd6a079dbf87799&o=&hp=1">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Fjordview Hotel: Where breathtaking views meet unparalleled comfort.
                </h2>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                Welcome to Fjordview Hotel, nestled in the heart of Norway’s stunning fjords. Located in the charming town of Bergen, our hotel offers a perfect blend of modern comfort and breathtaking natural beauty. Whether you're here to explore the surrounding mountains, unwind by the water, or enjoy our world-class amenities, Fjordview Hotel ensures an unforgettable stay. Relax in our spacious rooms, dine at our gourmet restaurant, and experience the tranquility of Norwegian nature. We look forward to welcoming you to a truly remarkable getaway.
            </div>
        </div>
    </div>

    <br>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>Upcoming stays</p>
            </div>
        </div>
    </div>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>Previous stays</p>
            </div>
        </div>
    </div>
    <br>
</x-app-layout>







