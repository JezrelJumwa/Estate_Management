<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bookings</h2>
            <a href="{{ route('bookings.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Create Booking</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">House</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bookings as $entry)
                            <tr>
                                <td class="px-4 py-3">{{ $entry->user->full_name }}</td>
                                <td class="px-4 py-3">#{{ $entry->house->house_number }} - {{ $entry->house->house_type }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded {{ $entry->booking->status === 'AVAILABLE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $entry->booking->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right space-x-3">
                                    <a href="{{ route('bookings.show', $entry) }}" class="text-indigo-600 hover:text-indigo-800">View</a>
                                    <a href="{{ route('bookings.edit', $entry) }}" class="text-amber-600 hover:text-amber-800">Edit</a>
                                    <form action="{{ route('bookings.destroy', $entry) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this booking?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $bookings->links() }}</div>
        </div>
    </div>
</x-app-layout>
