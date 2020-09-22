@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-1">
            @livewire('shipping-address')
        </div>

        <div class="mt-5 md:mt-0 md:col-span-1">
            @livewire('shipping-methods')

            @livewire('payment-methods')
        </div>

        <div class="mt-5 md:mt-0 md:col-span-1">
            @livewire('place-order')
        </div>
    </div>

@endsection
