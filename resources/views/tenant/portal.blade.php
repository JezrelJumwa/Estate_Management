<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.tenant_portal') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Active Bookings</p>
                    <p class="text-2xl font-semibold">{{ $bookings->count() }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Maintenance Requests</p>
                    <p class="text-2xl font-semibold">{{ $maintenanceRequests->count() }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Payments</p>
                    <p class="text-2xl font-semibold">{{ $payments->count() }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Documents</p>
                    <p class="text-2xl font-semibold">{{ $documents->count() }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('bookings.index') }}" class="px-3 py-2 bg-gray-100 rounded-md">My Bookings</a>
                    <a href="{{ route('payments.create') }}" class="px-3 py-2 bg-gray-100 rounded-md">Pay Rent</a>
                    <a href="{{ route('maintenance-requests.create') }}" class="px-3 py-2 bg-gray-100 rounded-md">Request Maintenance</a>
                    <a href="{{ route('documents.index') }}" class="px-3 py-2 bg-gray-100 rounded-md">My Documents</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
