<div>
    <div class="mt-2"></div>





    @if($this->approve_boolean)
        <div class="fixed z-10 inset-0 overflow-y-auto"  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Your form elements go here -->

                    <div>
                        @if (session()->has('message'))

                            @if (session('alert-class') == 'alert-success')
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif


                        <div class="bg-white p-4">

                            <div class="mb-4 flex justify-center item-center ">
                                <h5 >
                            Approve And Confirm
                                </h5>
                            </div>

                            <p class="font-semibold"> Are you sure you want to {{ $this->title }} ?  </p>



                        </div>
                    </div>


                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="$toggle('approve_boolean')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="actionBtns({{ $this->set_id }})" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif



    @if($this->return_boolean)
        <div class="fixed z-10 inset-0 overflow-y-auto"  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Your form elements go here -->

                    <div>
                        @if (session()->has('message'))

                            @if (session('alert-class') == 'alert-success')
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif


                        <div class="bg-white p-4">

                            <div class="mb-4 flex justify-center item-center ">
                                <h5 >
                            Approve And Confirm
                                </h5>
                            </div>

                            <p class="font-semibold"> Are you sure you want to {{ $this->title }} ?  </p>

                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Add Comment  </label>
                            <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="comment" placeholder="Write your comments ."></textarea>



                        </div>
                    </div>


                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-50 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="$toggle('return_boolean')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="returnBack" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif



    <div class="w-full flex gap-4">

        <div class="w-1/2  mx-4">
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

            <p for="collateral_type" class="block mt-6 text-sm font-bold @if($this->recommended) text-red-400 dark:text-red-400  @else text-red-400 dark:text-red-400 @endif "> Comments    </p>
            <div class="w-full @if($this->recommended) bg-red-200  @else bg-blue-200 @endif   rounded rounded-lg shadow-sm   p-1 " >
                <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                    <table class="w-full">

                        @foreach (DB::table('loan_comments')->where('loan_id',session('currentloanID'))->get() as $comment )

                        <tr class="  border-red-500 ">

                            <td class=" relative text-xs text-gray-600  dark:text-white @if($comment->user_id==auth()->user()->id)  text-right @else text-left @endif  ">
                                <p>

                                     {{ $comment->comment }}

                                    </p>
                                <div class="flex @if($comment->user_id==auth()->user()->id)  justify-end item-end @else   item-start justify-start   @endif   ">
                                <p class=" text-slate-400 font-bold">  {{ DB::table('users')->where('id', $comment->user_id)->value('name') }} </p>
                                </div>

                                <div class="w-full  h-4 flex  @if($comment->user_id==auth()->user()->id)  item-end justify-end   @else item-start justify-start   @endif      ">

                                    <svg wire:click="replyComment({{ $comment->id  }})" data-slot="icon" fill="none" class="" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3"></path>
                                      </svg>

                                </div>


                            </td>

                            <td>

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



                        <button wire:click="setActionId(3)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
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

                            <button wire:click="setActionId(4)" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">Approve</p>
                            </button>

                            <button wire:click="setActionId(5)" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                <p class="text-white">Reject</p>
                            </button>

                            <button wire:click="returnModal()" class="text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                <p class="text-white"> Return </p>
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




        <div class="w-1/2 mx-4">

            <p for="collateral_type" class="block  text-sm font-bold    text-red-400 dark:text-red-400  "> Charges   </p>
            <div class="w-full @if($this->recommended) bg-red-200  @else bg-blue-200 @endif   rounded rounded-lg shadow-sm   p-1 " >
                <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                    <table class="w-full">

                        @foreach (DB::table('charges')->where('product_id',$this->loan_sub_product)->get() as $charge )


                        <tr class="mb-2 ">
                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                            <p>
                                 <input  id="default-checkbox-{{ $charge->id  }}" @disabled(Session::get('disableInputs'))  wire:click="storeCharge({{ $charge->id }})" @if(DB::table('loan_has_charges')->where('loan_id',session('currentloanID'))->where('charge_id',$charge->id)->exists() )  @checked(true) @endif  type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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

                        <tr class="border-t border-1  mt-2 ">
                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p>
                                    Total Charges
                                </p>
                                </td>
                                <td>

                                </td>

                                <td class="text-xs text-slate-400 flex item-end justify-end  dark:text-white capitalize  text-left">
                                    <p>
                                       {{ number_format(  DB::table('loan_has_charges')->where('loan_id',session('currentloanID'))->sum('amount'),2)  }} TZS
                                    </p>
                                    </td>


                        </tr>
                    </table>
                </div>
            </div>



            <p for="collateral_type" class="block  text-sm font-bold    mt-4 dark:text-red-400  "> Loan Summary   </p>
            <div class="w-full  bg-blue-200   rounded rounded-lg shadow-sm   p-1 " >
                <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                    <table class="w-full">



                        <tr>


                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p> Loan Amount </p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                             {{ number_format($this->principle,2) }} TZS
                            </td>
                        </tr>


                        <tr>


                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p>  Charges </p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                             {{ number_format(DB::table('loan_has_charges')->where('loan_id',session('currentloanID'))->sum('amount'),2) }} TZS
                            </td>
                        </tr>



                        <tr>


                            <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                <p> Take Home </p>
                            </td>
                            <td class="text-xs text-slate-400 dark:text-white text-right">
                             {{ number_format( ($this->principle - DB::table('loan_has_charges')->where('loan_id',session('currentloanID'))->sum('amount')),2) }} TZS
                            </td>
                        </tr>




                    </table>
                </div>
            </div>




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
