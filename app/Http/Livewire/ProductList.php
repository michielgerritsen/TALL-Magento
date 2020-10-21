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
     * @var int
     */
    public $page = 1;

    /**
     * @var array
     */
    public $selected = [];

    /**
     * @var string[]
     */
    protected $queryString = ['selected', 'page'];

    protected $listeners = [
        'update-aggregations' => 'setSelected',
    ];

    public function setSelected(array $selected)
    {
        $this->selected = $selected;
    }

    public function setPage(int $page)
    {
        $this->page = $page;

        $this->dispatchBrowserEvent('scrollToTop');
    }

    public function render(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $category = $categoryRepository->getByUrlKey($this->categoryUrlKey);
        $productList = $productRepository->getByCategory($category, $this->page, $this->selected);

        return view('livewire.product-list', [
            'category' => $category,
            'products' => $productList->getProducts(),
            'aggregations' => $productList->getAggregations(),
            'paginator' => $productList->getPagination()->getPaginator(),
        ]);
    }
}
