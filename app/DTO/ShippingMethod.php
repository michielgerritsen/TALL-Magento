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

class ShippingMethod
{
    /**
     * @var string
     */
    private $carrier;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Price
     */
    private $priceInclTax;

    /**
     * @var Price
     */
    private $priceExclTax;

    public function __construct(
        string $carrier,
        string $method,
        string $title,
        Price $priceInclTax,
        Price $priceExclTax
    ) {
        $this->carrier = $carrier;
        $this->method = $method;
        $this->title = $title;
        $this->priceInclTax = $priceInclTax;
        $this->priceExclTax = $priceExclTax;
    }

    public static function fromArray($method)
    {
        return new static(
            $method['carrier_code'],
            $method['method_code'],
            $method['method_title'],
            new Price($method['price_incl_tax']['currency'], $method['price_incl_tax']['value']),
            new Price($method['price_excl_tax']['currency'], $method['price_excl_tax']['value'])
        );
    }

    /**
     * @return string
     */
    public function getCarrier(): string
    {
        return $this->carrier;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Price
     */
    public function getPriceInclTax(): Price
    {
        return $this->priceInclTax;
    }

    /**
     * @return Price
     */
    public function getPriceExclTax(): Price
    {
        return $this->priceExclTax;
    }

    public function getIdentifier(): string
    {
        return $this->carrier . '_' . $this->method;
    }
}
