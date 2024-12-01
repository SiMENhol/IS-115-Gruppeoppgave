<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-700">Booking Complete</h2>
                <p class="text-gray-600 mt-2">Your booking has been successfully completed.</p>
            </div>


                <div class="p-6 border-b">

                    <p><strong>You can check-in from:</strong> {{ $checkIn }} <strong>15:00</strong></p>
                    <p><strong>You will have the room(s) until :</strong> {{ $checkOut }} <strong>12:00</strong></p>
                    <p><strong>Hope you have wonderful stay!</strong> </p>
                </div>
                <div class="p-4 flex justify-center" >
                <x-primary-button class="ms-3">
                    <a href="{{ route('dashboard') }}" class="text-white no-underline">
                        Go back to Dashboard
                    </a>
                </x-primary-button>
                </div>

        </div>
    </div>
</x-app-layout>
