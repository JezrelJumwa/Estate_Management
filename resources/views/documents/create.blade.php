<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Upload Document</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Document Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">File</label>
                        <input type="file" name="file" class="mt-1 block w-full" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">House (Optional)</label>
                        <select name="house_id" class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">None</option>
                            @foreach($houses as $house)
                                <option value="{{ $house->id }}" @selected(old('house_id') == $house->id)>#{{ $house->house_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Booking (Optional)</label>
                        <select name="house_booking_id" class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">None</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" @selected(old('house_booking_id') == $booking->id)>Booking #{{ $booking->id }} - House #{{ $booking->house->house_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Visibility</label>
                        <select name="visibility" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="PRIVATE">PRIVATE</option>
                            <option value="SHARED">SHARED</option>
                        </select>
                    </div>

                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
