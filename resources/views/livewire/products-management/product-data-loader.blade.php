<div class="accordion-body py-4 px-5">

    <div class="flex justify-between">
        <div class="flex justify-between gap-4">
            <div>
                <label for="sub_product_name" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Share Product Name</label>
                <input wire:model.bounce="sub_product_name" type="text" id="shareProductName" class="block w-full p-2 text-gray-900 border
                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                         dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('sub_product_name')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Share Product Name is mandatory and should be more than three characters.</p>
                </div>
                @enderror
            </div>
            <div>
                <label for="prefix" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Prefix</label>
                <input wire:model.bounce="prefix" type="text" id="small-input" class=" w-14 block w-full
                                         p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                         focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                         dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                                         dark:focus:border-blue-500">
                @error('prefix')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Prefix is mandatory and should be more than three characters.</p>
                </div>
                @enderror
            </div>
        </div>
        <div>
            <label class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Product Status</label>
            <label for="sub_product_status" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="sub_product_status" id="sub_product_status" class="sr-only peer" >
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                          after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
            </label>

        </div>
    </div>


    <x-jet-section-border />

    <div class="flex gap-2">
        <div class="w-1/4" >
            <label for="countries" class="block mb-2 text-sm  font-medium text-gray-900 dark:text-gray-400">Currency</label>
            <select wire:model="currency" id="countries" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($this->currencies as $currency)
                    <option value="{{ $currency->currency_id }}" >{{ $currency->currency_name }}</option>
                @endforeach
            </select>





            @if(Session::get('ProductID') =="11")

                <x-jet-section-border />

                <div>
                    <label for="total_shares" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Total Shares</label>
                    <input wire:model.bounce="total_shares" type="number" id="total_shares" class="sm:text-xs block w-full p-2 text-gray-900 border
                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                         dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('total_shares')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 sm:text-xs py-3 text-red-700 mt-1">
                        <p>Total Shares is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>

                <x-jet-section-border />

                <div>
                    <label for="available_shares" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Available Shares</label>
                    <input wire:model.bounce="available_shares" type="number" id="available_shares" class="sm:text-xs block w-full p-2 text-gray-900 border
                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                         dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('available_shares')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 sm:text-xs py-3 text-red-700 mt-1">
                        <p>Total Shares is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>

                <x-jet-section-border />

                <div>
                    <label for="shares_per_member" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Shares Per Client</label>
                    <input wire:model.bounce="shares_per_member" type="number" id="shares_per_member" class="sm:text-xs block w-full p-2 text-gray-900 border
                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                         dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('shares_per_member')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 sm:text-xs py-3 text-red-700 mt-1">
                        <p>Shares Per Client is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>

                <x-jet-section-border />

                <div>
                    <label for="nominal_price" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Nominal Price</label>
                    <input wire:model.bounce="nominal_price" type="number" id="nominal_price" class="sm:text-xs block w-full p-2 text-gray-900 border
                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                         dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('nominal_price')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 sm:text-xs py-3 text-red-700 mt-1">
                        <p>Shares Per Client is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>


            @endif



            <x-jet-section-border />





            <label for="deposit" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="deposit" id="deposit" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                         after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Deposit</span>
            </label>

            @if($this->deposit)
                <label for="deposit_charge" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Charges</label>
                <input wire:model.bounce="deposit_charge" type="number" id="deposit_charge" class="block w-full p-2 text-gray-900 border
                                         border-gray-300 rounded-lg bg-gray-50
                                        sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('deposit_charge')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Charges is mandatory and should be more than three characters.</p>
                </div>
                @enderror
                <div class="flex justify-between gap-2">
                    <div class="w-1/2">
                        <label for="deposit_charge_min_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Min Value</label>
                        <input wire:model.bounce="deposit_charge_min_value" type="number" id="deposit_charge_min_value" class="w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('deposit_charge_min_value')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Min Value is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="deposit_charge_max_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Max Value</label>
                        <input wire:model.bounce="deposit_charge_max_value" type="number" id="deposit_charge_max_value" class="w-20 p-2 text-gray-900 border
                                                 border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('deposit_charge_max_value')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Max Value is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                </div>

            @else
            @endif


            <x-jet-section-border />






            <label for="withdraw" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="withdraw" id="withdraw" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                         after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Withdraw</span>
            </label>

            @if($this->withdraw)
                <label for="withdraw_charge" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Charges</label>
                <input wire:model.bounce="withdraw_charge" type="number" id="withdraw_charge" class="block w-full p-2 text-gray-900 border
                                         border-gray-300 rounded-lg bg-gray-50
                                        sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('withdraw_charge')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Charges is mandatory and should be more than three characters.</p>
                </div>
                @enderror
                <div class="flex justify-between gap-2">
                    <div class="w-1/2">
                        <label for="withdraw_charge_min_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Min Value</label>
                        <input wire:model.bounce="withdraw_charge_min_value" type="number" id="withdraw_charge_min_value" class="w-20 p-2 text-gray-900 border
                                                 border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('withdraw_charge_min_value')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Min Value is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="withdraw_charge_max_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Max Value</label>
                        <input wire:model.bounce="withdraw_charge_max_value" type="number" id="withdraw_charge_max_value" class="w-20 p-2 text-gray-900 border
                                                 border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('withdraw_charge_max_value')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Max Value is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                </div>

            @else
            @endif



        </div>

        <div class="w-1/4 border-l pl-2">



            <label for="interest" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="interest" id="interest" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                         after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Interest</span>
            </label>
            @if($this->interest)
                <div class="flex justify-between gap-2">
                    <div class="w-1/2">
                        <label class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Interest Value</label>
                        <div class="flex">
                                                  <span class="inline-flex items-center px-3 sm:text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md
                                                  dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    %
                                                  </span>
                            <input type="number" wire:model.bounce="interest_value" id="interest_value" class="w-12 p-2 text-gray-900 border border-gray-300
                                                    rounded-r-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <div class="w-1/2">
                        <label for="interest_tenure" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Tenure (Months)</label>
                        <input wire:model.bounce="interest_tenure" type="number" id="interest_tenure" class="w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('interest_tenure')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Tenure (Months) is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                </div>
            @else
            @endif



            <x-jet-section-border />



            <label for="maintenance_fees" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="maintenance_fees" id="maintenance_fees" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                         after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Maintenance fees</span>
            </label>
            @if($this->maintenance_fees)
                <div class="">

                    <label for="maintenance_fees_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Fees per month</label>
                    <input type="number" wire:model.bounce="maintenance_fees_value" id="maintenance_fees_value" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('maintenance_fees_value')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Maintenance fees is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
            @else
            @endif

            <x-jet-section-border />


            <div>
                <label for="profit_account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Collection/Profit Account</label>
                <input type="text" wire:model.bounce="profit_account"  id="profit_account" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('profit_account')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Profit Account is mandatory and should be more than three characters.</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Set inactive after</label>
            <fieldset>


                <div class="flex items-center mb-4">
                    <input checked  wire:model="inactivity" id="inactivity_six_months"
                           type="radio" name="inactivity" value="6" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @if($this->inactivity == '6') checked @endif>
                    <label for="country-option-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        6 month of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_twelve_months"
                           type="radio" name="inactivity" value="12" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @if($this->inactivity == 12) checked @endif>
                    <label for="country-option-2" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        12 months of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_eighteen_months"
                           type="radio" name="inactivity" value="18" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600" @if($this->inactivity == 18) checked @endif>
                    <label for="country-option-3" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        18 months of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_twenty_four_months"
                           type="radio" name="inactivity" value="24" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring:blue-300 dark:focus-ring-blue-600 dark:bg-gray-700 dark:border-gray-600" @if($this->inactivity == 24) checked @endif>
                    <label for="country-option-4" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        24 month of inactivity
                    </label>
                </div>


            </fieldset>

        </div>

        <div class="w-1/4 border-l pl-2">

            <label for="ledger_fees" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="ledger_fees" id="ledger_fees" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                         after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ledger fees</span>
            </label>
            @if($this->ledger_fees)
                <div class="">

                    <label for="maintenance_fees_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Fees per month</label>
                    <input type="text" wire:model.bounce="ledger_fees_value" id="ledger_fees_value" class="block w-full p-2 text-gray-900 border
                                            border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                             dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('ledger_fees_value')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Ledger fees is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
            @else
            @endif

            <x-jet-section-border />



            <fieldset>
                <legend class="sr-only">Checkbox variants</legend>

                <div class="flex items-center mb-4">
                    <input wire:model="create_during_registration" id="create_during_registration" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                    <label for="create_during_registration" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account is created during member registration</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="activated_by_lower_limit" id="activated_by_lower_limit" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="activated_by_lower_limit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account is activated when the lower limit is reached</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="requires_approval" id="requires_approval" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="requires_approval" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Requires approval to be activated</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="generate_atm_card_profile" id="generate_atm_card_profile" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="generate_atm_card_profile" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Generate ATM Card Profile</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="generate_mobile_profile" id="generate_mobile_profile" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="generate_mobile_profile" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Create Mobile Profile</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="allow_statement_generation" id="allow_statement_generation" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="allow_statement_generation" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Allow Statement queries</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="send_notifications" id="send_notifications" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="send_notifications" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Send Notifications</label>
                </div>


                <div class="flex items-center mb-4">
                    <input wire:model="require_image_member" id="require_image_member" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="require_image_member" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Require image - member</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="require_image_id" id="require_image_id" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="require_image_id" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Require image - ID with signature</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="require_mobile_number" id="require_mobile_number"  type="checkbox"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="require_mobile_number" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Require Mobile Number</label>
                </div>



            </fieldset>
        </div>

        <div class="w-1/4 border-l pl-2">

            <label for="number_of_accounts" class="block mb-1 mt-2 sm:text-xs  font-medium text-gray-900 dark:text-gray-400">Number of accounts</label>
            <span id="number_of_accounts" class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                            {{$this->number_of_accounts}}
                                    </span>

            <label for="total_value_of_accounts" class="block mb-1 mt-2 sm:text-xs  font-medium text-gray-900 dark:text-gray-400">Total value of accounts</label>
            <span id="total_value_of_accounts" class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                            {{$this->total_value_of_accounts}}
                                    </span>

            <label for="profits" class="block mb-1 mt-2 sm:text-xs  font-medium text-gray-900 dark:text-gray-400">Profits generated so far</label>
            <span id="profits" class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                            {{$this->profits}}
                                    </span>


        </div>
    </div>

    <x-jet-section-border />

    <div class="mt-2"></div>


    <x-jet-label for="notes" value="{{ __('Notes') }}" />
    <textarea id="notes" name="notes" wire:model.defer="notes" rows="5" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
    @error('notes')
    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
        <p>Notes is mandatory, it should be more than three characters and unique.</p>
    </div>
    @enderror

</div>
