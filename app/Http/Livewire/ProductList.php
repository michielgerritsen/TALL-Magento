<?php

namespace App\Http\Livewire;

use App\CartRepository;
use App\CategoryRepository;
use App\DTO\Category;
use App\DTO\Product;
use App\GraphQL;
use App\ProductRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ProductList extends Component
{
    /**
     * @var string
     */
    public $categoryUrlKey;

    /**
     * @var array
     */
    public $selected = [];

    /**
     * @var string[]
     */
    protected $queryString = ['selected'];

    protected $listeners = [
        'update-aggregations' => 'setSelected',
    ];

    public function setSelected(array $selected)
    {
        $this->selected = $selected;
    }

    public function render(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $category = $categoryRepository->getByUrlKey($this->categoryUrlKey);
        $productList = $productRepository->getByCategory($category, $this->selected);

        return view('livewire.product-list', [
            'category' => $category,
            'products' => $productList->getProducts(),
            'aggregations' => $productList->getAggregations(),
        ]);
    }
}
