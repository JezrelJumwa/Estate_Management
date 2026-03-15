<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estates</h2>
            <a href="{{ route('estates.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add Estate</a>
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
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estate</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">House</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($estates as $estate)
                            <tr>
                                <td class="px-4 py-3">{{ $estate->name }}</td>
                                <td class="px-4 py-3">{{ $estate->location }}</td>
                                <td class="px-4 py-3">#{{ $estate->house->house_number }} - {{ $estate->house->house_type }}</td>
                                <td class="px-4 py-3 text-right space-x-3">
                                    <a href="{{ route('estates.show', $estate) }}" class="text-indigo-600 hover:text-indigo-800">View</a>
                                    <a href="{{ route('estates.edit', $estate) }}" class="text-amber-600 hover:text-amber-800">Edit</a>
                                    <form action="{{ route('estates.destroy', $estate) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this estate?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">No estates found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $estates->links() }}</div>
        </div>
    </div>
</x-app-layout>
