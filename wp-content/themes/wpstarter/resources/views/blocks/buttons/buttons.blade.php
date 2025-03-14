@php
  $alignment = get_field('alignment');
@endphp
<section class="px-6 lg:px-12">

@if( have_rows('buttons') )
  <div class="sm:flex max-w-7xl mx-auto {{ $alignment === 'center' ? 'justify-center' : ( $alignment === 'right' ? 'justify-end' : 'justify-start' ) }}">
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

</section>
