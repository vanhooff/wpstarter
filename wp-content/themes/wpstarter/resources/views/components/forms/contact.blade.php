<x-forms.form-wrapper :subject="$subject" :successMessage="$successMessage">

  <div class="col-span-12 sm:col-span-12">
    <label for="name">
      Naam
      <abbr class="required text-red-500 no-underline" title="Verplicht">*</abbr>
    </label>
    <input class="w-full"
           type="text"
           id="name"
           name="name"
           placeholder="Vul hier uw naam in"
           autocomplete="name"
           required
    >
  </div>

  <div class="col-span-12 sm:col-span-12">
    <label for="email">
      E-mailadres
      <abbr class="required text-red-500 no-underline" title="Verplicht">*</abbr>
    </label>
    <input class="w-full"
           type="email"
           id="email"
           name="email"
           placeholder="Vul hier uw e-mailadres in"
           autocomplete="email"
           required
    >
  </div>

  <div class="col-span-12 sm:col-span-12">
    <label for="phone">
      Telefoonnummer
      <abbr class="required text-red-500 no-underline" title="Verplicht">*</abbr>
    </label>
    <input class="w-full"
           type="tel"
           id="phone"
           name="phone"
           placeholder="Vul hier uw nummer in"
           autocomplete="tel"
           required
    >
  </div>

  <div class="col-span-12">
    <label for="message">
      Bericht
    </label>
    <textarea x-data="{
                resize () {
                    $el.style.height = '0px';
                    $el.style.height = $el.scrollHeight + 'px'
                }
            }"
              x-init="resize()"
              @input="resize()"
              type="text"
              id="message"
              name="message"
              placeholder="Vul hier uw bericht in"
              rows="3"
              class="w-full min-h-[120px]"
    ></textarea>
  </div>


</x-forms.form-wrapper>


