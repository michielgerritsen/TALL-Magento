<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartQuantity extends Component
{
    protected $listeners = [
        'updateCart' => '$refresh',
    ];

    public function render(\App\CartRepository $cart)
    {
        $dto = $cart->get();

        return view('livewire.cart-quantity', [
            'quantity' => $dto ? $dto->getTotalQuantity() : 0,
        ]);
    }
}
