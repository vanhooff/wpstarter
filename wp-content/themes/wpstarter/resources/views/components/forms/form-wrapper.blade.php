<div x-data="{ submitting: false, submitted: false, successMessage: '', errorMessage: '' }">

  <form x-show="!submitted"
        @submit.prevent="
        submitting = true;
         fetch('{{ esc_url(admin_url( 'admin-ajax.php' )) }}', {
             method: 'POST',
             body: new FormData($event.target)
         }).then(response => response.json())
           .then(data => {
               if(data.success) {
                   submitted = true;
                   successMessage = data.data.message;
                   $dispatch('new-notification', { message: 'Bericht verstuurd',  type: 'success', description: 'We nemen zo spoedig mogelijk contact op.' });
               } else {
                   errorMessage = data.data.message;
               }
               submitting = false;
           })
           "
    {{ $hasFileUpload ? 'enctype=multipart/form-data' : '' }}
  >

    <div class="grid grid-cols-12 gap-4">

      {{ $slot }}

    </div>

    <div>
      <input type="hidden" name="action" value="menzsamen_form">
      <input type="hidden" name="send_to" value="{{ $sendTo }}">
      <input type="hidden" name="subject" value="{!! $subject !!}">
      <input type="hidden" name="success_message" value="{!! $successMessage !!}">
    </div>

    <div class="sm:flex sm:justify-start mt-6">
      <button
        type="submit"
        class="group relative w-full md:w-auto min-w-[260px] group font-medium !no-underline inline-flex flex-none items-center justify-center overflow-hidden rounded-md transition-all duration-100 h-10 px-4 sm:px-6 text-base text-white bg-primary hover:bg-primary/90 border-primary shadow-none"
        @click="errorMessage = ''"
        :disabled="submitting"
      >
        <span x-show="!submitting">Verzenden</span>
        <span x-show="submitting"
              class="flex items-center space-x-2"
        >
          <svg class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>Versturen</span>
        </span>
      </button>
    </div>
  </form>

  <div x-show="submitted && successMessage" x-text="successMessage" class="message-success"></div>
  <div x-show="errorMessage" x-text="errorMessage" class="message-error pt-6 text-red-500"></div>

</div>
