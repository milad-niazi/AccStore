<section class="mt-4 container mx-auto px-4">
    <div class="swiper bannerSwiper rounded-xl overflow-hidden shadow-lg">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
                <div class="swiper-slide">
                    <img src="{{ asset('sliders/' . $slider->image) }}" class="w-full object-cover rounded-xl"
                        alt="{{ $slider->title }}">
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>

        <!-- Optional navigation arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
