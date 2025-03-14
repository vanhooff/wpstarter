@php
  $key = rand();
  $images = get_field('image_carousel');
@endphp

<section class="highlight-carousel relative pb-6 sm:pb-16 max-w-[1800px] mx-auto">

  @if($images)
    [no_texturize]
    <div x-data="{
          splide: null,
          init() {
              this.splide = new Splide(this.$refs.splide_{{ $key  }}, {
                  perMove: 1,
                  perPage: 1,
                  focus: 'center',
                  pauseOnHover: false,
                  pagination: false,
                  speed: 700,
                  interval: 4000,
                  type: 'loop',
                  gap: '12%',
                  padding: '35%',
                  autoplay: true,
                  easing: 'cubic-bezier(.42,.65,.27,.99)',
                  rewind: false,
                  updateOnMove: true,
                  breakpoints: {
                      1800: {
                          padding: '32%'
                      },
                      1024: {
                          padding: '20%',
                      },
                      768: {
                          padding: '15%',
                      },
                      420: {
                          padding: '12%',
                          gap: '14%',
                      },
                  },
                  arrowPath: 'M5.20585 40C4.43827 39.9988 3.68428 39.8238 3.01804 39.4924C1.51783 38.7533 0.585205 37.3185 0.585205 35.7609V4.2393C0.585205 2.67735 1.51783 1.24692 3.01804 0.507798C3.70014 0.16697 4.47502 -0.00830217 5.26168 0.000302213C6.04834 0.00890659 6.8179 0.201072 7.48992 0.556711L38.4755 16.6827C39.1212 17.0348 39.6536 17.5237 40.0226 18.1035C40.3916 18.6834 40.5852 19.3352 40.5852 19.9979C40.5852 20.6606 40.3916 21.3125 40.0226 21.8923C39.6536 22.4722 39.1212 22.9611 38.4755 23.3131L7.48492 39.4435C6.79719 39.805 6.00948 39.9973 5.20585 40Z',

              }).mount();

          },

      }"
         class=""
    >
      <div class="">

        <div class="relative">
          <div x-ref="splide_{{ $key  }}" class="splide" aria-label="Image carrousel">
            <div class="splide__track py-6 sm:py-16">
              <ul class="splide__list">
                @foreach($images as $image)
                  @php
                    $url = $image['url'];
                    $alt = $image['alt'];
                  @endphp
                  <li class="splide__slide">
                    <div class="img-wrap aspect-4/3 overflow-hidden rounded-2xl sm:rounded-3xl bg-gray-700">
                      <img src="{{ $url }}" alt="{{ $alt }}" class="object-cover h-full w-full">
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>

    [/no_texturize]

  @endif
</section>

