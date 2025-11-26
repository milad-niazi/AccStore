@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $account->title }}</h1>
                <p class="text-gray-500">Account #{{ $account->id }}</p>
            </div>
            <a href="{{ route('admin.accounts.index') }}" class="text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="bg-white shadow-md rounded p-6 space-y-6">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Category</p>
                    <p class="text-lg font-bold">{{ $account->category?->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Price</p>
                    <p class="text-lg font-bold">${{ number_format($account->price, 2) }}</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Username</p>
                    <p class="text-lg font-bold">{{ $account->username }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Password</p>
                    <p class="text-lg font-bold">{{ $account->password }}</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Status</p>
                    <span
                        class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold {{ $account->status === 'sold' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                        {{ ucfirst($account->status) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Buyer</p>
                    <p class="text-lg font-bold">{{ $account->buyer?->name ?? '—' }}</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Sold At</p>
                    <p class="text-lg font-bold">
                        {{ $account->sold_at ? \Illuminate\Support\Carbon::parse($account->sold_at)->format('Y-m-d H:i') : '—' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Expires At</p>
                    <p class="text-lg font-bold">
                        {{ $account->expires_at ? \Illuminate\Support\Carbon::parse($account->expires_at)->format('Y-m-d H:i') : '—' }}
                    </p>
                </div>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-600">Description</p>
                <p class="mt-2 text-gray-800">
                    {{ $account->description ?? '—' }}
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Created At</p>
                    <p class="text-lg font-bold">
                        {{ $account->created_at ? \Illuminate\Support\Carbon::parse($account->created_at)->format('Y-m-d H:i') : '—' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Updated At</p>
                    <p class="text-lg font-bold">
                        {{ $account->updated_at ? \Illuminate\Support\Carbon::parse($account->updated_at)->format('Y-m-d H:i') : '—' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
