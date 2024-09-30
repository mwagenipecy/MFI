<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="flex flex-col w-full">
 <button wire:click="calculatePenalties">t5t</button>

        <div class="w-full  metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800  rounded-lg p-4 max-w-72 ">
            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                Generate Transaction Statement
            </p>
            <div class="flex justify-between items-center w-full">

                <div class="flex gap-4">
                    <div>
                        <label for="available_shares" class="block mb-2 sm:text-xs font-medium text-gray-900
                                        dark:text-gray-300">Account Number/Client Number</label>
                        <input wire:model.bounce="check_account_number" type="check_account_number" id="check_account_number" class="sm:text-xs block w-full p-2 text-gray-900 border
                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                         dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="available_shares" class="block mb-2 sm:text-xs font-medium text-gray-900
                                                    dark:text-gray-300">Date Range</label>
                        <div class="relative flex items-center">


                            <input type="text" name="daterange" value="{{$start_date_input }} - {{$end_date_input}}"
                                   class="cursor-pointer sm:text-xs block w-full p-2 text-gray-900 border
                                                        border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500
                                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                                         dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">

                        </div>
                    </div>


                </div>

                @if(session()->has('error1'))
                    <div class="alert alert-danger">
                        <ul>
                           {{session()->get('error1')}}
                        </ul>
                    </div>
                @endif



                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button wire:click="downloadExcelFile" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                        <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"></path>
                            <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"></path>
                        </svg>
                        Download Excel
                    </button>

                    <button   wire:click="downloadPDFFile"  type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                        <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"></path>
                            <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"></path>
                        </svg>
                        Downloads PDF
                    </button>
                </div>


            </div>

        </div>


        <div class="w-full flex justify-center space-x-1">

