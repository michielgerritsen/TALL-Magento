@extends('layouts.frontend')

@section('title', $category['name'])

@section('content')

    <h1 class="text-4xl">{{$category['name']}}</h1>

{{--    @livewire('aggregations')--}}

    @include('product-list')

@endsection
