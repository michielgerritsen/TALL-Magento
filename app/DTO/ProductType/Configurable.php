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

namespace App\DTO\ProductType;

use Assert\Assertion;

class Configurable
{
    /**
     * @var ConfigurableProductOption[]
     */
    private $productOptions;

    public function __construct(
        array $productOptions
    ) {
        Assertion::allIsInstanceOf($productOptions, ConfigurableProductOption::class);

        $this->productOptions = $productOptions;
    }

    public static function fromArray(array $data): Configurable
    {
        $options = [];

        foreach ($data as $option) {
            $values = [];

            foreach ($option['values'] as $value) {
                $values[] = new ConfigurableProductOptionValue(
                    $value['value_index'],
                    $value['label']
                );
            }

            $position = $option['position'];
            $options[$position] = new ConfigurableProductOption(
                $option['id'],
                $option['label'],
                $option['position'],
                $option['attribute_code'],
                $values
            );
        }

        ksort($options);

        return new static($options);
    }

    /**
     * @return ConfigurableProductOption[]
     */
    public function getProductOptions(): array
    {
        return $this->productOptions;
    }
}
