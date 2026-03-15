<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Maintenance Requests</h2>
            <a href="{{ route('maintenance-requests.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">New Request</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="space-y-4">
                @forelse($requests as $requestItem)
                    <div class="bg-white shadow-sm sm:rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $requestItem->title }}</h3>
                            <span class="text-xs px-2 py-1 rounded bg-gray-100">{{ $requestItem->status }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">House #{{ $requestItem->house->house_number }} | Priority: {{ $requestItem->priority }}</p>
                        <p class="text-gray-700">{{ $requestItem->description }}</p>

                        @if(!auth()->user()->isTenant())
                            <form method="POST" action="{{ route('maintenance-requests.update', $requestItem) }}" class="mt-3 flex gap-3 items-center">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="rounded-md border-gray-300">
                                    @foreach(['OPEN','IN_PROGRESS','RESOLVED','CLOSED'] as $status)
                                        <option value="{{ $status }}" @selected($requestItem->status === $status)>{{ $status }}</option>
                                    @endforeach
                                </select>
                                <button class="px-3 py-1 bg-indigo-600 text-white rounded-md" type="submit">Update</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-500">No maintenance requests found.</div>
                @endforelse
            </div>

            <div class="mt-4">{{ $requests->links() }}</div>
        </div>
    </div>
</x-app-layout>
