<?php

namespace App\View\Components;

use App\DTO\ProductPrices;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProductPrice extends Component
{
    /**
     * @var ProductPrices
     */
    public $prices;

    /**
     * @var string
     */
    public $size;

    public function __construct(
        ProductPrices $prices,
        $size = 'big'
    ) {
        $this->prices = $prices;
        $this->size = $size;
    }

    /**
     * @return View
     */
    public function render()
    {
        return view('components.product-price');
    }
}
