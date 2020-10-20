<?php

namespace App\Http\Livewire;

use App\CartRepository;
use Livewire\Component;

class OrderTotals extends Component
{
    protected $listeners = ['update-order-totals' => '$refresh'];

    public function render(CartRepository $cartRepository)
    {
        return view('livewire.order-totals', [
            'totals' => $cartRepository->getTotals(),
        ]);
    }
}
