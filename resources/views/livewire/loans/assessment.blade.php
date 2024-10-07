<div>
    <div class="mt-2"></div>


    <div class="w-full flex gap-4">

        <div class="w-1/3">
            <!-- Principle Amount Input -->
            <label for="principle_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Principle Amount</label>
            <input type="number" id="principle_amount" name="principle_amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
            rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="principle" @disabled(Session::get('disableInputs')) value="1" required>
            @error('principle_amount')
            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                <p>Business Description is mandatory and should be more than two characters.</p>
            </div>
            @enderror

            <div class="mt-2"></div>

            <hr class="boder-b-0 my-6"/>


            <div class="flex w-full space-x-4">
                <!-- Interest Input -->
                <div class="w-1/2">
                    <label for="tenure" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"> Interest Type </label>
                    <select type="number" id="tenure" name="tenure" value="12" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="interest_type" @disabled(Session::get('disableInputs')) value="1" >

                     <option value="percent">
        Percent

                     </option>

                     <option value="fixed">
                        Fixed

                                     </option>

                    </select>
                    @error('tenure')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Tenure is mandatory and should be more than two characters.</p>
                    </div>
                    @enderror
                </div>


                @if($interest_type=="fixed")



                <div class="w-1/2">
                    <label for="interest" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">  Amount </label>

                    <input type="number" id="interest" name="interest" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="interest_amount" @disabled(Session::get('disableInputs')) value="1" required>
                    @error('interest')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Interest is mandatory.</p>
                    </div>
                    @enderror
                </div>

                @else

                <div class="w-1/2">
                    <label for="interest" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Interest </label>

                    <input type="number" id="interest" name="interest" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="interest" @disabled(Session::get('disableInputs')) value="1" required>

                    @error('interest')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Interest is mandatory.</p>
                    </div>
                    @enderror
                </div>
                @endif

                <!-- Tenure Input -->
                <div class="w-1/2">
                    <label for="tenure" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Tenure</label>
                    <input type="number" id="tenure" name="tenure" value="12" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="tenure" @disabled(Session::get('disableInputs')) value="1" required>
                    @error('tenure')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Tenure is mandatory and should be more than two characters.</p>
                    </div>
                    @enderror
                </div>


                   <!-- Tenure Input -->



            </div>

            <div class="mt-2"></div>


            <hr class="boder-b-0 my-6"/>
            <p for="collateral_type" class="block mt-6 text-sm font-bold @if($this->recommended) text-red-400 dark:text-red-400  @else text-red-400 dark:text-red-400 @endif "> Charges   </p>
            <div class="w-full @if($this->recommended) bg-red-200  @else bg-blue-200 @endif   rounded rounded-lg shadow-sm   p-1 " >
                <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                    <table class="w-full">

                        @foreach (DB::table('charges')->where('product_id',$this->loan_sub_product)->get() as $charge )


                        <tr>
                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                            <p>
                                 <input checked id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </p>
                            </td>

                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p>  {{ $charge->charge_name }} </p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                @if($charge->percentage_charge_amount==null)
                                <p> {{number_format($charge->flat_charge_amount,2)}} TZS</p>
                                @else

                                <p> {{number_format($charge->percentage_charge_amount * $this->principle /100 ,2)}} TZS</p>

                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>



            <hr class="boder-b-0 my-6"/>

            <p for="collateral_type" class="block mt-6 text-sm font-bold @if($this->recommended) text-red-400 dark:text-red-400  @else text-red-400 dark:text-red-400 @endif ">@if($this->recommended) Recommendations @else Conclusion @endif </p>
            <div class="w-full @if($this->recommended) bg-red-200  @else bg-blue-200 @endif   rounded rounded-lg shadow-sm   p-1 " >
                <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                    <table class="w-full">

                        <tr>
                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p>Loan to be given</p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                <p> {{number_format($this->principle,2)}} TZS</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs text-slate-400 dark:text-w hite capitalize  text-left">
                                <p>Interest ( Per day )</p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
{{--                                <p> {{$this->interest_value }} %</p>--}}
                                <p> {{$this->interest }} %</p>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p>Tenure ( Days )</p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                <p>{{$this->tenure}} </p>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p>Installment</p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                <p>As per schedule</p>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>


            <div class="mt-2"></div>





            <div class="flex justify-end w-auto" >
                <div wire:loading wire:target="actionBtns" >
                    <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400" disabled>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                            </svg>
                            <p>Please wait...</p>
                        </div>
                    </button>
                </div>

            </div>

            @if(Session::get('loanStatus') == 'ONPROGRESS')

                <div class="flex justify-end w-auto" >
                    <div wire:loading.remove wire:target="actionBtns" >

                        @if($this->recommended)
                            <button wire:click="actionBtns(1)" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                <p class="text-white">Override</p>
                            </button>
                        @else
                            <button wire:click="actionBtns(2)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">Use Recommendations</p>
                            </button>
                        @endif



                        <button wire:click="actionBtns(3)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                            <p class="text-white">Commit</p>
                        </button>

                    </div>
                </div>

            @endif

            @if(Session::get('loanStatus') == 'ACTIVE')
                <div class="flex justify-end w-auto" >
                    <div wire:loading.remove wire:target="actionBtns" >

                        <button wire:click="actionBtns(33)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                            <p class="text-white">Top Up</p>
                        </button>

                        <button wire:click="actionBtns(44)" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                            <p class="text-white">Restructure</p>
                        </button>

                        <button wire:click="actionBtns(55)" class="text-white bg-green-400 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-400 dark:hover:bg-green-400 dark:focus:ring-green-400">
                            <p class="text-white">Close Loan</p>
                        </button>

                    </div>
                </div>
            @endif

            @if(Session::get('loanStatus') == 'AWAITING APPROVAL')
                <div class="flex justify-end w-auto" >
                    <div wire:loading.remove wire:target="actionBtns" >

                        @if (in_array( "Approve loans" , session()->get('permission_items')))

                            <button wire:click="actionBtns(7)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">View Schedule</p>
                            </button>

                            <button wire:click="actionBtns(4)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">Approve</p>
                            </button>

                            <button wire:click="actionBtns(5)" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                <p class="text-white">Reject</p>
                            </button>
                        @endif


                    </div>
                </div>
            @endif


            @if(Session::get('loanStatus') == 'APPROVED')

                <div class="mt-2"></div>

                <p for="bank1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Select Bank</p>
                <select wire:model.bounce="bank1" name="bank1" id="bank1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Select</option>
                    @foreach(App\Models\AccountsModel::where('sub_product_number', '91')->get() as $bank)
                        <option value="{{$bank->account_number}}">{{$bank->account_name}} - {{$bank->account_number}}</option>
                    @endforeach
                </select>
                @error('member')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Branch is mandatory.</p>
                </div>
                @enderror
                <div class="mt-3"></div>



                <div class="flex justify-end w-auto" >
                    <div wire:loading.remove wire:target="actionBtns" >

                        <button wire:click="actionBtns(6)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                            <p class="text-white">Close Loan</p>
                        </button>
                        <button wire:click="actionBtns( )" class="text-white bg-red-700   hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                            <p class="text-white">Top Up</p>
                        </button>
                        <button wire:click="actionBtns( )" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                            <p class="text-white">Restructure</p>
                        </button>


                    </div>
                </div>
            @endif


        </div>




        <div class="w-1/2">


                <p for="stability3" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-400">PROPOSITION</p>
                <div id="stability3" class="w-full bg-gray-50 rounded rounded-lg shadow-sm   p-1 " >
                    <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >

                        <table class="w-full">
                            <thead>
                            <tr>
                                <th>INSTALLMENT</th>
                                <th>INTEREST</th>
                                <th>PRINCIPLE</th>
                                <th>BALANCE</th>

                            </tr>
                            </thead>
                            <tbody>



                            @foreach($this->table as $tr)
                                <tr>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p>{{number_format($tr['Payment'],2)}}</p>
                                    </td>

                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p>{{number_format($tr['Interest'],2)}}</p>
                                    </td>

                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p>{{number_format($tr['Principle'],2)}}</p>
                                    </td>

                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p>{{number_format($tr['balance'],2)}}</p>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                            <tfoot>
                            @foreach($this->tablefooter as $tr)
                                <tr>
                                    <td class="text-sm font-bold text-black dark:text-white text-right">
                                        <p class="text-sm font-bold text-black">{{number_format($tr['Payment'],2)}}</p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p class="text-sm font-bold text-black">{{number_format($tr['Interest'],2)}}</p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p class="text-sm font-bold text-black">{{number_format($tr['Principle'],2)}}</p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p class="text-sm font-bold text-black">{{number_format($tr['balance'],2)}}</p>
                                    </td>
                                </tr>
                            @endforeach
                            </tfoot>

                        </table>


                    </div>
                </div>

        </div>


    </div>






</div>
