<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Estate</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('estates.update', $estate) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estate Name</label>
                        <input type="text" name="name" value="{{ old('name', $estate->name) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ old('location', $estate->location) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                        @error('location') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">House</label>
                        <select name="house_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach ($houses as $house)
                                <option value="{{ $house->id }}" @selected(old('house_id', $estate->house_id) == $house->id)>#{{ $house->house_number }} - {{ $house->house_type }}</option>
                            @endforeach
                        </select>
                        @error('house_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" type="submit">Update Estate</button>
                        <a href="{{ route('estates.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
