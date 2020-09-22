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

use App\DTO\Product as ProductDTO;
use App\GraphQL;
use App\ProductRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Product
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(
        ProductRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(string $key)
    {
        $product = $this->repository->getByUrl($key);

        if ($product == null) {
            abort(404);
        }

        return view('product', [
            'product' => $product,
        ]);
    }
}
