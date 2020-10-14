<?php /** @var \App\DTO\Cart $cart */ ?>
<div>
    @if ($cart)
        {{ $cart->getGrandTotal()->getValue() }}
    @endif
</div>
