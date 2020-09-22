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

class ProductPrices
{
    /**
     * @var Price
     */
    private $maximalPrice;

    /**
     * @var Price
     */
    private $minimalPrice;

    /**
     * @var Price
     */
    private $regularPrice;

    public function __construct(
        Price $maximalPrice,
        Price $minimalPrice,
        Price $regularPrice
    ) {
        $this->maximalPrice = $maximalPrice;
        $this->minimalPrice = $minimalPrice;
        $this->regularPrice = $regularPrice;
    }

    /**
     * @return Price
     */
    public function getMaximalPrice(): Price
    {
        return $this->maximalPrice;
    }

    /**
     * @return Price
     */
    public function getMinimalPrice(): Price
    {
        return $this->minimalPrice;
    }

    /**
     * @return Price
     */
    public function getRegularPrice(): Price
    {
        return $this->regularPrice;
    }

    public function showDiscount(): bool
    {
        return $this->regularPrice->getValue() != $this->minimalPrice->getValue();
    }
}
