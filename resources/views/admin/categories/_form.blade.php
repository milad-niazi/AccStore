@php
    $category = $category ?? null;
@endphp

@csrf
@if (!empty($category))
    @method('PUT')
@endif

<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            value="{{ old('name', $category->name ?? '') }}" required maxlength="255" />
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" id="description" rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Optional description...">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="primary_image" class="block text-sm font-medium text-gray-700">Primary Image</label>
        <input type="file" name="primary_image" id="primary_image"
            class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-white file:font-semibold hover:file:bg-blue-700" />
        @error('primary_image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if (!empty($category?->primary_image))
            <p class="mt-2 text-sm text-gray-600">Current image:</p>
            <img src="{{ asset('categories/' . $category->primary_image) }}" alt="{{ $category->name }}"
                class="mt-1 h-32 rounded border" />
        @endif
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit"
        class="bg-blue-600 px-5 py-2 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        {{ $submitLabel ?? 'Save' }}
    </button>
    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
</div>
