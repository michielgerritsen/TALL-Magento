<?php /** @var \App\DTO\CartTotals $totals */ ?>
<div class="mt-6 bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 relative">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 sm:rounded-lg flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-8 w-8 m-auto"></div>
    </div>

    <table class="table-auto w-full">
        <tbody>
            <tr>
                <td class="border-b px-4 py-2">@lang('Subtotal:')</td>
                <td class="border-b px-4 py-2 text-right"><x-formatted-price :price="$totals->getSubtotalExcludingTax()" /></td>
            </tr>

            @foreach ($totals->getDiscounts() as $discount)
                <tr>
                    <td class="border-b px-4 py-2">{{ $discount->getLabel() }}:</td>
                    <td class="border-b px-4 py-2 text-right"><x-formatted-price :price="$discount->getPrice()" /></td>
                </tr>
            @endforeach

            @foreach ($totals->getAppliedTaxes() as $tax)
                <tr>
                    <td class="border-b px-4 py-2">{{ $tax->getLabel() }}:</td>
                    <td class="border-b px-4 py-2 text-right"><x-formatted-price :price="$tax->getPrice()" /></td>
                </tr>
            @endforeach

            <tr>
                <td class="text-xl px-4 py-2">@lang('Grand Total:')</td>
                <td class="text-xl px-4 py-2 text-right"><x-formatted-price :price="$totals->getGrandTotal()" /></td>
            </tr>
        </tbody>
    </table>
</div>
