<section class="container mx-auto px-4 mt-14">
    <h2 class="text-xl font-bold mb-6 text-center">💬 Customer Reviews</h2>

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($reviews as $review)
            <div class="bg-white p-6 rounded-xl shadow">
                <p>“{{ $review->content }}”</p>
                <span class="block mt-3 font-bold">— {{ $review->user->name ?? 'Customer' }}</span>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No reviews have been submitted yet.</p>
        @endforelse
    </div>
</section>
