@php
  $spacerClasses = [
    1 => 'py-1 sm:py-2',
    2 => 'py-3 sm:py-6',
    3 => 'py-6 sm:py-10',
    4 => 'py-10 sm:py-14',
    5 => 'py-14 sm:py-20',
  ];
  $spacer = get_field('spacer');
  $showSpacer = get_field('show_spacer');
  $hasDivider = get_field('has_divider');
  $visibilityClass = '';
  if ($showSpacer !== null) {
    $visibilityClass = $showSpacer === 'always' ? '' : ($showSpacer === 'mobile' ? 'block sm:hidden' : 'hidden sm:block');
  }
@endphp

@if (array_key_exists($spacer, $spacerClasses))
  <div class="block-spacer {{ $spacerClasses[$spacer] }} {{ $visibilityClass }}">
    @if ($hasDivider)
      <div class="mx-auto px-0 max-w-4xl sm:px-6 lg:px-12">
        <div class="border-t border-gray-300"></div>
      </div>
    @endif
  </div>
@endif

