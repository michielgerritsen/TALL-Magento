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

class Address
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var array
     */
    private $street;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var ShippingMethod[]
     */
    private $shippingMethods;

    public function __construct(
        string $firstname,
        string $lastname,
        array $street,
        string $postcode,
        string $city,
        string $country,
        string $telephone,
        array $shippingMethods
    ) {
        Assertion::allIsInstanceOf($shippingMethods, ShippingMethod::class);

        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->street = $street;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->country = $country;
        $this->telephone = $telephone;
        $this->shippingMethods = $shippingMethods;
    }

    public static function fromArray(array $data)
    {
        $shippingMethods = [];
        foreach ($data['available_shipping_methods'] as $method) {
            $shippingMethods[] = ShippingMethod::fromArray($method);
        }

        return new static(
            $data['firstname'],
            $data['lastname'],
            $data['street'],
            $data['postcode'],
            $data['city'],
            $data['country']['code'],
            $data['telephone'],
            $shippingMethods
        );
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return array
     */
    public function getStreet(): array
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @return ShippingMethod[]
     */
    public function getShippingMethods(): array
    {
        return $this->shippingMethods;
    }
}
