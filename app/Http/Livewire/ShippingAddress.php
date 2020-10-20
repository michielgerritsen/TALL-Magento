<?php

namespace App\Http\Livewire;

use App\CartRepository;
use App\CheckoutRepository;
use App\DTO\Address;
use Livewire\Component;

class ShippingAddress extends Component
{
    /**
     * @var string
     */
    public $firstname = '';

    /**
     * @var string
     */
    public $lastname = '';

    /**
     * @var string
     */
    public $email = '';

    /**
     * @var string
     */
    public $country = '';

    /**
     * @var string
     */
    public $street = [];

    /**
     * @var string
     */
    public $city = '';

    /**
     * @var string
     */
    public $postcode = '';

    /**
     * @var string
     */
    public $telephone = '';

    public function mount(CheckoutRepository $checkoutRepository, CartRepository $cartRepository)
    {
        $addresses = $checkoutRepository->getShippingAddresses();
        $address = array_shift($addresses);
        if (!$address) {
            return;
        }

        $street = $address->getStreet();
        if ($street) {
            $street = $street[0];
        }

        $this->firstname = $address->getFirstname();
        $this->lastname = $address->getLastname();
        $this->street = $street;
        $this->postcode = $address->getPostcode();
        $this->city = $address->getCity();
        $this->country = $address->getCountry();
        $this->telephone = $address->getTelephone();

        $cart = $cartRepository->get();
        if (!$cart) {
            return;
        }

        $this->email = $cart->getEmail();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'street' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'telephone' => 'required',
        ]);
    }

    public function render(CheckoutRepository $checkoutRepository, CartRepository $cartRepository)
    {
        if ($this->email && $this->country) {
            $address = new Address(
                $this->firstname,
                $this->lastname,
                [$this->street],
                $this->postcode,
                $this->city,
                $this->country,
                $this->telephone,
                []
            );

            $cartRepository->addEmailAddressToCart($this->email);
            $checkoutRepository->setShippingAddress($address, $this->email);

            $this->emit('shipping-methods:load');
            $this->emit('update-order-totals');
        }

        return view('livewire.shipping-address');
    }
}
