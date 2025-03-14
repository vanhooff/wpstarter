<div class="bg-primary text-white lg:px-12">
  <div class=" relative h-[46px] overflow-x-hidden text-xs">

    @hasoptions('usp_items')

    <div class="absolute inset-0 items-center hidden lg:flex">
      <ul class="max-w-7xl mx-auto flex items-center justify-between flex-shrink-0 w-full py-2 space-x-2">

        @options('usp_items')
        <li class="flex flex-none items-center space-x-2">
          <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M5.91402 11.762C5.84084 11.8353 5.75393 11.8934 5.65827 11.9331C5.56261 11.9727 5.46008 11.9931 5.35652 11.9931C5.25297 11.9931 5.15043 11.9727 5.05477 11.9331C4.95911 11.8934 4.87221 11.8353 4.79902 11.762L0.347022 7.30802C0.237054 7.19824 0.149811 7.06785 0.090286 6.92431C0.0307611 6.78078 0.00012207 6.62691 0.00012207 6.47152C0.00012207 6.31613 0.0307611 6.16227 0.090286 6.01873C0.149811 5.8752 0.237054 5.74481 0.347022 5.63502L0.900022 5.07802C1.00981 4.96805 1.1402 4.88081 1.28373 4.82129C1.42727 4.76176 1.58113 4.73112 1.73652 4.73112C1.89191 4.73112 2.04578 4.76176 2.18931 4.82129C2.33285 4.88081 2.46324 4.96805 2.57302 5.07802L5.35302 7.85802L12.868 0.347022C12.9778 0.237054 13.1082 0.149811 13.2517 0.090286C13.3953 0.030761 13.5491 0.00012207 13.7045 0.00012207C13.8599 0.00012207 14.0138 0.030761 14.1573 0.090286C14.3008 0.149811 14.4312 0.237054 14.541 0.347022L15.099 0.905022C15.209 1.01481 15.2962 1.1452 15.3558 1.28873C15.4153 1.43227 15.4459 1.58613 15.4459 1.74152C15.4459 1.89691 15.4153 2.05078 15.3558 2.19431C15.2962 2.33785 15.209 2.46824 15.099 2.57802L5.91402 11.762Z"
              fill="currentColor"/>
          </svg>
          <span class="">@sub('usp')</span>
        </li>
        @endoptions

      </ul>
    </div>

    <div class="absolute inset-0 flex items-center lg:hidden">
      <div x-data
           x-init="
            $nextTick(() => {
                const content = $refs.marqueeContent;
                const item = $refs.marqueeItem;
                const clone = item.cloneNode(true);
                content.appendChild(clone);
            });
            "
           class="relative w-full container-block min-w-[1200px] sm:min-w-[1600px]"
      >
        <div class="relative w-full mx-auto overflow-hidden">
          <div x-ref="marqueeContent" class="flex animate-marquee">
            <ul x-ref="marqueeItem" class="flex items-center justify-around flex-shrink-0 w-full py-2 space-x-2">

              @options('usp_items')
              <li class="flex flex-none items-center space-x-2">
                <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M5.91402 11.762C5.84084 11.8353 5.75393 11.8934 5.65827 11.9331C5.56261 11.9727 5.46008 11.9931 5.35652 11.9931C5.25297 11.9931 5.15043 11.9727 5.05477 11.9331C4.95911 11.8934 4.87221 11.8353 4.79902 11.762L0.347022 7.30802C0.237054 7.19824 0.149811 7.06785 0.090286 6.92431C0.0307611 6.78078 0.00012207 6.62691 0.00012207 6.47152C0.00012207 6.31613 0.0307611 6.16227 0.090286 6.01873C0.149811 5.8752 0.237054 5.74481 0.347022 5.63502L0.900022 5.07802C1.00981 4.96805 1.1402 4.88081 1.28373 4.82129C1.42727 4.76176 1.58113 4.73112 1.73652 4.73112C1.89191 4.73112 2.04578 4.76176 2.18931 4.82129C2.33285 4.88081 2.46324 4.96805 2.57302 5.07802L5.35302 7.85802L12.868 0.347022C12.9778 0.237054 13.1082 0.149811 13.2517 0.090286C13.3953 0.030761 13.5491 0.00012207 13.7045 0.00012207C13.8599 0.00012207 14.0138 0.030761 14.1573 0.090286C14.3008 0.149811 14.4312 0.237054 14.541 0.347022L15.099 0.905022C15.209 1.01481 15.2962 1.1452 15.3558 1.28873C15.4153 1.43227 15.4459 1.58613 15.4459 1.74152C15.4459 1.89691 15.4153 2.05078 15.3558 2.19431C15.2962 2.33785 15.209 2.46824 15.099 2.57802L5.91402 11.762Z"
                    fill="currentColor"/>
                </svg>
                <span>@sub('usp')</span>
              </li>
              @endoptions

            </ul>
          </div>
        </div>
      </div>
      <div class="from-primary to-transparent absolute left-0 top-0 h-8 w-16 xs:w-24 sm:w-40 bg-gradient-to-r "></div>
      <div class="from-primary to-transparent absolute right-0 top-0 h-8 w-16 xs:w-24 sm:w-40 bg-gradient-to-l"></div>
    </div>

    @endhasoptions
  </div>
</div>
