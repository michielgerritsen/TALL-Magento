<?php /** @var \App\DTO\CartItem $item */ ?>

@if($item->getProduct()->getTypeId() == 'ConfigurableProduct')
    @include('livewire.cart.configurable')
@endif
