@php
  $key = rand();
  $features = get_field('features');
  $title = get_field('title');
  $content = get_field('content');
  $backgroundColor = get_field('has_background');
@endphp

<section class="feature-carousel relative py-16 sm:py-28 {{ $backgroundColor ? 'bg-secondary' : '' }}">

  @if($features)

    <div class="px-6 lg:px-12">
      <div class="mx-auto max-w-6xl">

        @if($title || $content)
          <div class="relative flex items-center">
            <div class="rich-content w-full text-center">
              @if($title)
                <h2 class="">
                  {{ $title }}
                </h2>
              @endif
              @if($content)
                <div>
                  {!! $content !!}
                </div>
              @endif

            </div>
          </div>
        @endif

      </div>
    </div>

    [no_texturize]
    <div x-data="{
          activeFeature: 0,
          splide: null,
          init() {
              this.splide = new Splide(this.$refs.splide_{{ $key  }}, {
                  perMove: 1,
                  arrowPath: 'M5.20585 40C4.43827 39.9988 3.68428 39.8238 3.01804 39.4924C1.51783 38.7533 0.585205 37.3185 0.585205 35.7609V4.2393C0.585205 2.67735 1.51783 1.24692 3.01804 0.507798C3.70014 0.16697 4.47502 -0.00830217 5.26168 0.000302213C6.04834 0.00890659 6.8179 0.201072 7.48992 0.556711L38.4755 16.6827C39.1212 17.0348 39.6536 17.5237 40.0226 18.1035C40.3916 18.6834 40.5852 19.3352 40.5852 19.9979C40.5852 20.6606 40.3916 21.3125 40.0226 21.8923C39.6536 22.4722 39.1212 22.9611 38.4755 23.3131L7.48492 39.4435C6.79719 39.805 6.00948 39.9973 5.20585 40Z',
                  rewind: false,
                  updateOnMove: true,
                  autoWidth: true,
                  pauseOnHover: false,
                  pagination: false,
                  speed: 700,
                  interval: 4000,
                  type: 'loop',
                  gap: '20px',
                  autoplay: false,
                  start: 0,
                  easing: 'cubic-bezier(.42,.65,.27,.99)',
                  direction: 'rtl',
                  breakpoints: {
                    768: {
                      autoWidth: false,
                      perPage: 1,
                    },
                  },

              }).mount();

              this.splide.on('move', (index) => {
                  this.activeFeature = index;
              });
          },

      }"
         class="md:flex mt-8 sm:mt-16 gap-12 px-6 md:pl-0 lg:pr-12 max-w-sm mx-auto md:max-w-full"
    >
      <div class="flex-none w-full md:w-[calc(50vw+160px)] xl:w-[calc(50vw+210px)]">

        <div class="relative">
          <div x-ref="splide_{{ $key  }}" class="splide" aria-label="Feature carrousel">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($features as $feature)
                  @php
                    $url = $feature['image']['url'];
                    $alt = $feature['image']['alt'];
                  @endphp
                  <li class="splide__slide">
                    <div class="aspect-1/1 w-full md:w-[320px] xl:w-[420px] overflow-hidden rounded-3xl">
                      <img src="{{ $url }}" alt="{{ $alt }}" class="object-cover h-full w-full">
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

      </div>
      <div class="grow flex items-center">
        @foreach($features as $key => $feature)
          @php
            $title = $feature['details']['title'];
            $subtitle = $feature['details']['subtitle'];
            $description = $feature['details']['description'];
          @endphp

          <div x-show="activeFeature === {{ $key }}" class="transition-opacity duration-300 mt-6 md:mt-0" x-cloak>
            <div class="relative">
              <div class="max-w-[360px]">
                <div>
                  @if($title)
                    <h3 class="mt-2 text-3xl sm:text-4xl font-bold text-primary">
                      {{ $title }}
                    </h3>
                  @endif
                  @if($subtitle)
                    <p class="text-lg sm:text-xl font-medium text-body mt-1">
                      {{ $subtitle }}
                    </p>
                  @endif
                  @if($description)
                    <div class="rich-content mt-4">
                      {!! $description !!}
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    [/no_texturize]

    @if( have_rows('buttons') )
      <div class="mt-8 sm:mt-12 flex justify-center ">
        <div class="block space-y-4 sm:space-y-0 sm:space-x-4 sm:flex w-full md:w-auto max-w-sm md:max-w-full px-6">
          @while( have_rows('buttons') )
            @php
              the_row();
              $buttonText = get_sub_field('button_text');
              $buttonLink = get_sub_field('button_link');
              $buttonSize = get_sub_field('size');
              $outline = get_sub_field('outline') ? 'outline' : 'normal';
              $invert = get_sub_field('invert');
              $newTab = get_sub_field('new_tab');
            @endphp
            <x-elements.button
              :href="$buttonLink"
              :size="$buttonSize"
              :mode="$outline"
              buttonType="link"
              :newTab="$newTab"
              :invert="$invert"
              :fullWidth="false"
            >
              {{ $buttonText }}
            </x-elements.button>
          @endwhile
        </div>
      </div>
    @endif

  @endif
</section>

