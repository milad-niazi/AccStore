@extends('layouts.admin')

@section('content')
    @php
        $banners = [];
        $reviews = [];
        $recommendedProducts = [];
    @endphp
    <div class="p-6 bg-gray-100 min-h-screen">

        <h1 class="text-2xl font-bold mb-6">Home Page Management</h1>

        {{-- ---------------- Sliders ---------------- --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Sliders</h2>
            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($sliders as $slider)
                            <tr>
                                <td class="px-6 py-4">{{ $slider->id }}</td>
                                <td class="px-6 py-4">{{ $slider->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    @if ($slider->image)
                                        <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image"
                                            class="h-12 w-24 object-cover rounded">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium {{ $slider->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $slider->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.homepage.sliders.edit', $slider->id) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                                    <form action="{{ route('admin.homepage.sliders.destroy', $slider->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No sliders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ---------------- Reviews ---------------- --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Reviews</h2>
            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Review</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($reviews as $review)
                            <tr>
                                <td class="px-6 py-4">{{ $review->id }}</td>
                                <td class="px-6 py-4">{{ $review->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $review->content ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $review->rating ?? 'N/A' }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.homepage.reviews.edit', $review->id) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                                    <form action="{{ route('admin.homepage.reviews.destroy', $review->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ---------------- Recommended Products ---------------- --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Recommended Products</h2>
            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recommendedProducts as $product)
                            <tr>
                                <td class="px-6 py-4">{{ $product->id }}</td>
                                <td class="px-6 py-4">{{ $product->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">${{ number_format($product->price ?? 0, 2) }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.homepage.products.edit', $product->id) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                                    <form action="{{ route('admin.homepage.products.destroy', $product->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
