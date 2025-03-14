@php
  $key = rand();
  $images = get_field('slides');
@endphp

@if($images)
  <section class="relative px-0 lg:px-12">

    <div x-data="{
          init() {
              new Splide(this.$refs.splide_{{ $key  }}, {
                  perMove: 1,
                  perPage: 1,
                  pauseOnHover: false,
                  pagination: false,
                  speed: 700,
                  interval: 4000,
                  type: 'loop',
                  gap: '2rem',
                  autoplay: true,
                  easing: 'cubic-bezier(.42,.65,.27,.99)',
                  breakpoints: {

                  }
              }).mount()
          },
      }"
         class="relative max-w-8xl mx-auto"
    >
      <div x-ref="splide_{{ $key  }}" class="splide" aria-label="Hero slider">
        <div class="splide__track">
          <ul class="splide__list">
            @foreach($images as $image)
              @php
                $url = $image['url'];
                $alt = $image['alt'];
              @endphp
              <li class="splide__slide h-[400px] sm:h-[500px] w-full">
                <img src="{{ $url }}" alt="{{ $alt }}" class="object-cover h-full w-full">
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>
@endif
