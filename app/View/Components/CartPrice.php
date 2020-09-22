<?php

namespace App\View\Components;

use App\DTO\CartItem;
use Illuminate\View\Component;

class CartPrice extends Component
{
    /**
     * @var CartItem
     */
    public $item;

    public function __construct(
        CartItem $item
    ) {
        $this->item = $item;
    }

    /**
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.cart-price');
    }
}
