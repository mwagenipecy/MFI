




{{--// cleate listerners--}}

{{--@if($this->viewMemberDetail)--}}

@if($this->viewMemberDetail)

    <div x-data="{ isOpen: false }">
        <!-- Button to open the modal -->
        <button @click="isOpen = true">Member Details</button>

        <!-- The modal -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal content -->
                @foreach($this->member as $currentMember)
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            @if($currentMember->status == "AWAITING DISBURSEMENT")
                             <div>
                                <!-- Loan Number -->
                                <div>
                                    <label class="block font-medium text-gray-700">Loan Number</label>
                                    <input type="text" value="{{$currentMember->loan_id}}"  class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Loan Number" disabled>
                                </div>

                                <!-- Client Number -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Client Number</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"  value="{{$currentMember->loan_account_number}}"  placeholder="Client Number" disabled>
                                </div>

                                <!-- Client Name -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Client Name</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{\App\Models\ClientsModel::where('id',$currentMember->client_id)->value('first_name')}}" placeholder="Client Name">
                                </div>

                                <!-- Approved Amount -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Approved Amount</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Approved Amount">
                                </div>

                                <!-- Selection Box -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Selection Box</label>
                                    <select class="form-select rounded-md shadow-sm mt-1 block w-full">
                                        <option>Select an option</option>
                                        <!-- Add your options here -->
                                    </select>
                                </div>

                                <!-- Client Amount -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Client Amount</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Client Amount">
                                </div>
                            </div>

                        <!-- Modal footer -->
                           <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button @click="isOpen = false" type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Close
                            </button>
                            <button type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>

                           </div>
                            @endif

                           </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@else


    <div class="w-full container-fluid">

        @if($this->showPartnerList)

            <div class="fixed z-10 inset-0 overflow-y-auto"  >
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <!-- Your form elements go here -->
                        <div class="p-4">
                            <div>
                                @if (session()->has('message'))
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
                            </div>


                            <div class="bg-white p-4">

                                <div class="mb-4">
                                    <h5 >
                                        Select Partner
                                    </h5>
                                </div>




                                    <div >
                                        <!-- Name -->
                                        <div class="col-span-6 sm:col-span-4">
                                            <x-jet-label for="account_name" value="{{ __('Partner Account ') }}" /> @error('partner_account') <a class="text-red-500 text-xs"> {{$message}} </a> @enderror
                                            <select wire:model="partner_account" id="disbursement_account" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                @foreach($this->partner_accounts as $account)
                                                    <option value="{{ $account->id }}" >{{ $account->account_name .'('. $account->account_number.')' }} </option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>



                            </div>



                            <div class="mt-2"></div>

                        </div>
                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('showPartnerList')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>

                            <button wire:click="approvalAndDisburse" wire:loading.remove class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md focus-visible:ring-2 focus-visible:ring-offset-2">
                                Confirm And Disburse

                            </button>



                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    <div class="w-full" >
        <div class="w-fit bg-gray-200 rounded-lg pl-1 pr-1 pt-1 pb-1 m-1">
            <livewire:accounting.loans-table/>
        </div>
    </div>

@endif


{{--    @endif--}}
