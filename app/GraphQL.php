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

class GraphQL
{
    const CART_CONTENTS = <<<'CARTCONTENTS'
        email
        total_quantity
        prices {
            grand_total {
                currency
                value
            }
            applied_taxes {
                amount {
                    currency
                    value
                }
                label
            }
            subtotal_excluding_tax {
                currency
                value
            }
        }
        items {
            id
            quantity
            prices {
                price {
                    currency
                    value
                }
                discounts {
                    amount {
                        currency
                        value
                    }
                    label
                }
                row_total {
                    currency
                    value
                }
                row_total_including_tax {
                    currency
                    value
                }
                total_item_discount {
                    currency
                    value
                }
            }
            product {
                PRODUCT_CONTENTS
            }
            ... on ConfigurableCartItem {
                configurable_options {
                    option_label
                    value_label
                }
            }
        }
CARTCONTENTS;

    const PRODUCT_CONTENTS = <<<'PRODUCT'
        __typename
        id
        sku
        name
        url_key
        small_image {
            label
            url
        }
        image {
            label
            url
        }
        description {
            html
        }
        media_gallery {
            label
            url
        }
        price {
            maximalPrice {
                amount {
                    currency
                    value
                }
            }
            minimalPrice {
                amount {
                    currency
                    value
                }
            }
            regularPrice {
                amount {
                    currency
                    value
                }
            }
        }
        ...on ConfigurableProduct {
            configurable_options {
        	    id
                attribute_id_v2
                label
                position
                use_default
                attribute_code
                values {
                    value_index
                    label
                }
            product_id
        }
    }
PRODUCT;

    public static function query(string $query, array $variables = [], $debug = false)
    {
        $query = str_replace(
            [
                'CART_CONTENTS',
                'PRODUCT_CONTENTS',
            ],
            [
                static::CART_CONTENTS,
                static::PRODUCT_CONTENTS,
            ],
            $query
        );

        if ($debug) {
            dump($query);
        }

        $endpoint = config('services.graphql.endpoint');

        if (!$endpoint) {
            throw new \Exception('Please set the GRAPHQL_ENDPOINT variable in your .env file first');
        }

        $headers = ['Content-Type: application/json', 'User-Agent: Dunglas\'s minimal GraphQL client'];
//        if (null !== $token) {
//            $headers[] = "Authorization: bearer $token";
//        }

        if (false === $data = @file_get_contents($endpoint, false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                    'content' => json_encode(['query' => $query, 'variables' => $variables]),
                ]
            ]))) {
            $error = error_get_last();

//            dd($query, $variables);



            throw new \ErrorException($error['message'], $error['type']);
        }

        $result = json_decode($data, true);

        if ($debugbar = app('debugbar')) {
            $debugbar->getCollector('graphql')->addQuery($query, $result);
        }

        if (config('app.debug') && isset($result['errors'])) {
            dump($query);
            dd($result['errors']);
        }

        return $result;
    }
}
