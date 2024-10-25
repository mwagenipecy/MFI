<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="flex w-full gap-2 mb-2 mb-2">
        <div class="ml-2">
            <label for="category" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                Start Date
            </label>
            <div class="relative ">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input datepicker="" datepicker-autohide="" wire:model="startDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 flatpickr-input" placeholder="Select date">
            </div>
        </div>
        <div class="">
            <label for="category" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                End Date
            </label>
            <div class="relative ">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input datepicker="" datepicker-autohide="" wire:model="endDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 flatpickr-input" placeholder="Select date">
            </div>
        </div>




        <div>
            <label for="nodes" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
               Select Branch
            </label>

            <select wire:model.bounce="branch" name="nodes" id="nodes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                <option selected="" value="">All </option>
                @foreach (DB::table('branches')->get() as $branch )


                <option value="{{ $branch->id }}"> {{ $branch->name }}</option>
                @endforeach


            </select>
        </div>



        <div class="">
            <label for="processorNodes" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                Status
            </label>
            <select wire:model.bounce="status" name="processorNodes" id="processorNodes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                <option selected="" value="">All </option>

                <option value="ACTIVE" > ACTIVE </option>

                <option value="ONPROGRESS" > ONPROGRESS  </option>
                <option value="AWAITING APPROVAL" >AWAITING APPROVAL  </option>

                <option value="REJECTED" > REJECTED  </option>
                <option value="AWAITING DISBURSEMENT" > AWAITING DISBURSEMENT  </option>


            </select>

        </div>
        
        <div class="">
            <label for="channels" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                Reset Filter
            </label>
            <button wire:click="resetAll" type="button" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 me-2 mb-2">
                {{-- <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                </svg> --}}

                <svg data-slot="icon"  class="w-4 h-4 " fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"></path>
                  </svg>
                Reset Filter
                </button>
        </div>



    </div>


    <livewire:reports.loan-application-report />

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
