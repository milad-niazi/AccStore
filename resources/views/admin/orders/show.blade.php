@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
                <p class="text-gray-500">Status:
                    @php
                        $statusColors = [
                            'pending' => 'text-yellow-600',
                            'paid' => 'text-green-600',
                            'failed' => 'text-red-600',
                            'cancelled' => 'text-gray-600',
                        ];
                        $color = $statusColors[$order->status] ?? 'text-gray-600';
                    @endphp
                    <span class="{{ $color }} font-semibold">{{ ucfirst($order->status) }}</span>
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.orders.edit', $order->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline self-center">Back to
                    list</a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded p-6 space-y-6">
            {{-- Order Information --}}
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Customer</p>
                    <p class="mt-2 text-gray-800">
                        {{ $order->user->name ?? 'N/A' }}
                        <span class="text-gray-500 text-sm block">{{ $order->user->email ?? 'N/A' }}</span>
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Total Price</p>
                    <p class="mt-2 text-lg font-bold text-gray-800">${{ number_format($order->price, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Payment Method</p>
                    <p class="mt-2 text-gray-800">{{ $order->payment_method ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600">Created / Updated</p>
                    <p class="mt-2 text-gray-800">
                        {{ $order->created_at?->format('Y-m-d H:i') }} /
                        {{ $order->updated_at?->format('Y-m-d H:i') }}
                    </p>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="border-t pt-6">
                <h2 class="text-xl font-bold mb-4">Order Items ({{ $order->orderItems->count() }})</h2>
                @if($order->orderItems->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Account</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td class="px-6 py-4">{{ $item->id }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->account->title ?? 'N/A' }}
                                            @if($item->account)
                                                <span class="text-gray-500 text-sm block">{{ $item->account->username ?? 'N/A' }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->account->category->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">${{ number_format($item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No items in this order.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
