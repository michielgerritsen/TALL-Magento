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

use App\DTO\ProductType\Bundle;
use App\DTO\ProductType\Configurable;

class ProductTypeSpecific
{
    /**
     * @var Configurable|null
     */
    private $configurable;

    /**
     * @var Bundle|null
     */
    private $bundle;

    private function __construct(
        Configurable $configurable = null,
        Bundle $bundle = null
    ) {
        $this->configurable = $configurable;
        $this->bundle = $bundle;
    }

    public static function fromArray(array $data): ProductTypeSpecific
    {
        $configurable = null;
        if (isset($data['configurable_options'])) {
            $configurable = Configurable::fromArray($data['configurable_options']);
        }

        $bundle = null;
        if ($data['__typename'] == 'BundleProduct') {
            $bundle = Bundle::fromArray($data);
        }

        return new static($configurable);
    }

    /**
     * @return Configurable
     */
    public function getConfigurable(): ?Configurable
    {
        return $this->configurable;
    }

    /**
     * @return Bundle|null
     */
    public function getBundle(): ?Bundle
    {
        return $this->bundle;
    }
}
