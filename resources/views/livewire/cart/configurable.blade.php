<?php /** @var \App\DTO\CartItem $item */ ?>
<?php $configurable = $item->getCartProductTypeSpecific()->getConfigurable(); ?>

<div class="text-sm text-gray-500">
    @foreach($configurable->getProductOptions() as $option)
        <div>
            {{ $option->getOption() }}: {{ $option->getLabel() }}
        </div>
    @endforeach
</div>
