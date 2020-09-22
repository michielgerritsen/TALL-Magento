<div class="z-0 relative bg-white">
    <div class="relative z-10 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-5 sm:px-6 sm:py-4 lg:px-8 md:justify-start md:space-x-10">
            <div>
                <a href="/" class="flex">
                    <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="Workflow">
                </a>
            </div>
            <div class="-mr-2 -my-2 md:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div class="hidden md:flex-1 md:flex md:items-center md:justify-between md:space-x-12">
                <nav class="flex space-x-10">
                    @foreach ($categories as $category)
                        @if ($category['children_count'])
                            <x-menu.item-with-subcategories :category="$category" />
                        @else
                            <a href="{{route('category', ['key' => $category['url_key']])}}" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                                {{ $category['name'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>
                <div class="relative float-right">
                    <button type="button" @click="cartMenuOpen = true" class="text-gray-500 group inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @livewire('cart-count')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
