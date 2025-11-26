@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $category->name }}</h1>
                <p class="text-gray-500">Slug: {{ $category->slug }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.categories.edit', $category->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:underline self-center">Back to
                    list</a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded p-6 space-y-4">
            @if ($category->primary_image)
                <div>
                    <p class="text-sm font-semibold text-gray-600">Primary Image</p>
                    <img src="{{ asset('categories/' . $category->primary_image) }}" alt="{{ $category->name }}"
                        class="mt-2 rounded border max-w-md" />
                </div>
            @endif

            <div>
                <p class="text-sm font-semibold text-gray-600">Description</p>
                <p class="mt-2 text-gray-800">
                    {{ $category->description ?? '—' }}
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Total Accounts</p>
                    <p class="text-lg font-bold">{{ $category->accounts->count() }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Created / Updated</p>
                    <p class="text-lg font-bold">
                        {{ $category->created_at?->format('Y-m-d H:i') }} /
                        {{ $category->updated_at?->format('Y-m-d H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
