<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Make Payment</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('payments.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Related Booking (Optional)</label>
                        <select name="house_booking_id" class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">No related booking</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" @selected(old('house_booking_id') == $booking->id)>Booking #{{ $booking->id }} - House #{{ $booking->house->house_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Amount</label>
                        <input type="number" step="0.01" min="1" name="amount" value="{{ old('amount') }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select name="payment_method" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="MOBILE_MONEY">Mobile Money</option>
                            <option value="CARD">Card</option>
                            <option value="BANK_TRANSFER">Bank Transfer</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" type="submit">Pay Now</button>
                        <a href="{{ route('payments.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
