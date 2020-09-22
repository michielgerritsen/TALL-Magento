<?php

namespace App\Http\Livewire;

use App\CartRepository;
use App\CheckoutRepository;
use App\GraphQL;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ShippingMethods extends Component
{
    /**
     * @var string
     */
    public $method = null;

    protected $listeners = ['shipping-methods:load' => '$refresh'];

    public function setShippingMethod()
    {
        [$method, $carrier] = explode('_', $this->method);

        $query = <<<'GRAPHQL'
mutation ($cartId: String!, $carrierCode: String!, $methodCode: String!) {
  setShippingMethodsOnCart(input: {
    cart_id: $cartId
    shipping_methods: [
      {
        carrier_code: $carrierCode
        method_code: $methodCode
      }
    ]
  }) {
    cart {
      shipping_addresses {
        selected_shipping_method {
          carrier_code
          method_code
          carrier_title
          method_title
        }
      }
    }
  }
}
GRAPHQL;

        GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'carrierCode' => $carrier,
            'methodCode' => $method,
        ]);
    }

    public function render(CheckoutRepository $repository)
    {
        $methods = [];
        $addresses = $repository->getShippingAddresses();
        if ($address = array_shift($addresses)) {
            $methods = $address->getShippingMethods();
        }

        return view('livewire.shipping-methods', ['methods' => $methods]);
    }
}
