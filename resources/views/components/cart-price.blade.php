<?php /** @var \App\DTO\CartItem $item */ ?>

<x-formatted-price :price="$item->getPrice()" />
