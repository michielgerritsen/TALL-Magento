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

class Addresses
{
    /**
     * @var Addresses
     */
    private $shipping;

    /**
     * @var Addresses
     */
    private $billing;

    public function __construct(
        Addresses $shipping,
        Addresses $billing
    ) {
        $this->shipping = $shipping;
        $this->billing = $billing;
    }

    /**
     * @return Addresses
     */
    public function getShipping(): Addresses
    {
        return $this->shipping;
    }

    /**
     * @return Addresses
     */
    public function getBilling(): Addresses
    {
        return $this->billing;
    }
}
