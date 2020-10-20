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

class CartTotals
{
    /**
     * @var Price
     */
    private $grandTotal;

    /**
     * @var Price
     */
    private $subtotalExcludingTax;

    /**
     * @var Price
     */
    private $subtotalIncludingTax;

    /**
     * @var Price
     */
    private $subtotalWithDiscountExcludingTax;

    /**
     * @var LabeledPrice[]
     */
    private $appliedTaxes;

    /**
     * @var LabeledPrice[]
     */
    private $discounts;

    public function __construct(
        Price $grandTotal,
        Price $subtotalExcludingTax,
        Price $subtotalIncludingTax,
        Price $subtotalWithDiscountExcludingTax,
        array $appliedTaxes,
        array $discounts
    ) {
        Assertion::allIsInstanceOf($appliedTaxes, LabeledPrice::class);
        Assertion::allIsInstanceOf($discounts, LabeledPrice::class);

        $this->grandTotal = $grandTotal;
        $this->subtotalExcludingTax = $subtotalExcludingTax;
        $this->subtotalIncludingTax = $subtotalIncludingTax;
        $this->subtotalWithDiscountExcludingTax = $subtotalWithDiscountExcludingTax;
        $this->appliedTaxes = $appliedTaxes;
        $this->discounts = $discounts;
    }

    public static function fromArray(array $data): CartTotals
    {
        return new static(
            new Price($data['grand_total']['currency'], $data['grand_total']['value']),
            new Price($data['subtotal_excluding_tax']['currency'], $data['subtotal_excluding_tax']['value']),
            new Price($data['subtotal_including_tax']['currency'], $data['subtotal_including_tax']['value']),
            new Price($data['subtotal_with_discount_excluding_tax']['currency'], $data['subtotal_with_discount_excluding_tax']['value']),
            self::parsePriceArray('applied_taxes', $data),
            self::parsePriceArray('discounts', $data)
        );
    }

    /**
     * @param array $data
     * @return array
     */
    private static function parsePriceArray(string $key, array $data): array
    {
        if (!$data[$key]) {
            return [];
        }

        $output = [];
        foreach ($data[$key] as $price) {
            $output[] = new LabeledPrice(
                $price['label'],
                new Price($price['amount']['currency'], $price['amount']['value'])
            );
        }

        return $output;
    }

    /**
     * @return Price
     */
    public function getGrandTotal(): Price
    {
        return $this->grandTotal;
    }

    /**
     * @return Price
     */
    public function getSubtotalExcludingTax(): Price
    {
        return $this->subtotalExcludingTax;
    }

    /**
     * @return Price
     */
    public function getSubtotalIncludingTax(): Price
    {
        return $this->subtotalIncludingTax;
    }

    /**
     * @return Price
     */
    public function getSubtotalWithDiscountExcludingTax(): Price
    {
        return $this->subtotalWithDiscountExcludingTax;
    }

    /**
     * @return LabeledPrice[]
     */
    public function getAppliedTaxes(): array
    {
        return $this->appliedTaxes;
    }

    /**
     * @return LabeledPrice[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }
}
