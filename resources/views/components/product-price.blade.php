<?php /** @var \App\DTO\ProductPrices $prices */ ?>
<div>
    @if ($prices->showDiscount())
        <span class="text-4xl font-bold">
            <x-formatted-price :price="$prices->getMinimalPrice()" />
        </span>
        <span class="line-through text-2xl text-gray-600">
            <x-formatted-price :price="$prices->getRegularPrice()" />
        </span>
    @else
        <span class="text-4xl font-bold">
            <x-formatted-price :price="$prices->getRegularPrice()" />
        </span>
    @endif
</div>
