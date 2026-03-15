<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Details</h2>
            <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to Users</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><dt class="text-sm text-gray-500">Name</dt><dd class="text-gray-900">{{ $user->full_name }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Email</dt><dd class="text-gray-900">{{ $user->email }}</dd></div>
                    <div><dt class="text-sm text-gray-500">ID Number</dt><dd class="text-gray-900">{{ $user->id_number }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Gender</dt><dd class="text-gray-900">{{ $user->gender }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Role</dt><dd class="text-gray-900">{{ $user->systemRole->name }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Status</dt><dd class="text-gray-900">{{ $user->status->name }}</dd></div>
                </dl>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking History</h3>
                <div class="space-y-3">
                    @forelse ($user->houseBookings as $booking)
                        <div class="flex items-center justify-between border rounded-md p-3">
                            <div>
                                <p class="font-medium text-gray-900">House #{{ $booking->house->house_number }}</p>
                                <p class="text-sm text-gray-600">{{ $booking->house->house_type }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded {{ $booking->booking->status === 'AVAILABLE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $booking->booking->status }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500">No bookings for this user yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
