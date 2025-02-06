import.meta.glob([
  '../images/**',
  '../fonts/**',
])
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'
import ui from '@alpinejs/ui'
import intersect from '@alpinejs/intersect'
import anchor from '@alpinejs/anchor'
import resize from '@alpinejs/resize'
import Alpine from 'alpinejs'

domReady(async () => {
  // window.Fancybox = Fancybox

  Alpine.plugin(collapse)
  Alpine.plugin(focus)
  Alpine.plugin(ui)
  Alpine.plugin(intersect)
  Alpine.plugin(anchor)
  Alpine.plugin(resize)
  window.Alpine = Alpine

  Alpine.start()
});
