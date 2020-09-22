<?php

namespace App\Http\Livewire;

use App\CartRepository;
use App\ProductRepository;
use Livewire\Component;

class Cart extends Component
{
    protected $listeners = [
        'add-to-cart' => 'addSimple',
        'add-to-cart-configurable' => 'addConfigurable',
        'updateCart' => '$refresh',
    ];

    public function addSimple(CartRepository $cart, ProductRepository $productRepository, string $sku, $quantity = 1)
    {
        $product = $productRepository->getBySku($sku);

        if ($product->getTypeId() != \App\DTO\Product::SIMPLE) {
            return redirect()->route('product', $product->getUrlKey());
        }

        $cart->addSimple($sku, $quantity);
        $this->emit('updateCart');
    }

    public function addConfigurable(CartRepository $cart, string $sku, string $parentSku, $quantity = 1)
    {
        $cart->addConfigurable($sku, $parentSku, $quantity);
        $this->emit('updateCart');
    }

    public function deleteItem(CartRepository $cart, int $id)
    {
        $cart->deleteItemById($id);
        $this->emit('updateCart');
    }

    public function render(CartRepository $cart)
    {
        $dto = $cart->get();

        if (!$dto || !$dto->getTotalQuantity()) {
            return view('livewire.empty-cart');
        }

        return view('livewire.cart', ['cart' => $dto]);
    }
}
