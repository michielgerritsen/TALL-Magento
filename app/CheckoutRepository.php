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

use App\DTO\Address;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CheckoutRepository
{
    const CART_CONTENTS = '
        email
        billing_address {
            firstname
            lastname
            street
            city
            region{
                code
                label
            }
            postcode
            telephone
            country {
                code
                label
            }
        }
        shipping_addresses {
            firstname
            lastname
            street
            city
            postcode
            telephone
            country {
                code
                label
            }
            available_shipping_methods {
                error_message
                method_code
                method_title
                carrier_code
                amount {
                    currency
                    value
                }
                price_incl_tax {
                    currency
                    value
                }
                price_excl_tax {
                    currency
                    value
                }
                available
                base_amount {
                    currency
                    value
                }
            }
        }
    ';

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var \Illuminate\Cache\TaggedCache
     */
    private $cache;

    public function __construct(
        CartRepository $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->cache = Cache::tags(['cart', 'cart.' . Session::get('cart-id')]);
    }

    /**
     * @return Address[]
     * @throws \ErrorException
     */
    public function getShippingAddresses(): array
    {
        $result = $this->retrieveShippingAddress();

        $output = [];
        foreach ($result as $address) {
            $output[] = Address::fromArray($address);
        }

        return $output;
    }

    public function setShippingAddress(Address $address, string $email)
    {
        $query = <<<'QUERY'
mutation(
    $cartId: String!
    $firstname: String!
    $lastname: String!
    $street: [String!]!
    $city: String!
    $postcode: String!
    $country: String!
    $telephone: String!
) {
    setBillingAddressOnCart(
        input: {
            cart_id: $cartId
            billing_address: {
                address: {
                    firstname: $firstname
                    lastname: $lastname
                    street: $street
                    city: $city
                    postcode: $postcode
                    country_code: $country
                    telephone: $telephone
                    save_in_address_book: false
                }
                use_for_shipping: true
            }
        }
    ) {
        cart {
            CART_CONTENTS
        }
    }
}
QUERY;

        GraphQL::query($query, [
            'cartId' => Session::get('cart-id'),
            'firstname' => $address->getFirstname(),
            'lastname' => $address->getLastname(),
            'email' => $email,
            'street' => $address->getStreet(),
            'city' => $address->getCity(),
            'postcode' => $address->getPostcode(),
            'country' => $address->getCountry(),
            'telephone' => $address->getTelephone(),
        ]);

        $this->cache->forget('shipping-address');
    }

    private function query(string $query, array $variables, string $contentNode)
    {
        $response = GraphQL::query(
            str_replace('CART_CONTENTS', static::CART_CONTENTS, $query),
            $variables
        );

        return Arr::get($response, $contentNode);
    }

    /**
     * @return array|\ArrayAccess|mixed
     */
    private function retrieveShippingAddress()
    {
        return $this->cache->remember('shipping-address', 3600, function () {
            $query = <<<'GRAPHQL'
    query($cartId: String!) {
        cart(cart_id: $cartId) {
            CART_CONTENTS
        }
    }
GRAPHQL;

            return $this->query($query, ['cartId' => Session::get('cart-id')], 'data.cart.shipping_addresses');
        });
    }
}
