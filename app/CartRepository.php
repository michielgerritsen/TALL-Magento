<?php
/**
 *    ______            __             __
 *   / ____/___  ____  / /__________  / /
 *  / /   / __ \/ __ \/ __/ ___/ __ \/ /
 * / /___/ /_/ / / / / /_/ /  / /_/ / /
 * \______________/_/\__/_/   \____/_/
 *    /   |  / / /_
 *   / /| | / / __/
 *  / ___ |/ / /_
 * /_/ _|||_/\__/ __     __
 *    / __ \___  / /__  / /____
 *   / / / / _ \/ / _ \/ __/ _ \
 *  / /_/ /  __/ /  __/ /_/  __/
 * /_____/\___/_/\___/\__/\___/
 *
 */

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CartRepository
{
    /**
     * @var \Illuminate\Cache\TaggedCache
     */
    private $cache;

    public function __construct() {
        $this->cache = Cache::tags(['cart', 'cart.' . Session::get('cart-id')]);
    }

    /**
     * @return DTO\Cart|null
     */
    public function get(): ?DTO\Cart
    {
        $cart = [];
        $cartId = Session::get('cart-id');
        if ($cartId && $this->cache->has('contents')) {
            $cart = $this->cache->get('contents');
        }

        if (!$cart) {
            return null;
        }

        return DTO\Cart::fromArray($cart);
    }

    /**
     * @param string $sku
     * @param int $quantity
     * @throws \ErrorException
     */
    public function addSimple(string $sku, $quantity = 1): void
    {
        if (!Session::has('cart-id')) {
            $this->createCart();
        }

        $query = <<<'GRAPHQL'
mutation ($cartId: String!, $quantity: Float!, $sku: String!) {
    addSimpleProductsToCart(
        input: {
            cart_id: $cartId
            cart_items: [
                {
                    data: {
                        quantity: $quantity
                        sku: $sku
                    }
                }
            ]
        }
    ) {
        cart {
            CART_CONTENTS
        }
    }
}
GRAPHQL;

        $result = GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'sku' => $sku,
            'quantity' => $quantity,
        ]);

        $this->setCartCache(Arr::get($result, 'data.addSimpleProductsToCart.cart'));
    }

    /**
     * @param string $parentSku
     * @param string $sku
     * @param int $quantity
     * @throws \ErrorException
     */
    public function addConfigurable(string $parentSku, string $sku, $quantity = 1): void
    {
        if (!Session::has('cart-id')) {
            $this->createCart();
        }

        $query = <<<'GRAPHQL'
mutation ($cartId: String!, $quantity: Float!, $sku: String!, $parentSku: String!) {
    addConfigurableProductsToCart(
        input: {
            cart_id: $cartId
            cart_items: [
                {
                    parent_sku: $parentSku
                    data: {
                        quantity: $quantity
                        sku: $sku
                    }
                }
            ]
        }
    ) {
        cart {
            CART_CONTENTS
        }
    }
}
GRAPHQL;

        $result = GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'sku' => $sku,
            'parentSku' => $parentSku,
            'quantity' => $quantity,
        ]);

        $this->setCartCache(Arr::get($result, 'data.addConfigurableProductsToCart.cart'));
    }

    /**
     * @param int $id
     * @throws \ErrorException
     */
    public function deleteItemById(int $id)
    {
        $query = <<<'QUERY'
            mutation ($cartId: String!, $itemId: Int!) {
                removeItemFromCart(
                    input: {
                        cart_id: $cartId,
                        cart_item_id: $itemId
                    }
                ) {
                    cart {
                        CART_CONTENTS
                    }
                }
            }
QUERY;

        $result = GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'itemId' => $id,
        ]);

        $this->setCartCache(Arr::get($result, 'data.removeItemFromCart.cart'));
    }

    public function addEmailAddressToCart(string $email)
    {
        $query = <<<'QUERY'
mutation($cartId: String!, $email: String!) {
    setGuestEmailOnCart(input: {
        cart_id: $cartId
        email: $email
    }) {
        cart {
            CART_CONTENTS
        }
    }
}
QUERY;

        $result = GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'email' => $email,
        ]);

        $this->setCartCache(Arr::get($result, 'data.setGuestEmailOnCart.cart'));
    }

    private function setCartCache(array $contents = null): void
    {
        $this->cache->put('contents', $contents, 300);
    }

    private function createCart(): void
    {
        $result = GraphQL::query('mutation {createEmptyCart}');

        Session::put('cart-id', $result['data']['createEmptyCart']);
        $this->cache = Cache::tags(['cart', 'cart.' . Session::get('cart-id')]);
    }
}
