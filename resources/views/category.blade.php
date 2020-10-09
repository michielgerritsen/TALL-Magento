<?php /** @var \App\DTO\Category $category */ ?>
@extends('layouts.frontend')

@section('title', $category->getName())

@section('content')

    <h1 class="text-4xl">{{$category->getName()}}</h1>

    <div class="grid grid-cols-5 gap-4">
        @livewire('aggregations', ['categoryUrlKey' => $category->getUrlKey()])

        @livewire('product-list', ['categoryUrlKey' => $category->getUrlKey()])
    </div>

@endsection
