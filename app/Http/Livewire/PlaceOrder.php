<?php

namespace App\Http\Livewire;

use App\GraphQL;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PlaceOrder extends Component
{
    public function placeOrder()
    {
        $query = <<<'QUERY'
mutation ($cartId: String!) {
  placeOrder(input: {
      cart_id: $cartId
  }) {
    order {
      order_id
    }
  }
}
QUERY;

        $result = GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
        ]);

        $incrementId = Arr::get($result, 'data.placeOrder.order.order_id');
        Session::put('increment-id', $incrementId);
        Session::forget('cart-id');

        return redirect()->route('success');
    }

    public function render()
    {
        return view('livewire.place-order');
    }
}
