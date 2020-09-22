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

use Assert\Assertion;

class Cart
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @var Price
     */
    private $subtotal;

    /**
     * @var Price
     */
    private $grandTotal;

    /**
     * @var Price[]
     */
    private $taxes;

    /**
     * @var int
     */
    private $totalQuantity;

    /**
     * @var CartItem[]
     */
    private $items;

    private function __construct(
        string $email = null,
        Price $subtotal,
        Price $grandTotal,
        array $taxes,
        int $totalQuantity,
        array $items
    ) {
        Assertion::allIsInstanceOf($items, CartItem::class);
        Assertion::allIsInstanceOf($taxes, Price::class);

        $this->email = $email;
        $this->subtotal = $subtotal;
        $this->grandTotal = $grandTotal;
        $this->taxes = $taxes;
        $this->totalQuantity = $totalQuantity;
        $this->items = $items;
    }

    public static function fromArray(array $data)
    {
        $taxes = [];
        foreach ($data['prices']['applied_taxes'] as $tax) {
            $taxes[] = new Price($tax['amount']['currency'], $tax['amount']['value']);
        }

        return new static(
            $data['email'],
            new Price($data['prices']['subtotal_excluding_tax']['currency'], $data['prices']['subtotal_excluding_tax']['value']),
            new Price($data['prices']['grand_total']['currency'], $data['prices']['grand_total']['value']),
            $taxes,
            $data['total_quantity'],
            array_map(function ($data) { return CartItem::fromArray($data); }, $data['items'])
        );
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return Price
     */
    public function getSubtotal(): Price
    {
        return $this->subtotal;
    }

    /**
     * @return Price
     */
    public function getGrandTotal(): Price
    {
        return $this->grandTotal;
    }

    /**
     * @return Price[]
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * @return int
     */
    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return Price
     */
    public function getTotalTax(): Price
    {
        $total = 0.0;
        $currency = 'EUR';
        foreach ($this->taxes as $tax) {
            $currency = $tax->getCurrency();
            $total += $tax->getValue();
        }

        return new Price($currency, $total);
    }
}
