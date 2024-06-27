<div class="py-4 px-5">

        @if (session()->has('message'))

                <div class="w-full bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">The process is completed</p>
                            <p class="text-sm">{{ session('message') }} </p>
                        </div>
                    </div>
                </div>
        @endif

    <div class="flex gap-2">


        <div class="w-1/3" >
            <label for="currency" class="block mb-2 sm:text-xs  font-medium text-gray-900 dark:text-gray-400">Currency</label>
            <input disabled value="{{('TZS')}}" id="currency" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <x-jet-section-border />

            <div>
                <label for="disbursement_account" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300"> Operation Account</label>
                <select wire:model.defer="institution.operation_account" id="disbursement_account" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value=""> select </option>
                    @foreach(DB::table('accounts')->where('major_category_code',1000)->get() as $account)
                        <option value="{{$account->id}}">{{$account->account_name}} </option>
                    @endforeach
                </select>
                    @error('operation_account')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>{{$message}}</p>
                </div>
                @enderror
            </div>




            <x-jet-section-border />


            <div>
                <label for="collection_account_loan_principle" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Main Revenue Account</label>
                <select wire:model="institution.revenue_account" id="collection_account_loan_principle" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(DB::table('accounts')->where('major_category_code',1000)->get() as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>

                @error('revenue_account')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>{{$message}}</p>
                </div>
                @enderror
            </div>


{{--            @if($this->revenue_account)--}}

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="amount" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300" value="{{ __('Set Amount') }}" />
                    <x-jet-input min="1" max="" step="any" id="amount" type="text" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="institution.amount" autocomplete="amount" />
                    @error('amount')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>{{$message}}</p>
                    </div>
                    @enderror
                </div>

{{--            @endif--}}


            <x-jet-section-border />


            <div>
                <label for="collection_account_loan_principle" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300"> Profit Account </label>
                <select wire:model="institution.profit_account" id="collection_account_loan_principle" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(DB::table('accounts')->where('major_category_code',1000)->get() as $account)
                        <option value="{{ $account->id }}" >{{ $account->account_name }}</option>
                    @endforeach
                </select>
                @error('profit_account')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>{{$message}}</p>
                </div>
                @enderror

            </div>

            <x-jet-section-border />

            <x-jet-section-border />

            <label for="small-input" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Register Partners </label>
            <table class="w-full sm:text-xs text-left text-gray-500 dark:text-gray-400">

                <tbody>

                @foreach($this->partners as $partner)

                    <tr class="bg-white  dark:bg-gray-800 dark:border-white">
                        <th scope="row" class="py-1 px-0 sm:text-xs font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $partner->partner_name }}
                        </th>
                        <td class="py-1 px-0 sm:text-xs ">
                                {{ $partner->partner_email }}

                        </td>
                        <td class="py-1 px-0 sm:text-xs ">
                                {{ $partner->account_number }}
                        </td>

                        <td class="py-1 px-0 sm:text-xs ">
                                {{ $partner->mirror_account }}
                        </td>

                        <td class="py-1 px-0 sm:text-xs text-right">
                            <svg wire:click="delete_partner({{ $partner->id }})" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-red-900 text-red-500 cursor-pointer" fill="red" viewBox="0 0 24 24" stroke="red" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </td>
                    </tr>
                @endforeach



                </tbody>
            </table>

           @if(session()->has('message')) <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <span class="font-medium"> {{session()->get('message')}}</span>
            </div>
            @endif

            @if(session()->has('message_fail'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium"> {{session()->get('message_fail')}}</span>
            </div>
            @endif



            <div class="flex mt-2 justify-between">

                <div>
                    <label for="charge_name" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300"> Partner Name </label> @error('partner_name') <a class="text-xs text-red-500">{{$message}} </a> @enderror
                    <input type="text" wire:model.bounce="partner_name" id="charge_name" class="sm:text-xs block w-full p-2 text-gray-900 border
                                            border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                             dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div>
                    <label for="charge_name" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300"> Partner Email</label> @error('partner_email') <a class="text-xs text-red-500">{{$message}} </a> @enderror
                    <input type="text" wire:model.bounce="partner_email" id="charge_name" class="sm:text-xs block w-full p-2 text-gray-900 border
                                            border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                             dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>

            <div class="flex mt-2 justify-between">

                <div>
                    <label for="charge_name" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300"> Partner Mirror Account</label> @error('mirror_account') <a class="text-xs text-red-500">{{$message}} </a> @enderror
                    <input type="text" wire:model="mirror_account" id="charge_name" class="sm:text-xs block w-full p-2 text-gray-900 border
                                            border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                             dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>



            <div class="ml-2 mt-6 justify-end item-end ">

                <button type="button" wire:click="registerPartner" class="sm:text-xs bg-gray-500 text-white inline-flex items-center px-1 py-2 border border-solid rounded-md font-semibold transition"> Register </button>
            </div>




        </div>

        <div class="w-1/3 border-l pl-2">

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Institution Name</label>
                <input wire:model="institution.name" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('name')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Institution name  is mandatory</p>
                </div>
                @enderror
            </div>
            <x-jet-section-border />


            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Email</label>
                <input wire:model="institution.manager_email"   id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('manager_email')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Email  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />
            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Phone Number</label>
                <input wire:model.defer="institution.phone_number" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('phone_number')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Phone number  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />
            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Region</label>
                <input wire:model.defer="institution.region" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                @error('region')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>region  is mandatory</p>
                </div>
                @enderror
            </div>
            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Wilaya</label>
                <input wire:model="institution.wilaya" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('wilaya')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Wilaya  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />


        </div>

        <div class="w-1/3 border-l ">

                <div class="ml-2 p-1">
                    <label for="collection_account_loan_charges"  class="  block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Financial Year Date</label>

                    <div class="relative ">
                               <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                   <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                   </svg>
                               </div>
                               <input datepicker datepicker-autohide wire:model="institution.startDate"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                           </div>
                </div>

                <x-jet-section-border />


                <div class="ml-2 p-1 mb-4">

                    <label class="  block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Upload Budget Approval Letter</label>
                    <form wire:submit.prevent="store" class="flex">

                        <input wire:model="budget_approval_letter" type="file"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs
                               rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                               w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                               dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

                        <button type="submit" class="ml-1 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs p-1.5
                               rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700
                               dark:border-gray-600 dark:placeholder-gray-400
                               dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                         <div wire:loading.remove wire:target="budget_approval_letter" >
                            <div wire:loading wire:target="store" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 class="spin w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                            </div>
                            <div wire:loading.remove wire:target="store" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                            </svg>
                            </div>
                         </div>
                         <div wire:loading wire:target="budget_approval_letter">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                  class="spin w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                             </svg>
                         </div>

                        </button>
                    </form>


                    @error('budget_approval_letter') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div wire:click="openCloseOne" class="mt-2 cursor-pointer bg-gray-50 p-1.5 border border-gray-300 text-gray-900 sm:text-xs rounded-lg justify-between flex">
                        <div>Show Budget Approval Letters</div>
                        <div class="flex">
                            @if($this->openOne)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                            @else

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            @endif

                        </div>
                    </div>
                    @if($this->openOne)
                    <div>

                        @foreach(\Illuminate\Support\Facades\DB::table('institution_files')->where('file_id','1')->get() as $files)
                        <div class="flex justify-between m-2">
                            <div class="flex gap-2">
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>

                                    <a href="{{asset('storage/'.$files->file_path)}}" target="_blank" class="text-red-500 hover:text-red-700 text-xs">{{$files->file_name}}</a>
                                </div>
                            </div>
                            <div class="flex gap-2">

                                <svg wire:click="deleteFile({{$files->id}})"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                            </div>
                        </div>
                        @endforeach

                    </div>
                    @endif

                </div>


                <x-jet-section-border />
                   <div class="ml-2 p-1">
                       <div class="mb-4">
                           <label for="collection_account_loan_charges"  class="  block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Summary of the General Meeting signed by the Chairman of the Association</label>
                           <input type="file" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                       </div>

                   </div>



                <x-jet-section-border />
                   <div class="ml-2 p-1">
                       <div class="mb-4">

                           <label for="collection_account_loan_charges"  class="  block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Chairperson's Report</label>
                           <input type="file" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                       </div>

                   </div>



                <x-jet-section-border />
                <div class="ml-2 p-1">
                    <div class="mb-4">

                        <label for="collection_account_loan_charges"  class="  block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">External Auditor's Financial Report</label>
                        <input type="file" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                </div>



                <x-jet-section-border />
                   <div class="ml-2 p-1">
                       <div class="mb-4">

                           <label for="collection_account_loan_charges"  class="  block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Supplementary vital documents for revenue and expense analysis.</label>
                           <input type="file" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                       </div>

                   </div>


        </div>

    </div>

    <x-jet-section-border />

    <div class="mt-2"></div>

    <div class="flex justify-end">
        <div >
            <div wire:loading.remove wire:target="institutionSetting">
                <button wire:click='institutionSetting' class="bg-red-500 text-white inline-flex items-center px-4 py-1 border border-solid rounded-md font-semibold transition" >
                    Submit
                </button>
            </div>
            <div wire:loading wire:target="institutionSetting">
                <button type="button" class="bg-red-500 text-white inline-flex items-center px-4 py-1 border border-solid rounded-md font-semibold transition" disabled>

                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-white" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>

                    Processing...
                </button>
            </div>


        </div>
    </div>
    <script>
        flatpickr('[datepicker]', {
            dateFormat: "Y-m-d"
            , autoHide: true
            , allowInput: true
            , minDate: "2000-01-01"
            , maxDate: new Date().fp_incr(14)
        });
    </script>
</div>
