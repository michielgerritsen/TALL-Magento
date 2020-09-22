<div class="relative" @click.away="submenuOpen = false" x-data="{submenuOpen: false}"
     @mouseenter="submenuOpen = !submenuOpen"
     @mouseleave="submenuOpen = !submenuOpen"
>
    <a href="{{ route('category', ['key' => $category['url_key']]) }}"
        :class="{ 'text-gray-900': submenuOpen, 'text-gray-500': !submenuOpen }"
        type="button"
        class="text-gray-500 group inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
        <span>{{$category['name']}}</span>
        <svg x-state:on="Item active" x-state:off="Item inactive" class="h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150 text-gray-600" x-bind:class="{ 'text-gray-600': submenuOpen, 'text-gray-400': !submenuOpen }" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </a>

    <div
        x-show="submenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute -ml-4 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2"
    >
        <div class="rounded-lg shadow-lg">
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="z-20 relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                    @foreach ($category['children'] as $subCategory)
                        <a href="{{route('category', ['key' => $subCategory['url_key']])}}" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150">
                            <div class="space-y-1">
                                <p class="text-base leading-6 font-medium text-gray-900">
                                    {{ $subCategory['name'] }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
