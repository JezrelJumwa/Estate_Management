<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Houses</h2>
            @if (auth()->user()->isAdmin() || auth()->user()->isLandlord())
                <a href="{{ route('houses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add House</a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($houses as $house)
                    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                        @if ($house->image_url)
                            <img src="{{ $house->image_url }}" alt="House {{ $house->house_number }}" class="w-full h-44 object-cover">
                        @else
                            <div class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-400">No image</div>
                        @endif
                        <div class="p-4 space-y-2">
                            <h3 class="text-lg font-semibold text-gray-900">House #{{ $house->house_number }}</h3>
                            <p class="text-gray-600">{{ $house->house_type }}</p>
                            <p class="text-sm text-gray-500">Owner: {{ $house->landlord?->full_name ?? 'Unassigned' }}</p>
                            <p class="text-green-700 font-semibold">Ksh {{ number_format($house->rent, 2) }}</p>
                            <div class="flex items-center justify-between pt-2">
                                <a href="{{ route('houses.show', $house) }}" class="text-indigo-600 hover:text-indigo-800">View</a>
                                @if (auth()->user()->isAdmin() || auth()->user()->isLandlord())
                                    <div class="space-x-3">
                                        <a href="{{ route('houses.edit', $house) }}" class="text-amber-600 hover:text-amber-800">Edit</a>
                                        <form action="{{ route('houses.destroy', $house) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this house?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-3">No houses found.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $houses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
