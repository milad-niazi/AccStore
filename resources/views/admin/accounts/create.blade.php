@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Add Account</h1>
            <a href="{{ route('admin.accounts.index') }}" class="text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="bg-white shadow-md rounded p-6">
            <form action="{{ route('admin.accounts.store') }}" method="POST">
                @include('admin.accounts._form', ['submitLabel' => 'Create', 'categories' => $categories])
            </form>
        </div>
    </div>
@endsection
