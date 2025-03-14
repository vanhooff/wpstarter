@php
  $image = get_field('image');
  $title = get_field('title');
  $black_title = get_field('black_title');
  $companyName = get_field('company_name', 'options');
  $street_name = get_field('street_name', 'options');
  $house_number = get_field('house_number', 'options');
  $zip_code = get_field('zip_code', 'options');
  $city = get_field('city', 'options');
  $phone = get_field('phone', 'options');
  $email = get_field('email', 'options');
@endphp
<section class="relative px-6 lg:px-12">

  <div class="max-w-2xl lg:max-w-7xl mx-auto">
    <div class="border border-gray-950/[0.08] rounded-t-3xl shadow overflow-hidden">
      <div class="lg:grid grid-cols-2">
        <div class="relative">
          <div class="absolute inset-0">
            <img class="h-full w-full object-cover" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
          </div>
        </div>
        <div class="px-12 py-8">
          <h2 class="mb-8 text-4xl font-bold tracking-tight {{ $black_title ? '' : 'text-primary' }}">
            Vragen?<br>
            Neem contact met ons op.
          </h2>
          [no_texturize]
          <x-forms.contact
            {{--            :sendTo="$email"--}}
            sendTo="mail@sandervanhooff.com"
            successMessage="Bedankt voor je bericht. We nemen zo snel mogelijk contact met je op."
            subject="Nieuwe contact aanvraag"
          />
          [/no_texturize]
        </div>
      </div>
    </div>
    <div class="bg-secondary rounded-b-3xl p-8">
      <div class="lg:grid grid-cols-3">
        <div class="lg:flex justify-center">
          <div class="flex items-start">

            <svg class="w-9 mt-8 lg:mt-12 text-primary" preserveAspectRatio="xMinYMin meet" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.2507 32.4583H15.3757V22.2083H25.6257V32.4583H30.7507V17.0833L20.5007 9.39583L10.2507 17.0833V32.4583ZM6.83398 35.875V15.375L20.5007 5.125L34.1673 15.375V35.875H22.209V25.625H18.7923V35.875H6.83398Z" fill="currentColor"/>
            </svg>

            <div>
              <h3 class="text-lg text-primary font-bold ml-5">
                Adres
              </h3>

              <div class="mt-2 lg:mt-6">
                <p class="ml-4 block text-lg text-primary !no-underline">{{ $street_name }} {{ $house_number }}</p>
                <p class="ml-4 block text-lg text-primary !no-underline">{{ $zip_code }} {{ $city }}</p>
              </div>

            </div>

          </div>

        </div>

        <div class="relative mt-8 lg:mt-0 lg:flex justify-center">
          <div class="flex items-start">

            <svg class="w-9 mt-8 lg:mt-12 text-primary" preserveAspectRatio="xMinYMin meet" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.5 37.5C6.46875 37.5 5.58594 37.1328 4.85156 36.3984C4.11719 35.6641 3.75 34.7812 3.75 33.75V11.25C3.75 10.2188 4.11719 9.33594 4.85156 8.60156C5.58594 7.86719 6.46875 7.5 7.5 7.5H37.5C38.5312 7.5 39.4141 7.86719 40.1484 8.60156C40.8828 9.33594 41.25 10.2188 41.25 11.25V33.75C41.25 34.7812 40.8828 35.6641 40.1484 36.3984C39.4141 37.1328 38.5312 37.5 37.5 37.5H7.5ZM22.5 24.375L7.5 15V33.75H37.5V15L22.5 24.375ZM22.5 20.625L37.5 11.25H7.5L22.5 20.625ZM7.5 15V11.25V33.75V15Z" fill="currentColor"/>
            </svg>

            <div>
              <h3 class="text-lg text-primary font-bold ml-5">
                E-mailadres
              </h3>
              <div class="mt-2 lg:mt-6">
                <a href="mailto:{{ $email }}" class="ml-4 block text-lg text-primary !no-underline">{{ $email }}</a>
              </div>

            </div>

          </div>

          <div class="absolute inset-0 pt-12 hidden lg:block">
            <div class="absolute inset-x-0 bottom-0 h-16 border-x border-primary "></div>
          </div>

        </div>

        <div class="mt-8 lg:mt-0 lg:flex justify-center">
          <div class="flex items-start">
            <svg class="w-9 mt-8 lg:mt-12 text-primary" preserveAspectRatio="xMinYMin meet" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M32.4187 34.125C29.0333 34.125 25.6885 33.387 22.3844 31.9109C19.0802 30.4349 16.074 28.3427 13.3656 25.6344C10.6573 22.926 8.5651 19.9198 7.08906 16.6156C5.61302 13.3115 4.875 9.96667 4.875 6.58125C4.875 6.09375 5.0375 5.6875 5.3625 5.3625C5.6875 5.0375 6.09375 4.875 6.58125 4.875H13.1625C13.5417 4.875 13.8802 5.00365 14.1781 5.26094C14.476 5.51823 14.6521 5.82292 14.7062 6.175L15.7625 11.8625C15.8167 12.2958 15.8031 12.6615 15.7219 12.9594C15.6406 13.2573 15.4917 13.5146 15.275 13.7312L11.3344 17.7125C11.876 18.7146 12.5193 19.6828 13.2641 20.6172C14.0089 21.5516 14.8281 22.4521 15.7219 23.3187C16.5615 24.1583 17.4417 24.937 18.3625 25.6547C19.2833 26.3724 20.2583 27.0292 21.2875 27.625L25.1062 23.8062C25.35 23.5625 25.6682 23.3797 26.0609 23.2578C26.4536 23.1359 26.8396 23.1021 27.2188 23.1562L32.825 24.2937C33.2042 24.4021 33.5156 24.5984 33.7594 24.8828C34.0031 25.1672 34.125 25.4854 34.125 25.8375V32.4187C34.125 32.9062 33.9625 33.3125 33.6375 33.6375C33.3125 33.9625 32.9062 34.125 32.4187 34.125ZM9.79062 14.625L12.4719 11.9437L11.7812 8.125H8.16562C8.30104 9.23542 8.49062 10.3323 8.73437 11.4156C8.97812 12.499 9.33021 13.5687 9.79062 14.625ZM24.3344 29.1687C25.3906 29.6292 26.4672 29.9948 27.5641 30.2656C28.6609 30.5365 29.7646 30.7125 30.875 30.7937V27.2188L27.0562 26.4469L24.3344 29.1687Z"
                fill="currentColor"/>
            </svg>


            <div>
              <h3 class="text-lg text-primary font-bold ml-5">
                Telefoonnummer
              </h3>
              <div class="mt-2 lg:mt-6">
                <a href="tel:0031{{ $phone }}" class="ml-4 block text-lg text-primary !no-underline">{{ format_phone_number($phone) }}</a>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>

</section>

