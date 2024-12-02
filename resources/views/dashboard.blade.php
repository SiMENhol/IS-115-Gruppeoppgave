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
                    @if (Auth::user())
                        <form action="{{ url('search_room') }}" method="POST" x-data="{ numRooms: 1 }" class="flex flex-col gap-4">
                    @else
                        <form action="{{ url('search_room_noId') }}" method="POST" x-data="{ numRooms: 1 }" class="flex flex-col gap-4">
                    @endif
                        @csrf
                        <!-- Main Input Row -->
                        <div class="flex flex-wrap items-center gap-4">
                            <!-- Check-in Date -->
                            <div class="flex items-center space-x-2">
                                <label for="checkInDato" class="text-gray-900 dark:text-gray-100">Check in:</label>
                                <input id="checkInDato" class="border rounded p-2 w-36" type="date" name="checkInDato" value="{{ old('checkInDato') }}" required />
                            </div>

                            <!-- Check-out Date -->
                            <div class="flex items-center space-x-2">
                                <label for="checkOutDato" class="text-gray-900 dark:text-gray-100">Check out:</label>
                                <input id="checkOutDato" class="border rounded p-2 w-36" type="date" name="checkOutDato" value="{{ old('checkOutDato') }}" required />
                            </div>

                            <!-- Number of Rooms -->
                            <div class="flex items-center space-x-2">
                                <label for="numRooms" class="text-gray-900 dark:text-gray-100">Rooms:</label>
                                <select id="numRooms" name="numRooms" x-model="numRooms" class="border p-2 rounded w-32">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Search Button -->
                            <div class="ml-auto">
                                <button type="submit" id="searchAvailableRooms" class="bg-blue-500 text-white rounded p-2 px-4 hover:bg-blue-600">
                                    Search
                                </button>
                            </div>
                        </div>

                        <!-- Dynamic Guests Per Room -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                            <template x-for="room in Array.from({ length: numRooms }, (_, i) => i + 1)" :key="room">
                                <div class="border p-4 rounded shadow-sm bg-gray-50">
                                    <h4 class="text-gray-900 mb-2">Room <span x-text="room"></span></h4>
                                    <div class="flex items-center">
                                        <label class="text-gray-900 mr-2">Guests:</label>
                                        <input type="number" :name="`rooms[${room}][places]`" min="1" value="1" class="border p-1 rounded w-16">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>

    <section class="relative bg-gray-900 text-white">
        <!-- Hero Section -->
        <div class="relative">
            <img
                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/257878219.jpg?k=96661c8471677c814e6df155d529c64ad61692dfc07e74c47dd6a079dbf87799&o=&hp=1"
                alt="Hotel Exterior"
                class="w-full h-[500px] object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-gray-900/90 flex flex-col justify-center items-center">
                <h1 class="text-xl md:text-6xl font-bold tracking-wide">Fjordview Hotel</h1>
                <p class="text-lg md:text-xl mt-2">Your luxury getaway in the heart of Norway.</p>

                <x-nav-link :href="route('roomInformation.index')" :active="request()->routeIs('roomInformation.index')"
                    class="mt-6 px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center"
                >
                    <span class="mt-2 text-white">Explore Rooms</span>
                </x-nav-link>
                </button>
            </div>
        </div>

        <!-- Key Features Section -->
        <div class="max-w-7xl mx-auto py-12 px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="flex flex-col items-center text-center">
                <svg class="h-12 w-12 mb-4 mt-4" fill="currentColor" width="35" height="35" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M5 10C3.347656 10 2 11.347656 2 13L2 26.8125C3.296875 25.6875 4.9375 24.777344 7 24.0625L7 20C7 17.339844 11.542969 17 15.5 17C19.457031 17 24 17.339844 24 20L24 22C24.335938 21.996094 24.65625 22 25 22C25.34375 22 25.664063 21.996094 26 22L26 20C26 17.339844 30.542969 17 34.5 17C38.457031 17 43 17.339844 43 20L43 24.03125C45.058594 24.742188 46.691406 25.671875 48 26.8125L48 13C48 11.347656 46.652344 10 45 10 Z M 25 24C5.90625 24 -0.015625 27.53125 0 37L50 37C50.015625 27.46875 44.09375 24 25 24 Z M 0 39L0 50L7 50L7 46C7 44.5625 7.5625 44 9 44L41 44C42.4375 44 43 44.5625 43 46L43 50L50 50L50 39Z"></path>
                    </g>
                </svg>
                <h3 class="text-xl font-semibold">Luxury Rooms</h3>
                <p class="text-gray-400 mt-2">Enjoy spacious, elegantly designed rooms with stunning views.</p>
            </div>

            <!-- Feature 2 -->
            <div class="flex flex-col items-center text-center">
                <svg class="h-12 w-12 mb-4 mt-4" fill="currentColor" width="35" height="35" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M12 16.114c-3.998-5.951-8.574-7.043-8.78-7.09L2 8.75V10c0 7.29 3.925 12 10 12 5.981 0 10-4.822 10-12V8.75l-1.22.274c-.206.047-4.782 1.139-8.78 7.09z"></path>
                        <path d="M11.274 3.767c-1.799 1.898-2.84 3.775-3.443 5.295 1.329.784 2.781 1.943 4.159 3.685 1.364-1.76 2.826-2.925 4.17-3.709-.605-1.515-1.646-3.383-3.435-5.271L12 3l-.726.767z"></path>
                    </g>
                </svg>
                <h3 class="text-xl font-semibold">Exclusive Spa</h3>
                <p class="text-gray-400 mt-2">Relax and rejuvenate in our world-class wellness center.</p>
            </div>

            <!-- Feature 3 -->
            <div class="flex flex-col items-center text-center">
                <svg class="h-12 w-12 mb-4 mt-4" fill="currentColor" width="35" height="35" viewBox="0 0 15 15" version="1.1" id="restaurant" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path id="path11774" d="M3.5,0l-1,5.5c-0.1464,0.805,1.7815,1.181,1.75,2L4,14c-0.0384,0.9993,1,1,1,1s1.0384-0.0007,1-1L5.75,7.5c-0.0314-0.8176,1.7334-1.1808,1.75-2L6.5,0H6l0.25,4L5.5,4.5L5.25,0h-0.5L4.5,4.5L3.75,4L4,0H3.5z M12,0c-0.7364,0-1.9642,0.6549-2.4551,1.6367C9.1358,2.3731,9,4.0182,9,5v2.5c0,0.8182,1.0909,1,1.5,1L10,14c-0.0905,0.9959,1,1,1,1s1,0,1-1V0z"></path>
                    </g>
                </svg>
                <h3 class="text-xl font-semibold">Fine Dining</h3>
                <p class="text-gray-400 mt-2">Savor culinary excellence at our on-site gourmet restaurant.</p>
            </div>
        </div>
    </section>

    <br>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p class="font-semibold text-2xl mb-4">Upcoming Stays</p>

                @php
                    $hasUpcomingStays = false;
                @endphp

                @foreach ($booking as $book)
                    @if (Auth::user() && $book->userId === Auth::user()->id && time() < strtotime($book->checkOutDato))
                        @php
                            $hasUpcomingStays = true;
                        @endphp
                        <div class="mb-6 p-4 border rounded-lg shadow-md bg-gray-100 dark:bg-gray-900">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        Fjordview Hotel
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ Carbon\Carbon::parse($book->checkInDato)->format('l, d F Y') }}
                                        - {{ Carbon\Carbon::parse($book->checkOutDato)->format('l, d F Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Duration: {{ Carbon\Carbon::parse($book->checkInDato)->diffInDays(Carbon\Carbon::parse($book->checkOutDato)) }} nights
                                    </p>
                                </div>
                                <div class="ml-auto">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 text-right">
                                        Check in from 15:00<br>
                                        Check out 12:00
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-semibold">Rooms:</span> {{ $book->numRooms }} |
                                        <span class="font-semibold">Guests:</span> {{ $book->totalGuests ?? 'N/A' }}
                                    </p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-semibold">Total Price:</span> {{ number_format($book->totalPrice ?? 0, 2) }} NOK
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-auto">
                                    Call us if you expect to arrive later than 22:00
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (!$hasUpcomingStays)
                    <h4 class="px-4 font-medium text-gray-900 dark:text-gray-100">
                        No upcoming stays
                    </h4>
                @endif
            </div>
        </div>
    </div>

    <br>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p class="font-semibold text-2xl mb-4">Previous Stays</p>

                @php
                    $hasPreviousStays = false;
                @endphp

                <div class="divide-y divide-gray-300 dark:divide-gray-700">
                    @foreach ($booking as $book)
                        @if (Auth::user() && $book->userId === Auth::user()->id && time() > strtotime($book->checkOutDato))
                            @php
                                $hasPreviousStays = true;
                            @endphp
                            <div class="py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                            Fjordview Hotel
                                        </h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ Carbon\Carbon::parse($book->checkInDato)->format('d M Y') }}
                                            - {{ Carbon\Carbon::parse($book->checkOutDato)->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Duration: {{ Carbon\Carbon::parse($book->checkInDato)->diffInDays(Carbon\Carbon::parse($book->checkOutDato)) }} nights
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-semibold">Total Cost:</span>
                                            {{ number_format($book->totalPrice ?? 0, 2) }} NOK
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if (!$hasPreviousStays)
                        <h4 class="px-4 font-medium text-gray-900 dark:text-gray-100">
                            No previous stays
                        </h4>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br>
</x-app-layout>







