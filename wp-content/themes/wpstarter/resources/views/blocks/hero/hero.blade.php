<section class="relative">
  <div class="relative">

    <div class="absolute inset-0">

      @if(get_field('is_video'))
        <video autoplay loop muted playsinline class="w-full h-full object-cover">
          <source src="@field('video')" type="video/mp4">
        </video>
      @else
        <img src="@field('image')" alt="" class="w-full h-full object-cover object-bottom">
      @endif

    </div>

    {{--  Overlay --}}
    <div class="absolute inset-0 bg-primary/40"></div>

    @if(get_field('title') || get_field('content') || have_rows('buttons'))
      <div class="relative py-24 sm:py-32 lg:py-48 px-6 lg:px-12">

        <div class="max-w-7xl mx-auto">

          @hasfield('title')
          <h1 class="text-5xl lg:text-6xl text-white font-bold max-w-3xl">@field('title')</h1>
          @endfield

          @hasfield('content')
          <h2 class="text-lg lg:text-xl text-white/80 mt-10 max-w-3xl">@field('content')</h2>
          @endfield

          @if( have_rows('buttons') )
            <div class="block space-y-4 sm:space-y-0 sm:space-x-4 sm:flex mt-6">
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

          @endif

        </div>

      </div>
    @endif

  </div>

</section>
