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

class AggregatedPrice extends Aggregate
{
    /**
     * @var int
     */
    private $min = 0;

    /**
     * @var int
     */
    private $max = 0;

    public function __construct(
        string $code,
        int $count,
        string $label,
        array $options
    ) {
        parent::__construct($code, $count, $label, $options);

        $values = [];
        /** @var AggregateOption $option */
        foreach ($options as $option) {
            [$min, $max] = sscanf($option->getValue(), '%d-%d');
            $values[] = $min;
            $values[] = $max;
        }

        $values = array_filter($values);

        $this->min = min($values);
        $this->max = max($values) + 10;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }
}
