import 'alpinejs'

Livewire.on('add-to-cart', postId => {
    document.body.dispatchEvent(new Event('menu-open'));
})
