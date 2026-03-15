<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">House Details</h2>
            <a href="{{ route('houses.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to Houses</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                @if ($house->image_url)
                    <img src="{{ $house->image_url }}" alt="House {{ $house->house_number }}" class="w-full h-72 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-900">House #{{ $house->house_number }}</h3>
                    <p class="text-gray-600 mt-1">{{ $house->house_type }}</p>
                    <p class="text-sm text-gray-500 mt-1">Owner: {{ $house->landlord?->full_name ?? 'Unassigned' }}</p>
                    <p class="text-green-700 font-semibold mt-2">Ksh {{ number_format($house->rent, 2) }}</p>
                    @if ($house->description)
                        <p class="mt-4 text-gray-700">{{ $house->description }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">Estate Assignments</h4>
                <div class="space-y-3">
                    @forelse ($house->estates as $estate)
                        <div class="border rounded-md p-3">
                            <p class="font-medium text-gray-900">{{ $estate->name }}</p>
                            <p class="text-sm text-gray-600">{{ $estate->location }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No estates linked to this house.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">Booking History</h4>
                <div class="space-y-3">
                    @forelse ($house->houseBookings as $booking)
                        <div class="flex items-center justify-between border rounded-md p-3">
                            <div>
                                <p class="font-medium text-gray-900">{{ $booking->user->full_name }}</p>
                                <p class="text-sm text-gray-600">{{ $booking->user->email }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded {{ $booking->booking->status === 'AVAILABLE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $booking->booking->status }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500">No bookings for this house.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
