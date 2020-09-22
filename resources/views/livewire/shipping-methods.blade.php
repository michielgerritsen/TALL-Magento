<?php /** @var \App\DTO\ShippingMethod $method */ ?>
<div class="relative">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 sm:rounded-lg flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-8 w-8 m-auto"></div>
    </div>

    <div class="mt-6 bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <ul>
            @forelse($methods as $method)
                <li>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2">
                            <input wire:model="method" wire:change="setShippingMethod" type="radio" value="{{$method->getIdentifier()}}" id="{{$method->getIdentifier()}}" />
                            <label for="{{$method->getIdentifier()}}">
                                {{$method->getTitle()}}
                            </label>
                        </div>

                        <div class="col-span-1 text-right">
                            <label for="{{$method->getIdentifier()}}">
                                <x-formatted-price :price="$method->getPriceInclTax()" />
                            </label>
                        </div>
                    </div>
                </li>
            @empty
                @lang('No shipping methods available')
            @endforelse
        </ul>
    </div>
</div>
