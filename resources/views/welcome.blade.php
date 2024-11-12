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
                    <form method="POST" action="">
                        <label for="check-in" class="text-gray-900 dark:text-gray-100">Check in</label>
                        <input type="date" name="check-in">
                        <label for="check-out" class="text-gray-900 dark:text-gray-100">Check out</label>
                        <input type="date" name="check-out">
                        <label for="rooms" class="text-gray-900 dark:text-gray-100">Rooms</label>
                        <input type="number" name="rooms" value="1" min="1">
                        <label for="people" class="text-gray-900 dark:text-gray-100">People</label>
                        <input type="number" name="people" value="1" min="1">
                        <input id="searchAvailableRooms" type="submit" value="Search">
                    </form>
                </div>
            </div>
        </div>

        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Midlertidig bilde -->
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
    </div>
</x-app-layout>
