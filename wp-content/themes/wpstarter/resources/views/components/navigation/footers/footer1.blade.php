@php
  $companyName = get_field('company_name', 'options');
  $street_name = get_field('street_name', 'options');
  $house_number = get_field('house_number', 'options');
  $zip_code = get_field('zip_code', 'options');
  $city = get_field('city', 'options');
  $phone = get_field('phone', 'options');
  $email = get_field('email', 'options');
  $whatsapp = get_field('whatsapp', 'options');
  $latitude = get_field('latitude', 'options');
  $longitude = get_field('longitude', 'options');
  $opening_hours = get_field('opening_hours', 'options');
@endphp
<div class="relative px-6 pb-12 bg-primary lg:px-12">

  <div class="relative mx-auto max-w-3xl flex-wrap justify-between text-lg text-white xs:flex lg:max-w-7xl lg:flex-none">

    <div class="mt-12 w-full sm:w-[50%] lg:w-auto">
      <div>
        <div class="-m-1.5 p-1.5">
          <a href="{{ home_url('/') }}" class="w-20 sm:w-24 block">
            <x-elements.logo/>
            <span class="sr-only">{{ get_bloginfo('name') }}</span>
          </a>
        </div>
        <div class="mt-6 font-light">
          <p>
            {{ $companyName }}<br>
            {{ $street_name }} {{ $house_number }}<br>
            {{ $zip_code }} {{ $city }}<br>
          </p>
        </div>

        <div class="mt-4 font-light">
          <a href="mailto:{{ $email }}"
             class="!no-underline"
          >
            {{ $email }}
          </a>
          <br>
          <a href="tel:0031{{ $phone }}"
             class="!no-underline"
          >
            {{ format_phone_number($phone) }}
          </a>
        </div>

        <div class="mt-6">

          <h2 class="font-bold">
            Volg ons:
          </h2>

          <div class="mt-4 flex items-center space-x-4">

            @if(get_field('social_media_accounts', 'option') && count(get_field('social_media_accounts', 'option')) > 0)

              @foreach(get_field('social_media_accounts', 'option') as $account)
                <a href="{{ $account['url'] }}" target="_blank" rel="noopener noreferrer">
                  @switch($account['platform']['value'])
                    @case('facebook')
                      <svg class="size-8 sm:size-10" preserveAspectRatio="xMinYMin meet" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40 20.1222C40 9.00902 31.0457 0 20 0C8.9543 0 0 9.00902 0 20.1222C0 30.1658 7.31375 38.4904 16.875 40V25.9388H11.7969V20.1222H16.875V15.689C16.875 10.6459 19.8609 7.86024 24.4293 7.86024C26.6175 7.86024 28.9062 8.25326 28.9062 8.25326V13.2052H26.3843C23.8998 13.2052 23.125 14.7563 23.125 16.3476V20.1222H28.6719L27.7852 25.9388H23.125V40C32.6863 38.4904 40 30.1658 40 20.1222Z" fill="white"/>
                      </svg>
                      @break
                    @case('instagram')
                      <svg class="size-8 sm:size-10" preserveAspectRatio="xMinYMin meet" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M20.5 0C31.8142 0 41 8.96172 41 20C41 31.0383 31.8142 40 20.5 40C9.18576 40 0 31.0383 0 20C0 8.96172 9.18576 0 20.5 0ZM20.5 7.5C17.0204 7.5 16.584 7.51437 15.2174 7.57523C13.8537 7.63594 12.9223 7.84727 12.1073 8.15625C11.2647 8.4757 10.5502 8.90312 9.83792 9.59805C9.12562 10.293 8.68752 10.9901 8.36008 11.812C8.04337 12.6071 7.82684 13.5158 7.76453 14.8462C7.70223 16.1795 7.6875 16.6052 7.6875 20C7.6875 23.3948 7.70223 23.8205 7.76453 25.1537C7.82684 26.4842 8.04337 27.3929 8.36008 28.188C8.68752 29.0099 9.12562 29.707 9.83792 30.402C10.5502 31.097 11.2647 31.5244 12.1073 31.8438C12.9223 32.1527 13.8537 32.3641 15.2174 32.4248C16.584 32.4856 17.0204 32.5 20.5 32.5C23.9796 32.5 24.416 32.4856 25.7826 32.4248C27.1463 32.3641 28.0777 32.1527 28.8927 31.8438C29.7352 31.5244 30.4497 31.097 31.1621 30.402C31.8744 29.707 32.3125 29.0099 32.6399 28.188C32.9566 27.3929 33.1732 26.4842 33.2354 25.1537C33.2978 23.8205 33.3125 23.3948 33.3125 20C33.3125 16.6052 33.2978 16.1795 33.2354 14.8462C33.1732 13.5158 32.9566 12.6071 32.6399 11.812C32.3125 10.9901 31.8744 10.293 31.1621 9.59805C30.4497 8.90312 29.7352 8.4757 28.8927 8.15625C28.0777 7.84727 27.1463 7.63594 25.7826 7.57523C24.416 7.51437 23.9796 7.5 20.5 7.5ZM20.5 9.75226C23.9211 9.75226 24.3263 9.765 25.6774 9.82516C26.9266 9.88078 27.6049 10.0844 28.0564 10.2555C28.6545 10.4823 29.0813 10.7532 29.5296 11.1906C29.978 11.628 30.2557 12.0445 30.4881 12.6279C30.6635 13.0684 30.8723 13.7302 30.9292 14.9489C30.9909 16.267 31.0039 16.6623 31.0039 20C31.0039 23.3377 30.9909 23.733 30.9292 25.0511C30.8723 26.2698 30.6635 26.9316 30.4881 27.3721C30.2557 27.9556 29.978 28.372 29.5296 28.8094C29.0813 29.2469 28.6545 29.5177 28.0564 29.7445C27.6049 29.9156 26.9266 30.1193 25.6774 30.1748C24.3265 30.235 23.9213 30.2477 20.5 30.2477C17.0787 30.2477 16.6735 30.235 15.3226 30.1748C14.0734 30.1193 13.3951 29.9156 12.9436 29.7445C12.3455 29.5177 11.9187 29.2469 11.4703 28.8094C11.022 28.372 10.7443 27.9556 10.5119 27.3721C10.3365 26.9316 10.1277 26.2698 10.0707 25.0511C10.009 23.733 9.99607 23.3377 9.99607 20C9.99607 16.6623 10.009 16.267 10.0707 14.9489C10.1277 13.7302 10.3365 13.0684 10.5119 12.6279C10.7443 12.0445 11.022 11.628 11.4703 11.1906C11.9187 10.7532 12.3455 10.4823 12.9436 10.2555C13.3951 10.0844 14.0734 9.88078 15.3226 9.82516C16.6737 9.765 17.0789 9.75226 20.5 9.75226ZM20.5 13.5811C16.8663 13.5811 13.9206 16.4549 13.9206 20C13.9206 23.5451 16.8663 26.4189 20.5 26.4189C24.1337 26.4189 27.0794 23.5451 27.0794 20C27.0794 16.4549 24.1337 13.5811 20.5 13.5811ZM20.5 24.1666C18.1413 24.1666 16.2292 22.3012 16.2292 20C16.2292 17.6988 18.1413 15.8334 20.5 15.8334C22.8587 15.8334 24.7708 17.6988 24.7708 20C24.7708 22.3012 22.8587 24.1666 20.5 24.1666ZM28.8769 13.3275C28.8769 14.1559 28.1885 14.8274 27.3393 14.8274C26.4902 14.8274 25.8019 14.1559 25.8019 13.3275C25.8019 12.4991 26.4902 11.8275 27.3393 11.8275C28.1885 11.8275 28.8769 12.4991 28.8769 13.3275Z"
                              fill="white"/>
                      </svg>
                      @break
                    @case('linkedin')
                      <svg class="size-8 sm:size-10" preserveAspectRatio="xMinYMin meet" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20 0C31.0383 0 40 8.96172 40 20C40 31.0383 31.0383 40 20 40C8.96172 40 0 31.0383 0 20C0 8.96172 8.96172 0 20 0ZM13.7471 31.2399V15.6211H8.55461V31.2399H13.7471ZM32.4674 31.2399V22.2832C32.4674 17.4856 29.9059 15.2538 26.4902 15.2538C23.7359 15.2538 22.5021 16.7686 21.8113 17.8325V15.6211H16.6202C16.689 17.0865 16.6202 31.2399 16.6202 31.2399H21.8112V22.5173C21.8112 22.0504 21.8448 21.5837 21.9824 21.25C22.357 20.3176 23.2119 19.3516 24.6461 19.3516C26.5238 19.3516 27.276 20.7845 27.276 22.8832V31.2399H32.4674ZM11.1859 8.08984C9.40937 8.08984 8.24867 9.25781 8.24867 10.7887C8.24867 12.2873 9.37406 13.4874 11.1172 13.4874H11.1507C12.9613 13.4874 14.0882 12.2873 14.0882 10.7887C14.0546 9.25781 12.9613 8.08984 11.1859 8.08984Z" fill="white"/>
                      </svg>
                      @break
                  @endswitch
                </a>
              @endforeach
            @endif
          </div>

        </div>

      </div>
    </div>

    <div class="mt-12 w-full xs:w-[50%] lg:w-auto">
      <div class="space-y-4">

        @if( $navMenuItemsColumn1 && count($navMenuItemsColumn1['items']) > 0 )

          <h2 class="font-bold">
            {{ $navMenuItemsColumn1['menu_name'] }}
          </h2>

          <ul class="space-y-4">
            @foreach($navMenuItemsColumn1['items'] as $item)
              <li>
                <a href="{{ $item['url'] }}"
                   class="!no-underline"
                >
                  {{ $item['label'] }}
                </a>
              </li>
            @endforeach
          </ul>

        @endif

      </div>
    </div>

    <div class="mt-12 w-full xs:w-[50%] lg:w-auto">
      <div class="space-y-4">

        @if( $navMenuItemsColumn2 && count($navMenuItemsColumn2['items']) > 0 )

          <h2 class="font-bold">
            {{ $navMenuItemsColumn2['menu_name'] }}
          </h2>

          <ul class="space-y-4">
            @foreach($navMenuItemsColumn2['items'] as $item)
              <li>
                <a href="{{ $item['url'] }}"
                   class="!no-underline"
                >
                  {{ $item['label'] }}
                </a>
              </li>
            @endforeach
          </ul>

        @endif

      </div>
    </div>

    <div class="mt-12 w-full xs:w-[50%] lg:w-auto">
      <div class="space-y-4">

        @if( $navMenuItemsColumn3 && count($navMenuItemsColumn3['items']) > 0 )

          <h2 class="font-bold">
            {{ $navMenuItemsColumn3['menu_name'] }}
          </h2>

          <ul class="space-y-4">
            @foreach($navMenuItemsColumn3['items'] as $item)
              <li>
                <a href="{{ $item['url'] }}"
                   class="!no-underline"
                >
                  {{ $item['label'] }}
                </a>
              </li>
            @endforeach
          </ul>

        @endif

      </div>
    </div>

  </div>


  <div class="relative mx-auto mt-12 flex max-w-7xl justify-center border-t border-white/50 pt-4 text-sm text-white">
    <div>
      <span>&copy; {{ date('Y') }} {{ get_bloginfo('name') }}</span>
      <span>|</span>
      <span>Design by
      <a href="https://www.onlineklik.nl"
         target="_blank"
         rel="noopener noreferrer"
         class="text-white !no-underline"
      >
        Online Klik
      </a>
      </span>
    </div>
  </div>

</div>

