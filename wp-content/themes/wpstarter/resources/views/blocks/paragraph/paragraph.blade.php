@php
  $image = get_field('image');
  $content = get_field('content');
  $alignment = get_field('alignment');
  $narrow = get_field('narrow_container');
@endphp
<section class="px-6 lg:px-12">
  <div class="mx-auto relative flex items-center {{ $alignment === 'center' ? 'text-center' : 'text-left'}} {{ $narrow ? 'max-w-3xl' : 'max-w-7xl' }}">
    <div class="w-full">
      @if($content)
        <div class="rich-content !max-w-full">
          {!! $content !!}
        </div>
      @endif

      @if( have_rows('buttons') )
        <div class="mt-8 sm:mt-12 sm:flex max-w-7xl mx-auto {{ $alignment === 'center' ? 'justify-center' : ( $alignment === 'right' ? 'justify-end' : 'justify-start' ) }}">
          <div class="block space-y-4 sm:space-y-0 sm:space-x-4 sm:flex">
            @while( have_rows('buttons') )
              @php
                the_row();
                $buttonText = get_sub_field('button_text');
                $buttonLink = get_sub_field('button_link');
                $buttonSize = get_sub_field('size');
                $outline = get_sub_field('outline') ? 'outline' : 'normal';
                $newTab = get_sub_field('new_tab');
              @endphp
              <x-elements.button
                :href="$buttonLink"
                :size="$buttonSize"
                :mode="$outline"
                buttonType="link"
                :newTab="$newTab"
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
</section>
