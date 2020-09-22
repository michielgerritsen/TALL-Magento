<?php

namespace App\View\Components;

use App\DTO\Price;
use Illuminate\View\Component;

class FormattedPrice extends Component
{
    /**
     * @var Price
     */
    public $price;

    public function __construct(
        Price $price
    ) {
        $this->price = $price;
    }

    /**
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.formatted-price');
    }
}
