<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-700">Booking Complete</h2>
                <p class="text-gray-600 mt-2">Your booking has been successfully completed.</p>
            </div>

            @foreach ($reservations as $reservation)
                <div class="p-6 border-b">
                    <p><strong>Room ID:</strong> {{ $reservation->roomId }}</p>
                    <p><strong>Check-In:</strong> {{ $checkIn }}</p>
                    <p><strong>Check-Out:</strong> {{ $checkOut }}</p>
                    <p><strong>Status:</strong> {{ $reservation->reservationStatus }}</p>
                </div>
            @endforeach

            <div class="p-6">
                <a href="{{ route('dashboard') }}" >
                    Go to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
