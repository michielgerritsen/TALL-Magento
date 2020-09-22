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

class ConfigurableProductOption
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $label;

    /**
     * @var int
     */
    private $position;

    /**
     * @var string
     */
    private $attributeCode;

    /**
     * @var ConfigurableProductOptionValue[]
     */
    private $values;

    public function __construct(
        int $id,
        string $label,
        int $position,
        string $attributeCode,
        array $values
    ) {
        Assertion::allIsInstanceOf($values, ConfigurableProductOptionValue::class);

        $this->id = $id;
        $this->label = $label;
        $this->position = $position;
        $this->attributeCode = $attributeCode;
        $this->values = $values;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    /**
     * @return ConfigurableProductOptionValue[]
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
