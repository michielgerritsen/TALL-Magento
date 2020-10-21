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

    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(
        array $products,
        array $aggregations,
        Pagination $pagination
    ) {
        Assertion::allIsInstanceOf($products, Product::class);
        $this->products = $products;
        $this->aggregations = $aggregations;
        $this->pagination = $pagination;
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
            $aggregations,
            new Pagination(
                $data['page_info']['total_count'],
                $data['page_info']['current_page'],
                $data['page_info']['page_size'],
                $data['page_info']['total_pages']
            )
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

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
