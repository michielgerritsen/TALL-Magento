<?php /** @var \App\DTO\ProductPrices $prices */ ?>
<div>
    @if ($prices->showDiscount())
        <span class="{{ $size == 'big' ? 'text-4xl' : 'text-normal' }} font-bold">
            <x-formatted-price :price="$prices->getMinimalPrice()" />
        </span>
        <span class="{{ $size == 'big' ? 'text-2xl' : 'text-sm' }} line-through text-gray-600">
            <x-formatted-price :price="$prices->getRegularPrice()" />
        </span>
    @else
        <span class="{{ $size == 'big' ? 'text-4xl' : 'text-normal' }} font-bold">
            <x-formatted-price :price="$prices->getRegularPrice()" />
        </span>
    @endif
</div>
