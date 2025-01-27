@php
  $image = get_field('image');
  $content = get_field('content');
  $alignment = get_field('alignment');
  $narrow = get_field('narrow_container');
@endphp
<section>
  <div class="relative flex items-center px-4 sm:px-6 lg:px-12 mx-auto {{ $alignment === 'center' ? 'text-center' : 'text-left'}} {{ $narrow ? 'max-w-3xl' : 'max-w-7xl' }}">
    <div class="w-full">
      @if($content)
        <div class="prose !max-w-full">
          {!! $content !!}
        </div>
      @endif
    </div>
  </div>
</section>
