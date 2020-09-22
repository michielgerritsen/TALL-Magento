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

use App\DTO\CartProductType\Configurable;

class CartProductTypeSpecific
{
    /**
     * @var Configurable
     */
    private $configurable;

    private function __construct(
        Configurable $configurable = null
    ) {
        $this->configurable = $configurable;
    }

    public static function fromArray(array $data): CartProductTypeSpecific
    {
        $configurable = null;
        if (isset($data['configurable_options'])) {
            $configurable = Configurable::fromArray($data['configurable_options']);
        }

        return new static($configurable);
    }

    /**
     * @return Configurable
     */
    public function getConfigurable(): Configurable
    {
        return $this->configurable;
    }
}