{{--            <div class="w-1/3 metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72">--}}
{{--                <div>--}}
{{--                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">--}}
{{--                        Loan Repayment--}}
{{--                    </p>--}}
{{--                    <div>--}}
{{--                        @if (session()->has('message1'))--}}
{{--                            --}}{{--                                @if (session()->has('alert-class'))--}}
{{--                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"--}}
{{--                                 role="alert">--}}
{{--                                <div class="flex">--}}
{{--                                    <div class="py-1">--}}
{{--                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4"--}}
{{--                                             xmlns="http://www.w3.org/2000/svg"--}}
{{--                                             viewBox="0 0 20 20">--}}
{{--                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <p class="font-bold">The process is--}}
{{--                                            completed</p>--}}
{{--                                        <p class="text-sm">{{ session('message1') }} </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            --}}{{--                                @endif--}}
{{--                        @endif--}}

{{--                        @if (session()->has('message_fail'))--}}
{{--                            --}}{{--                                                            @if (session()->has('alert-class'))--}}
{{--                            <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"--}}
{{--                                 role="alert">--}}
{{--                                <div class="flex">--}}
{{--                                    <div class="py-1">--}}
{{--                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4"--}}
{{--                                             xmlns="http://www.w3.org/2000/svg"--}}
{{--                                             viewBox="0 0 20 20">--}}
{{--                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <p class="font-bold">The process has failed--}}
{{--                                        </p>--}}
{{--                                        <p class="text-sm">{{ session('message_fail') }} </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <hr class="boder-b-0 my-4"/>--}}
{{--                    <div class="">--}}

{{--                        <p for="payment_type"--}}
{{--                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">--}}
{{--                            Payment Type</p>--}}
{{--                        <select wire:model.bounce="payment_type" name="payment_type" id="payment_type"--}}
{{--                                class="--}}
{{--                                bg-gray-50 border border-gray-300  text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500--}}
{{--                                w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm--}}
{{--">--}}
{{--                            <option selected value="">Select</option>--}}
{{--                            <option value="BANK">BANK</option>--}}
{{--                            <option value="CASH">CASH</option>--}}
{{--                            <option value="MOBILE">MOBILE</option>--}}
{{--                        </select>--}}
{{--                        @error('payment_type')--}}
{{--                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">--}}
{{--                            <p>payment type is mandatory.</p>--}}
{{--                        </div>--}}
{{--                        @enderror--}}
{{--                        <div class="mt-2"></div>--}}
{{--                        @if($this->payment_type=="BANK" || $this->payment_type=="MOBILE")--}}
{{--                            <p for="bank"  class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">--}}
{{--                                Select Bank</p>--}}
{{--                            <select wire:model.bounce="bank" name="bank" id="bank"--}}
{{--                                    class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">--}}
{{--                                <option selected value="">Select</option>--}}
{{--                                @foreach(DB::table('accounts')->where('category_code',1000)->get() as $bank)--}}
{{--                                    <option value="{{$bank->id}}">{{$bank->account_name.'('.$bank->account_number.')'}}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}

{{--                            </select>--}}
{{--                            @error('bank')--}}
{{--                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">--}}
{{--                                <p>Bank is mandatory.</p>--}}
{{--                            </div>--}}
{{--                            @enderror--}}
{{--                            <div class="mt-2"></div>--}}


{{--                            <p for="reference_number"--}}
{{--                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">--}}
{{--                                Enter Reference Number</p>--}}
{{--                            <x-jet-input id="reference_number" type="text"--}}
{{--                                         name="reference_number" class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"--}}
{{--                                         wire:model.bounce="reference_number" autofocus/>--}}

{{--                            @error('reference_number')--}}
{{--                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">--}}
{{--                                <p>Reference Number is mandatory and should be more than two--}}
{{--                                    characters.</p>--}}
{{--                            </div>--}}
{{--                            @enderror--}}
{{--                            <div class="mt-2"></div>--}}
{{--                        @endif--}}

{{--                        --}}{{--                            @if($this->payment_type=="CASH")--}}
{{--                        <p for="reference_number"--}}
{{--                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">--}}
{{--                            Enter Member Number</p>--}}
{{--                        <x-jet-input id="phone_number" type="text"--}}
{{--                                     name="memberNumber1" class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"--}}
{{--                                     wire:model.bounce="memberNumber1" autofocus/>--}}

{{--                        @error('memberNumber1')--}}
{{--                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">--}}
{{--                            <p>Member Number is mandatory.</p>--}}
{{--                        </div>--}}
{{--                        @enderror--}}
{{--                        <div class="mt-2"></div>--}}
{{--                        @if($this->memberNumber1)--}}

{{--                            <table class="w-full">--}}
{{--                                @foreach(App\Models\AccountsModel::where('member_number',DB::table('members')->where('member_number',$this->memberNumber1)->value('member_number'))->get() as $account)--}}
{{--                                    <tr>--}}
{{--                                        <td class="text-left">--}}
{{--                                            <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">--}}
{{--                                            </p>--}}
{{--                                        </td>--}}
{{--                                        <td class="pl-4 text-right"><p--}}
{{--                                                    class="block text-sm font-medium text-red-500 dark:text-gray-400">{{$account->account_number}}</p>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div wire:loading--}}
{{--                                                 wire:target="setAccount({{$account->account_number}})">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                     class="animate-spin  h-9 w-9 stroke-gray-400 rounded-full p-2"--}}
{{--                                                     fill="white" viewBox="0 0 24 24"--}}
{{--                                                     stroke="currentColor" stroke-width="2">--}}
{{--                                                    <path stroke-linecap="round"--}}
{{--                                                          stroke-linejoin="round"--}}
{{--                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>--}}
{{--                                                </svg>--}}
{{--                                            </div>--}}
{{--                                            @if($this->accountSelected == $account->account_number)--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                     class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2"--}}
{{--                                                     fill="none" viewBox="0 0 24 24"--}}
{{--                                                     stroke="currentColor" stroke-width="2">--}}
{{--                                                    <path stroke-linecap="round"--}}
{{--                                                          stroke-linejoin="round"--}}
{{--                                                          d="M5 13l4 4L19 7"/>--}}
{{--                                                </svg>--}}
{{--                                            @else--}}
{{--                                                <div wire:loading.remove--}}
{{--                                                     wire:target="setAccount({{$account->account_number}})">--}}
{{--                                                    <svg wire:click="setAccount({{$account->account_number}})"--}}
{{--                                                         xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                         class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"--}}
{{--                                                         fill="none" viewBox="0 0 24 24"--}}
{{--                                                         stroke="currentColor"--}}
{{--                                                         stroke-width="2">--}}
{{--                                                        <path stroke-linecap="round"--}}
{{--                                                              stroke-linejoin="round"--}}
{{--                                                              d="M12 4v16m8-8H4"/>--}}
{{--                                                    </svg>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}

{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            </table>--}}
{{--                        @endif--}}
{{--                        <div class="mt-2"></div>--}}
{{--                        @if($this->accountSelected)--}}
{{--                            <p for="amount"--}}
{{--                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">--}}
{{--                                Enter Amount</p>--}}
{{--                            <x-jet-input id="amount" type="text" name="amount"--}}
{{--                                         class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"--}}
{{--                                         wire:model.debounce.500ms="amount" autofocus/>--}}
{{--                            @error('amount')--}}
{{--                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">--}}
{{--                                <p>Amount is mandatory and should be more than two--}}
{{--                                    characters.</p>--}}
{{--                            </div>--}}
{{--                            @enderror--}}
{{--                            <div class="mt-2"></div>--}}
{{--                        @endif--}}
{{--                        <div class="mt-2"></div>--}}
{{--                    </div>--}}
{{--                    <hr class="border-b-0 my-6"/>--}}

{{--                    <div class="flex justify-end w-auto">--}}
{{--                        <div wire:loading wire:target="process">--}}
{{--                            <x-jet-button   disabled>--}}
{{--                                <div class="flex items-center">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"--}}
{{--                                         fill="white" viewBox="0 0 24 24"--}}
{{--                                         stroke="currentColor" stroke-width="2">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>--}}
{{--                                    </svg>--}}
{{--                                    <p>Please wait...</p>--}}
{{--                                </div>--}}
{{--                            </x-jet-button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="flex justify-end w-auto">--}}
{{--                        <div wire:loading.remove wire:target="process">--}}
{{--                            <x-jet-button wire:click="process"--}}
{{--                                          class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">--}}
{{--                                <p class="text-white">Deposit</p>--}}
{{--                            </x-jet-button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
            <div class="w-1/3 metric-card dark:bg-gray-900 border bg-white border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72">
                <div>
                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                        Loan Repayment / Deposit
                    </p>
                    <div>
                        @if (session()->has('message1'))
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">The process is completed</p>
                                        <p class="text-sm">{{ session('message1') }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session()->has('message_fail'))
                            <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">The process has failed</p>
                                        <p class="text-sm">{{ session('message_fail') }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <hr class="border-b-0 my-4"/>

                    <div>
                        <p for="payment_type" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Payment Type
                        </p>
                        <select wire:model.bounce="payment_type" name="payment_type" id="payment_type" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                            <option selected value="">Select</option>
                            <option value="BANK">BANK</option>
                            <option value="CASH">REPAYMENT - CASH </option>
                            <option value="MOBILE">MOBILE</option>
                            <option value="SAVINGS">SAVINGS DEPOSIT</option>
                            <option value="REPAYMENT-SAVINGS">REPAYMENT - SAVINGS</option>
                        </select>
                        @error('payment_type')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Payment type is mandatory.</p>
                        </div>
                        @enderror

                        @if($this->payment_type == "BANK" || $this->payment_type == "MOBILE")
                            <p for="bank" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Select Bank
                            </p>
                            <select wire:model.bounce="bank" name="bank" id="bank" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                                <option selected value="">Select</option>
                                @foreach(DB::table('accounts')->where('category_code', 1000)->get() as $bank)
                                    <option value="{{$bank->id}}">{{$bank->account_name . ' (' . $bank->account_number . ')'}}</option>
                                @endforeach
                            </select>
                            @error('bank')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Bank is mandatory.</p>
                            </div>
                            @enderror

                            <p for="reference_number" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Enter Reference Number
                            </p>
                            <x-jet-input id="reference_number" type="text" name="reference_number" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm" wire:model.bounce="reference_number" autofocus/>
                            @error('reference_number')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Reference Number is mandatory and should be more than two characters.</p>
                            </div>
                            @enderror
                        @endif

                        <p for="reference_number" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Enter Member Number
                        </p>
                        <x-jet-input id="memberNumber1" type="text" name="memberNumber1" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm" wire:model.bounce="memberNumber1" autofocus/>
                        @error('memberNumber1')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Member Number is mandatory.</p>
                        </div>
                        @enderror

                        @if($this->memberNumber1)
                            @if($this->payment_type == 'CASH' or $this->payment_type == 'REPAYMENT-SAVINGS')
                                <table class="w-full">
                                    @foreach(App\Models\LoansModel::where('member_number', DB::table('members')->where('member_number', $this->memberNumber1)->value('member_number'))->get() as $loan)
                                        <tr>
                                            <td class="text-left">
                                                <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">
                                                    {{$loan->status}}
                                                </p>
                                            </td>
                                            <td class="pl-4 text-right">
                                                <p class="block text-sm font-medium text-red-500 dark:text-gray-400">{{number_format($loan->principle)}}</p>
                                            </td>
                                            <td class="text-right">
                                                <div wire:loading wire:target="setAccount({{$loan->loan_account_number}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-9 w-9 stroke-gray-400 rounded-full p-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    </svg>
                                                </div>
                                                @if($this->accountSelected == $loan->loan_id)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @else
                                                    <div wire:loading.remove wire:target="setAccount({{$loan->loan_id}})">
                                                        <svg wire:click="setAccount({{$loan->loan_id}})" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                            @if($this->payment_type == 'SAVINGS')
                                    <table class="w-full">
                                        @foreach(DB::table('members')->where('member_number', $this->memberNumber1)->get() as $member)
                                            <tr>
                                                <td class="text-left">
                                                    <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">
                                                        {{DB::table('accounts')->where('id', $member->member_savings_account)->value('account_number') }}
                                                    </p>
                                                </td>
                                                <td class="pl-4 text-right">
                                                    <p class="block text-sm font-medium text-red-500 dark:text-gray-400">
                                                        {{
                                                            number_format(DB::table('accounts')->where('id', $member->member_savings_account)->value('balance'))
                                                        }}</p>
                                                </td>
                                                <td class="text-right">
                                                    <div wire:loading wire:target="setAccount({{$member->member_savings_account}})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-9 w-9 stroke-gray-400 rounded-full p-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                        </svg>
                                                    </div>
                                                    @if($this->accountSelected == $member->member_savings_account)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    @else
                                                        <div wire:loading.remove wire:target="setAccount({{$member->member_savings_account}})">
                                                            <svg wire:click="setAccount({{$member->member_savings_account}})" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                            @endif

                        @endif

                        @if($this->accountSelected)
                            <p for="amount" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Enter Amount
                            </p>
                            <x-jet-input id="amount" type="number" name="amount" class="w-full border-gray-300 focus:border-red-500
                            focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md
                            shadow-sm text-sm" wire:model="amount" autofocus/>
                            @error('amount')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Amount is mandatory and should be more than two characters.</p>
                            </div>
                            @enderror
                        @endif
                    </div>

                    <hr class="border-b-0 my-6"/>

                    <div class="flex justify-end w-auto">
                        <div wire:loading wire:target="process">
                            <x-jet-button disabled>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <p>Please wait...</p>
                                </div>
                            </x-jet-button>
                        </div>
                    </div>

                    <div class="flex justify-end w-auto">
                        <div wire:loading.remove wire:target="process">
                            <x-jet-button wire:click="process" class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">Deposit</p>
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </div>

            {{--            @endif--}}
{{--                @if (in_array( "Show Loan Application" , session()->get('permission_items')))--}}
            <div class="w-1/3 metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72">
                <div>
                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                        Loan Application
                    </p>
                    <div>
                        @if (session()->has('message_2'))
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">The process is completed</p>
                                        <p class="text-sm">{{ session('message_2') }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <hr class="border-b-0 my-4"/>

                    <div class="">

                        <p for="member_id" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Select Member</p>
                        <select id="member_id" name="member_id" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm" wire:model="selectedMemberId">
                            <option value="">Select Member</option>
                            @foreach(DB::table('members')->get() as $member)
                                <option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</option>
                            @endforeach
                        </select>
                        @error('selectedMemberId')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        @if($selectedMemberId)
                            @php
                                $member = DB::table('members')->find($selectedMemberId);
                            @endphp
                            <div class="mt-1 mx-2">
                                <div class="fw-bold ">
                                    <div class="max-w-md bg-green-100 mx-auto bg-white p-4 rounded-lg shadow">
                                        <div class="fw-bold">Selected Member Details</div>
                                        <tr class="text-black">
                                            <th>Full Name: </th>
                                            <th>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</th>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <p for="amount2" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Loan Product </p>
                        <select wire:model.debounce.500ms="loan_product" name="loan_product" id="loan_product" class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                            <option selected value="">Select</option>
                            @foreach(DB::table('loan_sub_products')->get() as $loan_product)
                                <option value="{{$loan_product->sub_product_id}}">{{$loan_product->sub_product_name}}</option>
                            @endforeach
                        </select>
                        @error('loan_product')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Loan Product field is required</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        @if($this->loan_product)
                            <p for="amount2" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Amount </p>
                            <x-jet-input id="amount2" type="text" name="amount2" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm" wire:model.debounce.500ms="amount2" autofocus placeholder="{{'max '.number_format(DB::table('loan_sub_products')->where('sub_product_id',$this->loan_product)->value('principle_max_value')).'TZS min-value '.number_format(DB::table('loan_sub_products')->where('sub_product_id',$this->loan_product)->value('principle_min_value')).'TZS'}}"/>
                            @error('amount2')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Amount is mandatory</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>
                        @endif

                        <p for="pay_method" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Payment Method. </p>
                        <select wire:model.bounce="pay_method" name="pay_method" id="pay_type" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                            <option selected value="">Select</option>
                            <option value="CASH">CASH</option>
                            <option value="MOBILE">MOBILE</option>
                            <option value="BANK">BANK</option>
                        </select>
                        @error('pay_method')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Payment method is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        @if($this->pay_method==="BANK")
                            <p for="bank5" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Select Bank</p>
                            <select wire:model.bounce="bank5" name="bank5" id="bank5" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                                <option selected value="">Select</option>
                                @foreach(DB::table('accounts')->where('category_code',1000)->get() as $bank)
                                    <option value="{{$bank->id}}">{{$bank->account_name.'('.$bank->account_number.')'}}</option>
                                @endforeach
                            </select>
                            @error('bank5')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Bank is mandatory.</p>
                            </div>
                            @enderror


                            <div class="mt-2"></div>
                        @endif

                        @if($this->pay_method==="MOBILE")
                            <p class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Mobile Number</p>
                            <x-jet-input id="mob_number" type="number" name="mob_number" class="w-full border-gray-300 focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm" wire:model.bounce="mob_number" autofocus />
                            @error('mob_number')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Mobile number is mandatory</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>
                        @endif
                        <p for="member1"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            Assign Loan Officer</p>
                        <select wire:model.bounce="loan_officer" name="member1" id="member1"
                                class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                            <option selected value="">Select</option>
                            @foreach(App\Models\Employee::where('employee_status',"ACTIVE")->where('department',5)->get() as $members)
                                <option value="{{$members->id}}">{{$members->first_name}} {{$members->middle_name}} {{$members->last_name}}</option>
                            @endforeach

                        </select>
                        @error('loan_officer')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Loan Officer is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <div class="mt-2"></div>


                        @if($this->accountSelected1)

                            <p for="amount1"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Enter Amount'</p>
                            <x-jet-input id="amount1" type="number" name="amount1"
                                         class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.defer="amount1" autofocus/>
                            @error('amount1')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Amount is mandatory and should be more than two
                                    characters.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>
                        @endif


                                                    <div wire:loading.remove wire:target="process1">
                                                        <x-jet-button wire:click="process1"
                                                                      class="inline-flex justify-center w-full bg-red-500 border border-transparent rounded-md py-2 px-4 my-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200">
                                                            <p class="text-white">Apply Loan</p>
                                                        </x-jet-button>

                                                    </div>
                    </div>
                </div>
            </div>


{{--                @if (in_array( "Show Loan Withdrawal" , session()->get('permission_items')))--}}
            {{--                 withdraw money--}}
            <div class="w-1/3 metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72">

                @if($this->enableCheque)



                    <div class="container mx-auto px-1 py-6">

                        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-1 py-4">
                                <div class="font-bold text-l mb-4 justify-center item-center flex">Cheque Details</div>
                                <table class="w-full border-collapse">

                                    @foreach($this->cheque_values as $value)
                                        <tr>
                                            <td class="py-2 px-4 border-b">Cheque Number:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{$value->cheque_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">Customer Account:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{$value->customer_account}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">Amount:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{number_format($value->amount,2)}} TZS </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">Branch:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{DB::table('branches')->where('id',$value->branch)->value('name')}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">Issued By:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{DB::table('employees')->where('id',$value->finance_approver)->value('first_name')}} </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">Issued date:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{$value->created_at}}</td>
                                        </tr>

                                        <tr>
                                            <td class="py-2 px-4 border-b">Status:</td>
                                            <td class="py-2 px-4 border-b font-semibold"> {{$value->status}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">Bank Account:</td>
                                            <td class="py-2 px-4 border-b font-semibold">{{$value->bank_account}}</td>
                                        </tr>
                                        <!-- Add more rows for other cheque details -->
                                    @endforeach
                                </table>


                                <button wire:click="$toggle('enableCheque')" type="button" class="text-white justify-end item-end flex mt-4 bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"> Close </button>


                            </div>
                        </div>

                    </div>


                @else

                <div>
                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                        Loan Withdraw
                    </p>
                    <div>
                        @if (session()->has('message_3'))

                            {{--                                @if (session()->has('alert-class'))--}}
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                                 role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">The process is
                                            completed</p>
                                        <p class="text-sm">{{ session('message_3') }} </p>
                                    </div>
                                </div>
                            </div>
                            {{--                                @endif--}}
                        @endif

                            @if (session()->has('message_fail3'))

                                {{--                                @if (session()->has('alert-class'))--}}
                                <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                                     role="alert">
                                    <div class="flex">
                                        <div class="py-1">
                                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold">The process is
                                                completed</p>
                                            <p class="text-sm">{{ session('message_fail3') }} </p>
                                        </div>
                                    </div>
                                </div>
                                {{--                                @endif--}}
                            @endif

                    </div>

                    <hr class="boder-b-0 my-4"/>

                    <div class="">
                        @error('amount3')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>amount cannot be null</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <p for="phone_number3"
                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Member Number</p>
                        <x-jet-input id="memberNumber" type="number" name="memberNumber"
                                     class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                     wire:model.bounce="memberNumber" autofocus/>
                        @error('memberNumber')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Member number is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>




                        @if( $this->memberNumber)
                            @foreach(\App\Models\AccountsModel::whereIn('member_number',DB::table('members')->where('member_number',$this->memberNumber)->pluck('member_number'))->get() as $account1 )


                            <tr class="flex ">
                                <td class="text-left">
                                    <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">
                                        Amount: {{number_format($account1->balance,2)}}
                                    </p>
                                </td>

                                <td class="pl-4 text-right   ">

                                    <div class="flex w-full mx-auto justify-between gap-2">
                                    <p
                                            class="block text-sm font-medium text-red-500 dark:text-gray-400">{{$account1->account_number}}</p>

                                    <div wire:loading
                                         wire:target="setAccount({{$account1->account_number}})">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="animate-spin  h-9 w-9 stroke-gray-400 rounded-full p-2"
                                             fill="white" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>

                                        @if($this->accountSelected == $account1->account_number)

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2"
                                             fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @else
                                        <div wire:loading.remove
                                             wire:target="setAccount({{$account1->account_number}})">
                                            <svg wire:click="setAccount({{$account1->account_number}})"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                                                 fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </div>
                                    @endif
                                    </div>

                                </td>

                                <td class="text-right">

                                </td>
                            </tr>

                            @endforeach
                                @endif
                        <div class="mt-2"></div>





                        <p for="payment_method"
                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                            Payment Method</p>
                        <select wire:model.bounce="payment_method" name="payment_method" id="payment_method"
                                class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                            <option selected value="">Select</option>
                            <option value="CASH">CASH</option>
{{--                            <option value="BANK">BANK</option>--}}
{{--                            <option value="MOBILE">MOBILE</option>--}}
                            <option value="CHEQUE">CHEQUE</option>
                        </select>
                        @error('payment_method')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>payment method is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                        @if($this->payment_method=="CHEQUE")
                            <p for="bank3"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Select Bank</p>
                            <select wire:model.bounce="bank3" name="bank3" id="bank3"
                                    class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                                <option selected value="">Select</option>
                                @foreach(DB::table('accounts')->where('category_code',1000)->get() as $bank)
                                    <option value="{{$bank->account_number}}">{{$bank->account_name.'('.$bank->account_number.')'}}
                                    </option>
                                @endforeach

                            </select>
                            @error('bank3')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Bank is mandatory.</p>
                            </div>
                            @enderror



                            <div class="mt-2"></div>


                        @endif

                        @if($this->payment_method=="MOBILE")
                            <p for="phone_number4"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Phone Number</p>
                            <x-jet-input id="phone_number4" type="text" name="amount"
                                         class="w-full border-gray-300  focus:border-red-500 focus:ring rounded-lg focus:ring-red-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="phone_number4" autofocus/>
                            @error('phone_number4')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Phone number is mandatory</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                        @endif
                        <div class="mt-2"></div>
                    </div>
                    <hr class="border-b-0 my-6"/>
                    <div class="flex justify-end w-auto">
                        <div wire:loading wire:target="process3">
                            <x-jet-button
                                    disabled>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                         fill="white" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <p>Please wait...</p>
                                </div>
                            </x-jet-button>
                        </div>
                    </div>


                    <div class="flex justify-end w-auto">
                        <div wire:loading.remove wire:target="process3">
                            <x-jet-button wire:click="process3"
                                    class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">Loan Withdraw </p>
                            </x-jet-button>

                        </div>
                    </div>

                </div>

                @endif

            </div>
{{--                @endif--}}
            {{--                end withdraw money--}}


        </div>

        <div class="w-full justify-center flex space-x-1">
{{--            @if (in_array( "Show Loan Repayment" , session()->get('permission_items')))--}}
            <div class="w-1/3 metric-card  dark:bg-gray-900 border @if($this->item == 7) bg-green-200 border-green-200 dark:border-green-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72">

                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center">
                        <div wire:loading wire:target="visit(7)">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="animate-spin  h-5 w-5 mr-2 stroke-gray-400"
                                     fill="white" viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                </svg>


                                <p>Please wait...</p>
                            </div>

                        </div>
                        <div wire:loading.remove wire:target="visit(7)">


                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                Total Repayment
                            </p>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5">

                        <svg wire:click="visit(7)" xmlns="http://www.w3.org/2000/svg"
                             class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>


                    </div>
                </div>

                <table class="w-full">
                    <tr>
                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  text-left">
                            <p>At {{date("Y-m-d H:i:s")}}</p>
                        </td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-xl text-slate-400 dark:text-white text-right">
                            <p>
                                {{ DB::table('general_ledger')
                                        ->where('record_on_account_number', function ($query) {
                                            $query->select('account_number')
                                                ->from('accounts')
                                                ->where('id', function ($subquery) {
                                                    $subquery->select('account_id')
                                                        ->from('tellers')
                                                        ->where('employee_id', auth()->user()->employeeId);
                                                });
                                        })
                                        ->where('created_at', '>=', now()->startOfDay())
                                        ->sum('debit')
                                      }}TZS
                            </p>
                        </td>
                    </tr>

                </table>
            </div>
{{--            @endif--}}
{{--            @if (in_array( "Show Loan Application" , session()->get('permission_items')))--}}
            <div class="w-1/3  metric-card  dark:bg-gray-900 border @if($this->item == 4) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 ">

                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center">
                        <div wire:loading wire:target="visit(4)">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="animate-spin  h-5 w-5 mr-2 stroke-gray-400"
                                     fill="white" viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                </svg>


                                <p>Please wait...</p>
                            </div>

                        </div>
                        <div wire:loading.remove wire:target="visit(4)">


                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                Total Applicants

                            </p>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5">

                        <svg wire:click="visit(4)" xmlns="http://www.w3.org/2000/svg"
                             class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>


                    </div>
                </div>


                <table class="w-full">

                    <tr>
                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  text-left">
                            <p>At {{date("Y-m-d H:i:s")}}</p>
                        </td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-xl text-slate-400 dark:text-white text-right">
                            <p>

                                {{
                                        DB::table('general_ledger')
                                                    ->where('record_on_account_number', function ($query) {
                                                        $query->select('account_number')
                                                            ->from('accounts')
                                                            ->where('id', function ($subquery) {
                                                                $subquery->select('account_id')
                                                                    ->from('tellers')
                                                                    ->where('employee_id', auth()->user()->employeeId);
                                                            });
                                                    })
                                                    ->where('created_at', '>=', now()->startOfDay())
                                                    ->sum('debit')
                                      }}TZS
                            </p>
                        </td>
                    </tr>

                </table>
            </div>
{{--            @endif--}}
{{--            @if (in_array( "Show Loan Withdrawal" , session()->get('permission_items')))--}}
            <div class="w-1/3  metric-card  dark:bg-gray-900 border @if($this->item == 5) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 ">

                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center">
                        <div wire:loading wire:target="visit(4)">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="animate-spin  h-5 w-5 mr-2 stroke-gray-400"
                                     fill="white" viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p>Please wait...</p>
                            </div>
                        </div>
                        <div wire:loading.remove wire:target="visit(4)">
                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600"> Total Withdraw </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-5">
                        <svg wire:click="visit(4)" xmlns="http://www.w3.org/2000/svg"
                             class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <table class="w-full">

                    <tr>
                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  text-left">
                            <p>At {{date("Y-m-d H:i:s")}}</p>
                        </td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-xl text-slate-400 dark:text-white text-right">
                            <p>

                                {{
                                        DB::table('general_ledger')
                                                    ->where('record_on_account_number', function ($query) {
                                                        $query->select('account_number')
                                                            ->from('accounts')
                                                            ->where('id', function ($subquery) {
                                                                $subquery->select('account_id')
                                                                    ->from('tellers')
                                                                    ->where('employee_id', auth()->user()->employeeId);
                                                            });
                                                    })
                                                    ->where('created_at', '>=', now()->startOfDay())
                                                    ->sum('debit')
                                      }}TZS
                            </p>
                        </td>
                    </tr>

                </table>
            </div>
{{--            @endif--}}
        </div>
    </div>


    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'top'
            }, function(start, end, label) {
                Livewire.emit('dateRange', {
                    start_date: start,
                    end_date: end
                });
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
        window.addEventListener('contentChanged', event => {
            const scriptTag = document.createElement('script');
            scriptTag.src = "{{ asset('assets/js/tw-elements.umd.min.js') }}";
            document.head.appendChild(scriptTag);


            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {

                    Livewire.emit('dateRange', {
                        start_date: start,
                        end_date: end
                    });

                    console.log("A new date selection was made xx: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            });
        });

    </script>

</div>
