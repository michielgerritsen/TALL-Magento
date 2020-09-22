<div class="mt-6 bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
    <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Shipping + Billing address</h3>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="#" method="POST">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="firstname" class="block text-sm font-medium leading-5 text-gray-700">First name</label>
                    <input required id="firstname" wire:model="firstname" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('firstname') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="lastname" class="block text-sm font-medium leading-5 text-gray-700">Last name</label>
                    <input required id="lastname" wire:model="lastname" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('lastname') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                    <input required id="email" wire:model="email" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="country" class="block text-sm font-medium leading-5 text-gray-700">Country</label>
                    <select id="country" wire:model="country" name="country" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="">Please select</option>
                        <option value="NL">Netherlands</option>
                    </select>
                    @error('country') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6">
                    <label for="street" class="block text-sm font-medium leading-5 text-gray-700">Street address</label>
                    <input required id="street" wire:model="street" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('street') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                    <label for="city" class="block text-sm font-medium leading-5 text-gray-700">City</label>
                    <input required id="city" wire:model="city" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('city') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                    <label for="postcode" class="block text-sm font-medium leading-5 text-gray-700">ZIP / Postal</label>
                    <input required id="postcode" wire:model="postcode" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('postcode') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-6">
                    <label for="telephone" class="block text-sm font-medium leading-5 text-gray-700">Telephone</label>
                    <input required id="telephone" wire:model="telephone" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('telephone') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </form>
    </div>
</div>
