<?php

namespace App\View\Components;

use App\DTO\ProductPrices;
use Illuminate\View\Component;

class ProductPrice extends Component
{
    /**
     * @var ProductPrices
     */
    public $prices;

    public function __construct(
        ProductPrices $prices
    ) {
        $this->prices = $prices;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.product-price');
    }
}
