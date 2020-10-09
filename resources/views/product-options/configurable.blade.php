<?php /** @var \App\DTO\Product $product */ ?>
<?php /** @var \App\DTO\ProductType\Configurable $configurable */ ?>
<?php $configurable = $product->getProductTypeSpecific()->getConfigurable(); ?>

<div x-data="addToCartConfigurable()">
    <label for="quantity" class="absolute text-xs -mt-4 sr-only">
        Quantity
    </label>
    <input x-model.number="quantity" id="quantity" type="number" value="1" name="quantity" class="border h-10 w-16 text-center mr-4 inline-block appearance-none bg-white border border-gray-400 hover:border-gray-500 pr-1 rounded shadow leading-tight focus:outline-none focus:shadow-outline h-12" />

    <button x-on:click="add" type="button" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded h-12">
        Add To Cart
    </button>

    @foreach($configurable->getProductOptions() as $option)
        <div class="mt-4">
            <label for="{{$option->getAttributeCode()}}" class="block">{{ $option->getLabel() }}</label>

            <div class="inline-block relative w-64">
                <select id="{{$option->getAttributeCode()}}" name="{{$option->getAttributeCode()}}" x-model="attributes.{{$option->getAttributeCode()}}" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">{{ __('Please select') }}</option>
                    @foreach($option->getValues() as $value)
                        <option value="{{$value->getLabel()}}">{{$value->getLabel()}}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
    @endforeach

    <span class="text-red-700 text-sm" x-show="error">
        @lang('Please select all options marked with at *')
    </span>
</div>

<script>
    function addToCartConfigurable() {
        return {
            quantity: 1,
            sku: '{{$product->getSku()}}',
            attributesCount: {{count($configurable->getProductOptions())}},
            attributes: {},
            error: false,
            add() {
                if (Object.values(this.attributes).length !== this.attributesCount) {
                    this.error = true;
                    return;
                }

                const parentSku = this.sku + '-' + Object.values(this.attributes).join('-');
                document.body.dispatchEvent(new Event('menu-open'));
                Livewire.emit('add-to-cart-configurable', this.sku, parentSku, this.quantity);
            }
        }
    }
</script>
