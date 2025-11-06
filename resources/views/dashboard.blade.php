<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Users</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Houses -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Houses</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $totalHouses }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Estates -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Estates</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $totalEstates }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Bookings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Bookings</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $totalBookings }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Houses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Houses</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($recentHouses as $house)
                            <div class="border rounded-lg p-4 hover:shadow-md transition">
                                @if($house->file_path)
                                    <img src="{{ Storage::url($house->file_path) }}" alt="House {{ $house->house_number }}" class="w-full h-32 object-cover rounded mb-2">
                                @else
                                    <div class="w-full h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                @endif
                                <h4 class="font-semibold text-gray-900">House #{{ $house->house_number }}</h4>
                                <p class="text-sm text-gray-600">{{ $house->house_type }}</p>
                                <p class="text-lg font-bold text-green-600 mt-2">Ksh {{ number_format($house->rent, 2) }}</p>
                                <a href="{{ route('houses.show', $house) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-2 inline-block">View Details →</a>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-3">No houses available yet.</p>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('houses.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">View All Houses →</a>
                    </div>
                </div>
            </div>

            <!-- Recent Users and Bookings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Users</h3>
                        <div class="space-y-3">
                            @forelse($recentUsers as $user)
                                <div class="flex items-center justify-between border-b pb-3">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $user->full_name }}</p>
                                        <p class="text-sm text-gray-600">{{ $user->systemRole->name }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded {{ $user->status->name == 'ACTIVE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $user->status->name }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500">No users available yet.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('users.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">View All Users →</a>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Bookings</h3>
                        <div class="space-y-3">
                            @forelse($recentBookings as $booking)
                                <div class="border-b pb-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $booking->user->full_name }}</p>
                                            <p class="text-sm text-gray-600">House #{{ $booking->house->house_number }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded {{ $booking->booking->status == 'AVAILABLE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $booking->booking->status }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No bookings available yet.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">View All Bookings →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
