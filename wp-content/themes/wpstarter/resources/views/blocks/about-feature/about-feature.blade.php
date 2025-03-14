@php
  $image = get_field('image');
  $title = get_field('title');
  $content = get_field('content');
  $alignment = get_field('alignment');
  $backgroundColor = get_field('background_color');
@endphp
<section class="relative px-6 lg:px-12 {{ $backgroundColor ? 'bg-secondary py-28' : '' }}">

  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 md:grid-cols-2 lg:gap-12">

    <div class="relative {{ $alignment === 'right' ? 'order-1 md:order-2' : 'order-1'}}">

      <div class="relative overflow-hidden rounded-3xl aspect-[24/19]">
        <div class="absolute inset-0">
          <img class="h-full w-full object-cover" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
        </div>
      </div>
    </div>

    <div class="relative flex items-center {{ $alignment === 'right' ? 'order-2 md:order-1' : 'order-2'}}">
      <div class="w-full">
        <div class="rich-content">
          @if($title)
            <h2>
              {{ $title }}
            </h2>
          @endif
          @if($content)
            {!! $content !!}
          @endif
        </div>
        @if( have_rows('buttons') )
          <div class="mt-8 sm:flex max-w-7xl mx-auto {{ $alignment === 'center' ? 'justify-center' : ( $alignment === 'right' ? 'justify-end' : 'justify-start' ) }}">
            <div class="block space-y-4 sm:space-y-0 sm:space-x-4 sm:flex">
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
      </div>
    </div>
  </div>
</section>

