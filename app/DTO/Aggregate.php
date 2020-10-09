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

class Aggregate
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $count;

    /**
     * @var string
     */
    private $label;

    /**
     * @var array
     */
    private $options;

    public function __construct(
        string $code,
        int $count,
        string $label,
        array $options
    ) {
        Assertion::allIsInstanceOf($options, AggregateOption::class);

        $this->code = $code;
        $this->count = $count;
        $this->label = $label;
        $this->options = $options;
    }

    public static function fromArray(array $data): Aggregate
    {
        $class = Aggregate::class;
        $optionClass = AggregateOption::class;
        if ($data['attribute_code'] == 'price') {
            $class = AggregatedPrice::class;
            $optionClass = AggregatedPriceOption::class;
        }

        $options = [];
        foreach ($data['options'] as $option) {
            $options[] = new $optionClass(
                $option['count'],
                $option['label'],
                $option['value']
            );
        }

        return new $class(
            $data['attribute_code'],
            $data['count'],
            $data['label'],
            $options
        );
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return AggregateOption[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
