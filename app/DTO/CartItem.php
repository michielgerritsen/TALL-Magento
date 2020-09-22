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

namespace App\DTO;

class CartItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var Price
     */
    private $rowTotal;

    /**
     * @var CartProductTypeSpecific
     */
    private $cartProductTypeSpecific;

    private function __construct(
        int $id,
        int $quantity,
        Product $product,
        Price $price,
        Price $rowTotal,
        CartProductTypeSpecific $cartProductTypeSpecific
    ) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->price = $price;
        $this->rowTotal = $rowTotal;
        $this->cartProductTypeSpecific = $cartProductTypeSpecific;
    }

    public static function fromArray(array $data)
    {
        $product = Product::fromGraphqlResponse($data['product']);

        return new static(
            $data['id'],
            $data['quantity'],
            $product,
            new Price($data['prices']['price']['currency'], $data['prices']['price']['value']),
            new Price($data['prices']['row_total_including_tax']['currency'], $data['prices']['row_total_including_tax']['value']),
            CartProductTypeSpecific::fromArray($data)
        );
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return Price
     */
    public function getRowTotal(): Price
    {
        return $this->rowTotal;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return CartProductTypeSpecific
     */
    public function getCartProductTypeSpecific(): CartProductTypeSpecific
    {
        return $this->cartProductTypeSpecific;
    }
}
