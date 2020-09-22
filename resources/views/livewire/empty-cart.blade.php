<div class="side-menu-cart h-full overflow-auto">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32 m-auto"></div>
    </div>

    <div class="relative mx-auto pt-4 h-full">
        <button class="mr-4 float-right p-2 hover:bg-black hover:text-white absolute right-0 z-10" @click="cartMenuOpen = false">
            X
            <span class="sr-only">Close menu</span>
        </button>

        <nav class="bg-white px-4 pt-4 h-full relative w-64 flex content-center z-1">
            <div class="w-full h-8 m-auto">
                @lang('You have no items in your cart.')
            </div>
        </nav>
    </div>
</div>
