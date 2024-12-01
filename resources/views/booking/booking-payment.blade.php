<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <p class="text-gray-600">
                    You are about to pay <strong>{{ $totalPrice }} NOK</strong> for your stay from
                    <br><strong>{{ $userCheckIn }}</strong> to <strong>{{ $userCheckOut }}</strong>.
                </p>
                <p class="text-gray-600 mt-2">Select your payment method below:</p>
            </div>
            <form action="{{ url('processing_payment') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="userCheckIn" value="{{ $userCheckIn }}">
                <input type="hidden" name="userCheckOut" value="{{ $userCheckOut }}">
                <input type="hidden" name="selectedRooms" value="{{ implode(',', $selectedRooms) }}">


                <div class="p-4 ">
                    <select name="payment" id="payment">
                        <option name="Dummycard" id="dummycard">Visa</option>
                        <option name="Dummycard" id="dummycard">Mastercard</option>
                        <option name="Dummycard" id="dummycard">Other Card</option>
                    </select>
                </div>
                <div class="p-4 ">
                    <input type="text" placeholder="Card details">
                    <input type="text" placeholder="Card details">
                </div>


                        <x-primary-button class="ms-3">
                            Confirm payment
                        </x-primary-button>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
