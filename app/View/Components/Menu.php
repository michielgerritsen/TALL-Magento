<?php

namespace App\View\Components;

use App\CartRepository;
use App\GraphQL;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * @var CartRepository
     */
    private $cart;

    public function __construct(
        CartRepository $cart
    ) {
        $this->cart = $cart;
    }

    /**
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $categories = $this->getCategories();

        return view('components.menu', [
            'categories' => $categories,
            'cart' => $this->cart->get(),
        ]);
    }

    private function getCategories(): array
    {
        return Cache::tags(['general'])->remember('menu', 3600, function () {
            $query = <<<'QUERY'
                query {
                    categories {
                        items {
                            name
                            url_key
                            image
                            children_count
                            children {
                                name
                                url_key
                                image
                                children_count
                                children {
                                    name
                                    url_key
                                    image
                                    children_count
                                    children {
                                        name
                                        url_key
                                        image
                                        children_count
                                        children {
                                            name
                                            url_key
                                            image
                                            children_count
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
QUERY;
            $result = GraphQL::query($query);

            return Arr::get($result, 'data.categories.items.0.children');
        });
    }
}
