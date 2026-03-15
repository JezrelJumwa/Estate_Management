<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit House</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('houses.update', $house) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">House Number</label>
                            <input type="number" name="house_number" value="{{ old('house_number', $house->house_number) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @error('house_number') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rent (Ksh)</label>
                            <input type="number" step="0.01" min="0" name="rent" value="{{ old('rent', $house->rent) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @error('rent') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">House Type</label>
                            <input type="text" name="house_type" value="{{ old('house_type', $house->house_type) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @error('house_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        @if (auth()->user()->isAdmin())
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Landlord</label>
                                <select name="landlord_id" class="mt-1 block w-full rounded-md border-gray-300">
                                    <option value="">No landlord assigned</option>
                                    @foreach ($landlords as $landlord)
                                        <option value="{{ $landlord->id }}" @selected(old('landlord_id', $house->landlord_id) == $landlord->id)>{{ $landlord->full_name }} ({{ $landlord->email }})</option>
                                    @endforeach
                                </select>
                                @error('landlord_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        @endif
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300">{{ old('description', $house->description) }}</textarea>
                            @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Replace Image</label>
                            <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-700">
                            @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" type="submit">Update House</button>
                        <a href="{{ route('houses.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
