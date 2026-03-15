<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Documents</h2>
            <a href="{{ route('documents.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Upload Document</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visibility</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($documents as $document)
                            <tr>
                                <td class="px-4 py-3">{{ $document->name }}</td>
                                <td class="px-4 py-3">{{ $document->user?->full_name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $document->visibility }}</td>
                                <td class="px-4 py-3"><a class="text-indigo-600 hover:text-indigo-800" href="{{ route('documents.download', $document) }}">Download</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No documents found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $documents->links() }}</div>
        </div>
    </div>
</x-app-layout>
