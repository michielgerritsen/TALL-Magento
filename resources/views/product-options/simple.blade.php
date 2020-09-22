<?php /** @var \App\DTO\Product $product */ ?>
<div x-data="addToCartSimple()">
    <label for="quantity" class="absolute text-xs -mt-4 sr-only">
        Quantity
    </label>
    <input x-model.number="quantity" id="quantity" type="number" value="1" name="quantity" class="border h-10 w-12 text-center mr-4" />

    <button @click="add" type="button" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
        Add To Cart
    </button>
</div>
<script>
    function addToCartSimple() {
        return {
            quantity: 1,
            sku: '{{$product->getSku()}}',
            add() {
                document.body.dispatchEvent(new Event('menu-open'));
                Livewire.emit('add-to-cart', this.sku, this.quantity);
            }
        }
    }
</script>
