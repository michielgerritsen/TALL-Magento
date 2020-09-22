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

namespace App\Http\Controllers;

use App\DTO\Product;
use App\GraphQL;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Homepage
{
    public function __invoke()
    {
        $products = Cache::remember('products.bag', 500, function () {
            $query = <<<'GRAPHQL'
                query ($search: String!) {
                  products(search: $search){
                    items {
                      PRODUCT_CONTENTS
                    }
                  }
                }
GRAPHQL;

            return Arr::get(
                GraphQL::query($query, ['search' => 'bag']),
                'data.products.items'
            );
        });

        return view('product-list', [
            'products' => array_map(function ($data) {
                return Product::fromGraphqlResponse($data);
            }, $products ?? [])
        ]);
    }
}
