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

class AggregatedPriceOption extends AggregateOption
{
    public function __construct(
        int $count,
        string $label,
        string $value
    ) {
        parent::__construct($count, $this->formatLabel($value), $value);
    }

    private function formatLabel(string $value)
    {
        [$priceFrom, $priceTo] = explode('_', $value);

        if ($priceTo == '*') {
            return __(':price and above', ['price' => '&euro; ' . $priceFrom]);
        }

        return '&euro; ' . $priceFrom . ' - &euro; ' . $priceTo;
    }
}
