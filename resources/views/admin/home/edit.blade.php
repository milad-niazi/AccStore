@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Edit Category</h1>
                <p class="text-gray-500">Updating: {{ $category->name }}</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="bg-white shadow-md rounded p-6">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @include('admin.categories._form', ['submitLabel' => 'Update', 'category' => $category])
            </form>
        </div>
    </div>
@endsection
