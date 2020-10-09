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

use App\DTO\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CategoryRepository
{
    public function getByUrlKey($urlKey): ?Category
    {
        $data = Cache::tags(['categories'])->remember($urlKey, 3600, function () use ($urlKey) {
            $query = <<<'QUERY'
                query($urlKey:String!) {
                    categories(filters: {url_key: {eq:$urlKey}}) {
                        items {
                            id
                            name
                            url_key
                        }
                    }
                }
QUERY;

            return Arr::get(
                GraphQL::query($query, ['urlKey' => $urlKey]),
                'data.categories.items.0'
            );
        });

        return Category::fromArray($data);
    }
}
