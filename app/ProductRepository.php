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

namespace App;

use App\DTO\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    /**
     * @param string $key
     * @return array|\ArrayAccess|mixed
     * @throws \ErrorException
     */
    public function getByUrl(string $key): Product
    {
        $cacheKey = 'product.url.' . $key;
        $cache = Cache::tags(['products']);
        if ($cache->has($cacheKey)) {
            $data = $cache->get($cacheKey);
            return Product::fromGraphqlResponse($data);
        }

        $query = <<<'QUERY'
            query ($urlKey: String!) {
                products(
                    filter: {
                        url_key: {
                            eq: $urlKey
                        }
                    }
                ) {
                    items {
                        PRODUCT_CONTENTS
                    }
                }
            }
QUERY;

        $result = Arr::get(
            GraphQL::query($query, ['urlKey' => $key]),
            'data.products.items.0'
        );

        $cache->put($cacheKey, $result);
        $cache->put('products.sku.' . $result['sku'], $result);

        if (!$result) {
            abort(404);
        }

        return Product::fromGraphqlResponse($result);
    }

    public function getBySku(string $sku): Product
    {
        $cacheKey = 'products.sku.' . $sku;
        $cache = Cache::tags(['products']);
        if ($cache->has($cacheKey)) {
            $data = $cache->get($cacheKey);
            return Product::fromGraphqlResponse($data);
        }

        $query = <<<'QUERY'
            query($sku:String!) {
                products(filter:{sku:{eq:$sku}}) {
                    items {
                        PRODUCT_CONTENTS
                    }
                }
            }
QUERY;

        $result = Arr::get(
            GraphQL::query($query, ['sku' => $sku]),
            'data.products.items.0'
        );

        $cache->put($cacheKey, $result);
        $cache->put('product.url.' . $result['url_key'], $result);

        return Product::fromGraphqlResponse($result);
    }
}
