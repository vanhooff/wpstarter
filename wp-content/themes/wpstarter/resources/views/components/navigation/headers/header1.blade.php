<div x-data="{ mobileMenuOpen:false }"
     class="bg-white px-6 lg:px-12"
>
  <nav class="mx-auto flex max-w-7xl items-center justify-between py-4 lg:py-6" aria-label="Global">
    <div class="-m-1.5 p-1.5 text-primary">
      <a href="{{ home_url('/') }}" class="w-20 sm:w-24 block">
        <x-elements.logo/>
        <span class="sr-only">{{ get_bloginfo('name') }}</span>
      </a>
    </div>
    <div class="flex gap-x-8">
      <div class="flex lg:hidden order-2 lg:order-1">
        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
          </svg>
        </button>
      </div>
      <div class="hidden xs:flex lg:gap-x-12 order-1 lg:order-2">
        <div class="hidden lg:flex lg:gap-x-12">
          @foreach($navMenuItems['items'] as $navMenuItem)
            <a href="{{ $navMenuItem['url'] }}" class="text-base/9 font-medium !no-underline hover:text-primary transition-colors duration-300 {{ $navMenuItem['is_current'] ? 'text-primary' : 'text-gray-900' }}">{{ $navMenuItem['label'] }}</a>
          @endforeach
        </div>

        <x-elements.button
          href="#"
          size="base"
          mode="normal"
          buttonType="link"
        >
          Contact
        </x-elements.button>
      </div>
    </div>
  </nav>

  <template x-teleport="body">
    <div x-show="mobileMenuOpen"
         @keydown.window.escape="mobileMenuOpen=false"
         class="relative z-[99]"
         role="dialog" aria-modal="true"
    >
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div x-show="mobileMenuOpen"
           x-transition.opacity.duration.600ms
           @click="mobileMenuOpen = false"
           class="fixed inset-0 z-10 bg-gray-950/20"
      ></div>

      <div x-show="mobileMenuOpen"
           @click.away="mobileMenuOpen = false"
           x-transition:enter="transform transition ease-in-out duration-500"
           x-transition:enter-start="translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transform transition ease-in-out duration-500"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="translate-x-full"
           class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-4 max-w-xs xs:max-w-sm sm:ring-1 sm:ring-gray-900/10"
      >
        <div class="flex items-center justify-between">
          <div class="-m-1.5 p-1.5 text-primary">
            <a href="{{ home_url('/') }}" class="w-20 block">
              <x-elements.logo/>
              <span class="sr-only">{{ get_bloginfo('name') }}</span>
            </a>
          </div>
          <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              @foreach($navMenuItems['items'] as $navMenuItem)
                <a href="{{ $navMenuItem['url'] }}"
                   x-show="mobileMenuOpen"
                   x-transition:enter="transition-all duration-500 ease-out transform origin-top opacity-0 translate-y-6 scale-y-90"
                   x-transition:enter-start="opacity-0 translate-y-6 scale-y-90"
                   x-transition:enter-end="opacity-100 translate-y-0 scale-y-100"
                   x-transition:leave="!delay-500"
                   x-transition:leave-start="opacity-100"
                   x-transition:leave-end="opacity-100"
                   style="transition-delay:{{ ($loop->iteration + 1) * 90 }}ms;"
                   class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 !no-underline hover:text-primary duration-300 {{ $navMenuItem['is_current'] ? 'text-primary' : 'text-gray-900' }}">
                  {{ $navMenuItem['label'] }}
                </a>
              @endforeach
            </div>
            <div class="py-6">
              <x-elements.button
                href="#"
                size="base"
                mode="normal"
                buttonType="link"
                :fullWidth="true"
              >
                Contact
              </x-elements.button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
</div>
