import.meta.glob([
  '../images/**',
  '../fonts/**',
])
import {Splide} from '@splidejs/splide'
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'
import ui from '@alpinejs/ui'
import intersect from '@alpinejs/intersect'
import anchor from '@alpinejs/anchor'
import resize from '@alpinejs/resize'
import Alpine from 'alpinejs'

document.addEventListener('DOMContentLoaded', async () => {

  window.Splide = Splide

  Alpine.plugin(collapse)
  Alpine.plugin(focus)
  Alpine.plugin(ui)
  Alpine.plugin(intersect)
  Alpine.plugin(anchor)
  Alpine.plugin(resize)
  window.Alpine = Alpine

  Alpine.start()
});
