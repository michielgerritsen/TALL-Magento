<?php

namespace App\Http\Livewire;

use App\CartRepository;
use Livewire\Component;

class OrderTotals extends Component
{
    public function render(CartRepository $cartRepository)
    {
        $cart = $cartRepository->get();

        return view('livewire.order-totals', [
            'cart' => $cart,
        ]);
    }
}
