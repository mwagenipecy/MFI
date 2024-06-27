<div class="accordion-body py-4 px-5">

    <div class="flex justify-between">
        <div class="flex justify-between gap-4">
            <div>
                <label for="sub_product_name" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Loan Product Name</label>
                <input wire:model.bounce="sub_product_name" type="text" id="sub_product_name" class="block w-full p-2 text-gray-900 border
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
            <label for="currency" class="block mb-2 sm:text-xs  font-medium text-gray-900 dark:text-gray-400">Is this requires partner(s) ? </label>

            <input type="checkbox" value="YES"  wire:model="has_partner" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs    focus:ring-blue-500 focus:border-blue-500 block   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <x-jet-section-border />

            <div>
                <label for="disbursement_account" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Disbursement Account</label>
                <select wire:model="disbursement_account" id="disbursement_account" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($this->accounts as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-jet-section-border />


            <div>
                <label for="collection_account_loan_interest" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Interest Collection Account</label>
                <select wire:model="collection_account_loan_interest" id="collection_account_loan_interest" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($this->accounts as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-jet-section-border />


            <div>
                <label for="collection_account_loan_principle" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Principle Collection Account</label>
                <select wire:model="collection_account_loan_principle" id="collection_account_loan_principle" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($this->accounts as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Charges Collection Account</label>
                <select wire:model="collection_account_loan_charges" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($this->accounts as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_penalties" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Penalties Collection Account</label>
                <select wire:model="collection_account_loan_penalties" id="collection_account_loan_penalties" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($this->accounts as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-jet-section-border />



                <label for="deposit_charge" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Principal Settings</label>

                <div class="flex justify-between gap-2">
                    <div class="w-1/2">
                        <label for="principle_min_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Min Value</label>
                        <input wire:model.bounce="principle_min_value" type="number" min="0" id="principle_min_value" class="w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('principle_min_value')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Min Value is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="principle_max_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Max Value</label>
                        <input wire:model.bounce="principle_max_value" type="number" min="0" id="principle_max_value" class="w-20 p-2 text-gray-900 border
                                                 border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('principle_max_value')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Max Value is mandatory and should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>
                </div>


            <x-jet-section-border />






            <label for="deposit_charge" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Loan Term Settings</label>

            <div class="flex justify-between gap-2">
                <div class="w-1/2">
                    <label for="min_term" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Min Term</label>
                    <input wire:model.bounce="min_term" type="number" id="min_term" min="0" class="w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('min_term')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Min Value is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="max_term" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Max Term</label>
                    <input wire:model.bounce="max_term" type="number" id="max_term" min="0" class="w-20 p-2 text-gray-900 border
                                                 border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('max_term')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Max Value is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
            </div>




        </div>

        <div class="w-1/4 border-l pl-2">

            <label for="deposit_charge" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Interest Rate</label>

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
                    <input wire:model.bounce="interest_tenure" type="number" id="interest_tenure" min="0" class="w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('interest_tenure')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Tenure (Months) is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
            </div>

            <x-jet-section-border />



            <label for="deposit_charge" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Grace Period Settings</label>

            <div class="flex justify-between gap-2">
                <div class="w-1/2">
                    <label for="principle_grace_period" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Principal ( Months )</label>
                    <input wire:model.bounce="principle_grace_period" type="number" id="principle_grace_period" class="w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('principle_grace_period')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Min Value is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="interest_grace_period" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Interest ( Months )</label>
                    <input wire:model.bounce="interest_grace_period" type="number" id="interest_grace_period" class="w-20 p-2 text-gray-900 border
                                                 border-gray-300 rounded-lg bg-gray-50 sm:text-xs
                                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('interest_grace_period')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Max Value is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
            </div>


            <x-jet-section-border />



            <label for="small-input" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Interest Method</label>
            <fieldset>


                <div class="flex items-center mb-4">
                    <input wire:model="interest_method" id="flat"
                           type="radio" name="interest_method" value="flat" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Flat
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="interest_method" id="declining"
                           type="radio" name="interest_method" value="declining" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Reducing  Balance
                    </label>
                </div>

            </fieldset>


            <x-jet-section-border />


            <label for="amortization_method" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Amortization Method</label>
            <fieldset>


                <div class="flex items-center mb-4">
                    <input wire:model="amortization_method" id="equal"
                           type="radio" name="amortization_method" value="equal" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Equal Installment
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="amortization_method" id="declining"
                           type="radio" name="amortization_method" value="declining" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Reducing  Balance
                    </label>
                </div>

            </fieldset>


            <x-jet-section-border />

            <div class="flex gap-1">
                <div >
                    <label for="days_in_a_year" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Days in a year</label>

                    <select wire:model="days_in_a_year" id="days_in_a_year" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="365" selected>Actual</option>
                        <option value="360" >360</option>
                        <option value="364" >364</option>
                        <option value="365" >365</option>
                    </select>
                </div>
                <div>
                    <label for="days_in_a_month" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Days in a month</label>

                    <select wire:model="days_in_a_month" id="days_in_a_month" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="30" selected>Actual</option>
                        <option value="30" >30</option>
                    </select>

                </div>
            </div>



            <x-jet-section-border />

            <div >
                <label for="repayment_strategy" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Repayment Strategy</label>

                <select wire:model="repayment_strategy" id="repayment_strategy" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="PCIP" selected>Penalties>Charges>Interest>Principal</option>
                    <option value="PICP" >Principal>Interest>Charges>Penalties</option>
                    <option value="IPCP" >Interest>Principal>Charges>Penalties</option>
                </select>
            </div>


            <x-jet-section-border />

            <label for="maintenance_fees" class="relative inline-flex sm:text-xs items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:model="maintenance_fees" id="maintenance_fees" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                         after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Maintenance fees</span>
            </label>
            @if($this->maintenance_fees)
                <div class="">

                    <label for="maintenance_fees_value" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Fees per month</label>
                    <input type="text" wire:model.bounce="maintenance_fees_value" id="maintenance_fees_value" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('maintenance_fees_value')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Maintenance fees is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                </div>
            @else
            @endif



            <x-jet-section-border />



            <label for="repayment_frequency" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Repayment Frequency</label>

            <select wire:model="repayment_frequency" id="countries" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Daily" selected>Daily</option>
                <option value="Weekly" >Weekly</option>
                <option value="Monthly" >Monthly</option>
                <option value="Annual" >Annual</option>
            </select>


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


            <label for="lock_guarantee_funds" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Lock Guarantee Funds</label>
            <fieldset>


                <div class="flex items-center mb-4">
                    <input wire:model="lock_guarantee_funds" id="one"
                           type="radio" name="lock_guarantee_funds" value="1" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Yes
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="lock_guarantee_funds" id="zero"
                           type="radio" name="inactivity" value="0" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        No
                    </label>
                </div>

            </fieldset>


            <x-jet-section-border />

            <label for="small-input" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Add charges</label>
                <table class="w-full sm:text-xs text-left text-gray-500 dark:text-gray-400">

                    <tbody>

                    @foreach($this->charges as $charge)

                        <tr class="bg-white  dark:bg-gray-800 dark:border-white">
                            <th scope="row" class="py-1 px-0 sm:text-xs font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $charge->charge_name }}
                            </th>
                            <td class="py-1 px-0 sm:text-xs ">
                                @if($charge->charge_type == 'fixed')
                                    {{ $charge->flat_charge_amount }}
                                @else
                                    {{ $charge->percentage_charge_amount }} %
                                @endif

                            </td>
                            <td class="py-1 px-0 sm:text-xs text-right">
                                <svg wire:click="deleteCharge({{ $charge->id }})" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-red-900 text-red-500 cursor-pointer" fill="red" viewBox="0 0 24 24" stroke="red" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </td>
                        </tr>
                    @endforeach



                    </tbody>
                </table>

            <fieldset class="flex justify-between mb-2 mt-2">


                <div class="flex items-center ">
                    <input wire:model="charge_type" id="fixed"
                           type="radio" name="charge_type" value="fixed" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Fixed
                    </label>
                </div>

                <div class="flex items-center ">
                    <input wire:model="charge_type" id="percentage"
                           type="radio" name="charge_type" value="percentage" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        Percentage
                    </label>
                </div>

            </fieldset>

            <div class="flex mt-2">
                <div>
                    <label for="charge_name" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Name</label>
                    <input type="text" wire:model.bounce="charge_name" id="charge_name" class="sm:text-xs block w-full p-2 text-gray-900 border
                                            border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                             dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>


                @if($this->charge_type == 'fixed')
                    <div>
                        <label for="charge_amount" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Amount</label>
                        <input type="number" wire:model.bounce="charge_amount" id="charge_amount" class="sm:text-xs ml-1 block w-full p-2 text-gray-900 border
                                            border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                             dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>


                @elseif($this->charge_type == 'percentage')
                    <div>
                        <label for="charge_percent" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Percent</label>
                        <div class="flex ml-1">
                                                  <span class="inline-flex items-center px-3 sm:text-xs text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md
                                                  dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    %
                                                  </span>
                            <input type="number" wire:model.bounce="charge_percent" id="charge_percent" class="w-12 p-2 text-gray-900 border border-gray-300
                                                    rounded-r-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                @endif

                <div class="ml-2 mt-6 ">

                    <button type="button" wire:click="saveCharge" class="sm:text-xs bg-gray-500 text-white inline-flex items-center px-1 py-2 border border-solid rounded-md font-semibold transition">Add</button>
                </div>

            </div>


            <x-jet-section-border />


            <fieldset>


                <div class="flex items-center mb-4">
                    <input wire:model="create_during_registration" id="create_during_registration" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                    <label for="create_during_registration" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Account is created upon successful loan request</label>
                </div>


                <div class="flex items-center mb-4">
                    <input wire:model="requires_approval" id="requires_approval" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="requires_approval" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Requires approval to be activated</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="allow_statement_generation" id="allow_statement_generation" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="allow_statement_generation" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Allow Statement queries</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="send_notifications" id="send_notifications" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="send_notifications" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Send Notifications</label>
                </div>


                <div class="flex items-center mb-4">
                    <input wire:model="require_image_member" id="require_image_member" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="require_image_member" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Require image - member</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="require_image_id" id="require_image_id" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="require_image_id" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Require image - ID with signature</label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="require_mobile_number" id="require_mobile_number"  type="checkbox"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="require_mobile_number" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Require Mobile Number</label>
                </div>



            </fieldset>

            <x-jet-section-border />


            <label for="small-input" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Set inactive after</label>
            <fieldset>


                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_six_months"
                           type="radio" name="inactivity" value="6" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        6 month of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_twelve_months"
                           type="radio" name="inactivity" value="12" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        12 months of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_eighteen_months"
                           type="radio" name="inactivity" value="18" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-3" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        18 months of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_twenty_four_months"
                           type="radio" name="inactivity" value="24" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring:blue-300 dark:focus-ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-4" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        24 month of inactivity
                    </label>
                </div>


            </fieldset>


        </div>

        <div class="w-1/4 border-l pl-2">




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

    <div class="mt-2"></div>

    <div class="flex justify-end">
        <div >
            <div wire:loading.remove wire:target="saveNewSubProduct">
                <button wire:click='saveNewSubProduct' class="bg-red-500 text-white inline-flex items-center px-4 py-1 border border-solid rounded-md font-semibold transition" >
                    Save Product
                </button>
            </div>

            <div wire:loading wire:target="saveNewSubProduct">
                <button type="button" class="bg-red-500 text-white inline-flex items-center px-4 py-1 border border-solid rounded-md font-semibold transition" disabled>

                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-white" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>

                    Processing...
                </button>
            </div>


        </div>
    </div>

</div>