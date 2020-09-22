<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class Checkout
{
    public function __invoke()
    {
        if (!Session::has('cart-id')) {
            return redirect('/');
        }

        return response()->view('checkout');
    }
}
