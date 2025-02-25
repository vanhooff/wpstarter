@php
  $image = get_field('image');
  $content = get_field('content');
  $alignment = get_field('alignment');
  $narrow = get_field('narrow_container');
@endphp
<section class="px-6 lg:px-12">
  <div class="mx-auto relative flex items-center {{ $alignment === 'center' ? 'text-center' : 'text-left'}} {{ $narrow ? 'max-w-3xl' : 'max-w-8xl' }}">
    <div class="w-full">
      @if($content)
        <div class="prose !max-w-full">
          {!! $content !!}
        </div>
      @endif
    </div>
  </div>
</section>
