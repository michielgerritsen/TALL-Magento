<?php

namespace App\Http\Livewire;

use App\GraphQL;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PaymentMethods extends Component
{
    public function setPaymentMethod($method)
    {
        $query = <<<'QUERY'
mutation($cartId: String!, $method: String!) {
  setPaymentMethodOnCart(input: {
      cart_id: $cartId
      payment_method: {
          code: $method
      }
  }) {
    cart {
      selected_payment_method {
        code
      }
    }
  }
}
QUERY;

        GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'method' => $method,
        ]);

        $this->emit('update-order-totals');
    }

    public function render()
    {
        $query = <<<'QUERY'
            query ($cartId: String!) {
                cart(cart_id: $cartId) {
                    available_payment_methods {
                        code
                        title
                    }
                }
            }
QUERY;

        $result = GraphQL::query($query, ['cartId' => Session::get('cart-id')]);
        $methods = Arr::get($result, 'data.cart.available_payment_methods');

        return view('livewire.payment-methods', ['methods' => $methods]);
    }
}
