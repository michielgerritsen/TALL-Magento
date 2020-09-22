<?php /** @var \App\DTO\Product $product */ ?>

@if ($product->getTypeId() == 'SimpleProduct')
    @include('product-options.simple')
@elseif ($product->getTypeId() == 'ConfigurableProduct')
    @include('product-options.configurable')
@else
    This product type ({{$product->getTypeId()}}) is not implemented yet
@endif
