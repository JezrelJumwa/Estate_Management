<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Advanced Reporting</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-semibold text-emerald-700">Ksh {{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Paid Payments</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $paidPayments }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Pending Maintenance</p>
                    <p class="text-2xl font-semibold text-amber-700">{{ $pendingMaintenance }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Occupied Houses</p>
                    <p class="text-2xl font-semibold text-indigo-700">{{ $occupiedHouses }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('reports.payments.csv') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Export Payments CSV</a>
            </div>
        </div>
    </div>
</x-app-layout>
