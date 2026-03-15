<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estate Details</h2>
            <a href="{{ route('estates.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to Estates</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Estate Name</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $estate->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Location</p>
                    <p class="text-gray-900">{{ $estate->location }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Assigned House</p>
                    <p class="text-gray-900">#{{ $estate->house->house_number }} - {{ $estate->house->house_type }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
