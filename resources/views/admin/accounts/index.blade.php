@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
            <h1 class="text-2xl font-bold">Accounts</h1>
            <a href="{{ route('admin.accounts.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Account</a>
        </div>

        @if ($categories->count())
            <div class="mb-6 flex flex-wrap gap-2">
                @php
                    $allActive = empty($selectedCategory);
                @endphp
                <a href="{{ route('admin.accounts.index') }}"
                    class="px-4 py-2 rounded-full text-sm font-medium border transition
                    {{ $allActive ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                    All
                </a>
                @foreach ($categories as $category)
                    @php
                        $isActive = (string) $selectedCategory === (string) $category->id;
                    @endphp
                    <a href="{{ route('admin.accounts.index', ['category' => $category->id]) }}"
                        class="px-4 py-2 rounded-full text-sm font-medium border transition
                        {{ $isActive ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="bg-white shadow-md rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Buyer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($accounts as $account)
                        <tr>
                            <td class="px-6 py-4">{{ $account->id }}</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $account->title }}</p>
                                <p class="text-sm text-gray-500">{{ $account->username }}</p>
                            </td>
                            <td class="px-6 py-4">{{ $account->category?->name ?? '—' }}</td>
                            <td class="px-6 py-4">${{ number_format($account->price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $account->status === 'sold' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ ucfirst($account->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $account->buyer?->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.accounts.show', $account->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    View
                                </a>
                                <a href="{{ route('admin.accounts.edit', $account->id) }}"
                                    class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                    Edit
                                </a>
                                <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No accounts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
