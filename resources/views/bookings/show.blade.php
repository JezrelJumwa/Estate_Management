<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Booking Details</h2>
            <a href="{{ route('bookings.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to Bookings</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">User</p>
                    <p class="text-gray-900">{{ $booking->user->full_name }} ({{ $booking->user->email }})</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">House</p>
                    <p class="text-gray-900">#{{ $booking->house->house_number }} - {{ $booking->house->house_type }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Booking Status</p>
                    <span class="inline-block px-2 py-1 text-xs rounded {{ $booking->booking->status === 'AVAILABLE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $booking->booking->status }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Created At</p>
                    <p class="text-gray-900">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
