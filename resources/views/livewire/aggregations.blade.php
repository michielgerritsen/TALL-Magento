<?php /** @var \App\DTO\Aggregate[] $aggregations */ ?>
<div class="col-span-1">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32 m-auto"></div>
    </div>

    @foreach ($aggregations as $aggregate)
        <div class="mt-4 pl-2 border-b-2 @if($loop->first) border-t-2 @endif @if($loop->last) mb-8 @endif" x-data="{ isOpen: {{ $isGroupSelected($aggregate->getCode()) ? 'true': 'false' }} }">
            <div class="mt-1 group w-full pr-2 py-2 text-sm leading-5 font-semibold rounded-md bg-white text-gray-600 transition ease-in-out duration-150 cursor-pointer" x-on:click="isOpen = !isOpen">
                <span>
                    {{ $aggregate->getLabel() }}
                </span>

                <div class="float-right">
                    <svg :class="{ 'text-gray-400 rotate-90': isOpen, 'text-gray-300': !isOpen }" class="mr-2 h-5 w-5 transform group-hover:text-gray-400 group-focus:text-gray-400 transition-colors ease-in-out duration-150" viewBox="0 0 20 20">
                        <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <div class="mt-1 space-y-1 pb-4" x-show="isOpen">
                @foreach ($aggregate->getOptions() as $option)
                    @include('livewire.aggegations.option')
                @endforeach
            </div>
        </div>
    @endforeach
</div>
