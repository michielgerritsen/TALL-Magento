<div class="relative">
    <div class="absolute w-full h-full bg-gray-700 z-50 bg-opacity-75 sm:rounded-lg flex hidden" wire:loading.class.remove="hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-8 w-8 m-auto"></div>
    </div>
    <div class="mt-6 bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <ul>
            @foreach($methods as $method)
                <li>
                    <label>
                        <input wire:change="setPaymentMethod('{{$method['code']}}')" name="payment_method" type="radio" value="{{$method['code']}}" />
                        {{$method['title']}}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>
