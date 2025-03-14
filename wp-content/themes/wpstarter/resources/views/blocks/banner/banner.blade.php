@php
  $image = get_field('image');
@endphp
<section class="relative">
  <div class="relative h-[360px] sm:h-[420px] lg:h-[530px] w-full">

    <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="h-full w-full object-cover">

  </div>
  {{--  Overlay --}}
  <div class="absolute inset-0 bg-primary/40"></div>
</section>
