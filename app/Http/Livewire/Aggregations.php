<?php

namespace App\Http\Livewire;

use App\CategoryRepository;
use App\ProductRepository;
use Livewire\Component;

class Aggregations extends Component
{
    /**
     * @var string
     */
    public $categoryUrlKey;

    /**
     * @var int
     */
    public $price;

    /**
     * @var array
     */
    public $selected = [];

    /**
     * @var string[]
     */
    protected $queryString = ['selected'];

    public function updatingPrice($value)
    {
        $this->select('price', $value);
    }

    public function select(string $aggregateCode, string $optionValue)
    {
        $this->selected[$aggregateCode] = $optionValue;

        $this->emit('update-aggregations', $this->selected);
    }

    public function remove(string $aggregateCode)
    {
        unset($this->selected[$aggregateCode]);

        $this->emit('update-aggregations', $this->selected);
    }

    public function render(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $category = $categoryRepository->getByUrlKey($this->categoryUrlKey);
        $aggregations = $productRepository->getByCategory($category, $this->selected)->getAggregations();

        return view('livewire.aggregations', [
            'aggregations' => $aggregations,
            'isGroupSelected' => function (string $aggregateCode) {
                return array_key_exists($aggregateCode, $this->selected);
            },
            'isOptionSelected' => function (string $aggregateCode, string $optionValue) {
                return array_key_exists($aggregateCode, $this->selected) &&
                    $this->selected[$aggregateCode] == $optionValue;
            }
        ]);
    }
}
