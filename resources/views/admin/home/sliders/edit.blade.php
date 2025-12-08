@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        <h1 class="text-2xl font-bold mb-6">Edit Slider</h1>

        <div class="bg-white p-6 rounded shadow-md max-w-2xl">

            <form action="{{ route('admin.homepage.sliders.update', $slider->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                        class="w-full border rounded px-3 py-2" placeholder="Enter title">
                </div>

                {{-- Subtitle --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}"
                        class="w-full border rounded px-3 py-2" placeholder="Enter subtitle">
                </div>

                {{-- Button Text --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Button Text</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                        class="w-full border rounded px-3 py-2" placeholder="Enter button text">
                </div>

                {{-- Button URL --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Button URL</label>
                    <input type="text" name="button_url" value="{{ old('button_url', $slider->button_url) }}"
                        class="w-full border rounded px-3 py-2" placeholder="Enter button link">
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="block font-medium mb-2">Image</label>

                    @if ($slider->image)
                        <img src="{{ asset('storage/' . $slider->image) }}" class="h-24 rounded mb-3">
                    @endif

                    <input type="file" name="image" class="w-full border rounded px-3 py-2">
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Status</label>
                    <select name="is_active" class="w-full border rounded px-3 py-2">
                        <option value="1" {{ $slider->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$slider->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.homepage.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update Slider
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
