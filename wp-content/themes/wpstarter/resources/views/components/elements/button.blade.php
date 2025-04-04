@php
  $modeClasses = [
    'normal' => [
      'text' => 'text-white',
      'bg' => 'bg-primary hover:bg-primary/90',
      'border' => 'border-primary',
      'shadow' => 'shadow-none'
    ],
    'outline' => [
      'text' => 'text-primary hover:text-white',
      'bg' => 'bg-transparent hover:bg-primary',
      'border' => 'border border-primary',
      'shadow' => 'shadow-none'
    ],
    'ghost' => [
      'text' => 'text-primary',
      'bg' => 'bg-transparent',
      'border' => 'border-transparent',
      'shadow' => 'shadow-none'
    ],
  ];

  // Inverted mode classes
  $invertedModeClasses = [
    'normal' => [
      'text' => 'text-primary',
      'bg' => 'bg-white hover:bg-white/90',
      'border' => 'border-white',
      'shadow' => 'shadow-none'
    ],
    'outline' => [
      'text' => 'text-white hover:text-primary',
      'bg' => 'bg-transparent hover:bg-white',
      'border' => 'border border-white',
      'shadow' => 'shadow-none'
    ],
    'ghost' => [
      'text' => 'text-white',
      'bg' => 'bg-transparent',
      'border' => 'border-transparent',
      'shadow' => 'shadow-none'
    ],
  ];

  $mode = $mode ?? 'normal';
  $invert = $invert ?? false;

  // Choose the appropriate mode classes based on invert state
  $modeClass = $invert
    ? ($invertedModeClasses[$mode] ?? $invertedModeClasses['normal'])
    : ($modeClasses[$mode] ?? $modeClasses['normal']);

  $sizeClasses = [
    'xs' => 'h-6 px-2 text-xs min-w-[140px]',
    'sm' => 'h-7 px-2 text-sm min-w-[160px]',
    'base' => 'h-10 px-6 text-base min-w-[180px]',
    'lg' => 'h-9 px-4 text-base lg:h-12 lg:px-6 lg:text-lg min-w-[200px]',
  ];

  $size = $size ?? 'base';
  $sizeClass = $sizeClasses[$size] ?? $sizeClasses['base'];

  $fullWidthClass = $fullWidth ?? false ? 'w-full' : 'w-full sm:w-auto';

$commonClasses = "
    group
    !no-underline
    relative
    inline-flex
    flex-none
    items-center
    justify-center
    overflow-hidden
    rounded-md
    cursor-pointer
    transition-all duration-100
    {$sizeClass}
    {$modeClass['text']}
    {$modeClass['bg']}
    {$modeClass['border']}
    {$modeClass['shadow']}
    {$fullWidthClass}
    ";
@endphp

@if($type === 'button')
  <button
    type="{{ $buttonType }}"
    @if($action) @click="{{ $action }}" @endif
    class="{{ $commonClasses }}"
  >
    {{ $slot }}
  </button>
@elseif($type === 'link')
  <a
    href="{{ $href }}"
    @if($newTab) target="_blank" rel="noopener noreferrer" @endif
    class="{{ $commonClasses }}"
  >
    {{ $slot }}
  </a>
@endif
