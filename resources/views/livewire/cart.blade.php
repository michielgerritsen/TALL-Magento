<?php /** @var \App\DTO\Cart $cart */ ?>
<?php /** @var \App\DTO\CartItem $item */ ?>
<div class="side-menu-cart h-full overflow-auto">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32 m-auto"></div>
    </div>

    <div class="relative mx-auto pt-4 h-full">
        <button class="mr-4 float-right p-2 hover:bg-black hover:text-white absolute right-0" @click="cartMenuOpen = false">
            X
            <span class="sr-only">Close menu</span>
        </button>

        <nav class="bg-white px-4 pt-4">

            @foreach($cart->getItems() as $item)

                @php
                $product = $item->getProduct();
                @endphp

                    <div class="grid grid-cols-5 gap-4 pt-8">
                        <div class="col-span-1">
                            <img class="w-16 h-16 flex-shrink-0 mx-auto bg-black rounded-full" src="{{$product->getProductImages()->getSmallImage()->getUrl()}}" alt="">
                        </div>
                        <div class="col-span-3">
                            <span class="text-gray-900 text-sm leading-5 font-medium block">
                                <a href="{{ route('product', ['key' => $product->getUrlKey()]) }}">
                                    {!! $product->getName() !!}
                                </a>
                            </span>
                            <span>
                                {{$item->getQuantity()}} X
                                <x-cart-price :item="$item" />
                                @include('livewire.cart.product-specific')
                            </span>
                        </div>
                        <div class="col-span-1 align-middle">
                            <x-formatted-price :price="$item->getRowTotal()" />
                            <br>
                            <button wire:click="deleteItem({{$item->getId()}})" class="border border-red-400 rounded text-red-400 hover:text-red-800 bg-red-200 hover:bg-red-400 w-4 h-4 text-xs -pt-2 ">
                                X
                            </button>
                        </div>
                    </div>

            @endforeach

            <hr class="my-8">

            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-4 font-thin">Subtotal</div>
                <div class="col-span-1 font-thin text-right">
                    <x-formatted-price :price="$cart->getSubtotal()" />
                </div>
            </div>

            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-4 font-thin">Tax</div>
                <div class="col-span-1 font-thin text-right">
                    <x-formatted-price :price="$cart->getTotalTax()" />
                </div>
            </div>

            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-4 font-extrabold">Total</div>
                <div class="col-span-1 font-extrabold text-right">
                    <x-formatted-price :price="$cart->getGrandTotal()" />
                </div>
            </div>

            <a href="/checkout" class="my-8 float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Checkout &raquo;
            </a>
        </nav>
    </div>
</div>
