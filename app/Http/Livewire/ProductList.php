<?php

namespace App\Http\Livewire;

use App\CartRepository;
use App\DTO\Product;
use App\GraphQL;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {

    }

    public function addToCart(CartRepository $cart, string $sku)
    {
        $cart->addSimple($sku);
        $this->emit('updateCart');
    }
}
