@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-gray-500">User ID: {{ $user->id }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="bg-white shadow-md rounded p-6 space-y-6">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Name</p>
                    <p class="text-lg font-bold text-gray-900">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Email</p>
                    <p class="text-lg font-bold text-gray-900">{{ $user->email }}</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Created At</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $user->created_at?->format('Y-m-d H:i') ?? '—' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Last Updated</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $user->updated_at?->format('Y-m-d H:i') ?? '—' }}
                    </p>
                </div>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-600">Status</p>
                <p class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold
                    {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                    {{ ucfirst($user->status ?? 'unknown') }}
                </p>
            </div>
        </div>
    </div>
@endsection
