<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Booking</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('bookings.update', $booking) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id', $booking->user_id) == $user->id)>{{ $user->full_name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">House</label>
                        <select name="house_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach ($houses as $house)
                                <option value="{{ $house->id }}" @selected(old('house_id', $booking->house_id) == $house->id)>#{{ $house->house_number }} - {{ $house->house_type }}</option>
                            @endforeach
                        </select>
                        @error('house_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Booking Status</label>
                        <select name="booking_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @selected(old('booking_id', $booking->booking_id) == $status->id)>{{ $status->status }}</option>
                            @endforeach
                        </select>
                        @error('booking_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" type="submit">Update Booking</button>
                        <a href="{{ route('bookings.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
