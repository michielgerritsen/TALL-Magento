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

namespace App\DTO\CartProductType;

class ConfigurableProductOption
{
    /**
     * @var string
     */
    private $option;

    /**
     * @var string
     */
    private $label;

    public function __construct(
        string $option,
        string $label
    ) {
        $this->option = $option;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getOption(): string
    {
        return $this->option;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
}
