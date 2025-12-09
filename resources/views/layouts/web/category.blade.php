<section class="container mx-auto px-4 mt-10">
    <h2 class="text-xl font-bold mb-4">📂 Accounts</h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
        @foreach ($categories as $category)
            <div class="bg-white p-3 rounded-lg shadow hover:shadow-md transition">
                <img src="{{ asset('categories/' . $category->primary_image) ?? 'https://via.placeholder.com/200' }}"
                    class="rounded mb-2" alt="{{ $category->name }}" />
                <a href="#">
                    <h3 class="text-sm font-semibold">
                        {{ $category->name }}
                    </h3>
                </a>
            </div>
        @endforeach
    </div>
</section>
