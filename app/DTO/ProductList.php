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

class ProductList
{
    /**
     * @var array
     */
    private $products;

    /**
     * @var array
     */
    private $aggregations;

    public function __construct(
        array $products,
        array $aggregations
    ) {
        Assertion::allIsInstanceOf($products, Product::class);
        $this->products = $products;
        $this->aggregations = $aggregations;
    }

    public static function fromArray(array $data): ProductList
    {
        $aggregations = [];
        foreach ($data['aggregations'] as $aggregateData) {
            $aggregate = Aggregate::fromArray($aggregateData);
            $aggregations[$aggregate->getCode()] = $aggregate;
        }

        return new static(
            array_map(function ($data) { return \App\DTO\Product::fromGraphqlResponse($data);}, $data['items']),
            $aggregations
        );
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return array
     */
    public function getAggregations(): array
    {
        return $this->aggregations;
    }
}
