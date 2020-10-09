<?php $isSelected = $isOptionSelected($aggregate->getCode(), $option->getValue()); ?>
<div class="group w-full flex items-center pr-2 py-2 text-sm leading-5 font-light text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150 @if(!$isSelected) cursor-pointer @endif">
    <span wire:click.self="select('{{$aggregate->getCode()}}', '{{$option->getValue()}}')">
        {!! $option->getLabel() !!}

        @if(!$isSelected)
            <span class="text-gray-500">
                ({{ $option->getCount() }})
            </span>
        @endif
    </span>

    @if($isSelected)
        <span wire:click="remove('{{$aggregate->getCode()}}')" class="text-red-300 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </span>
    @endif
</div>
