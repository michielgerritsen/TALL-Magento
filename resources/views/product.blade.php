<?php /** @var \App\DTO\Product $product **/ ?>
@extends('layouts.frontend')

@section('title', $product->getName())

@section('content')

    <div class="mt-8">
        <h1 class="text-4xl">{{$product->getName()}}</h1>
        <span class="text-gray-600">SKU: {{$product->getSku()}}</span>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <img src="{{$product->getProductImages()->getImage()->getUrl()}}" alt="{{$product->getProductImages()->getImage()->getLabel()}}" />
            </div>
            <div>
                <x-product-price :prices="$product->getPrices()" />

                <hr class="mt-4 mb-8">

                @include('product-options')

                <hr class="mt-4 mb-8">

                {!! $product->getDescription() !!}
            </div>
        </div>
    </div>

@endsection
