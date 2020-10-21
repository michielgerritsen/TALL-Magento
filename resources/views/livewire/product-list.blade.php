<div class="col-span-4" @scrollToTop.window="alert('ScrollToTop');">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32 m-auto"></div>
    </div>

    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

        <?php /** @var \App\DTO\Product $product */ ?>
        @foreach ($products as $product)

            <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow">
                <a href="{{route('product', $product->getUrlKey())}}">
                    <div class="flex-1 flex flex-col p-8">
                        <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full" src="{{$product->getProductImages()->getSmallImage()->getUrl()}}" alt="">
                        <h3 class="mt-6 text-gray-900 text-sm leading-5 font-medium">{!! $product->getName() !!}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between mb-2">
                            <dt class="sr-only">SKU</dt>
                            <dd class="text-gray-500 text-sm leading-5">{{$product->getSku()}}</dd>
                        </dl>

                        <x-product-price :prices="$product->getPrices()" size="small" />
                    </div>
                </a>

                <div class="border-t border-gray-200">
                    <div class="-mt-px flex">
                        <div class="-ml-px w-0 flex-1 flex">
                            <a wire:click="$emit('add-to-cart', '{{$product->getSku()}}')" class="cursor-pointer relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="shopping-bag w-6 h-6"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                                </svg>
                                <span class="ml-3">Add to cart</span>
                            </a>
                        </div>
                    </div>
                </div>
            </li>

        @endforeach
    </ul>

    @isset($paginator)
    {{ $paginator->links() }}
    @endif
</div>
