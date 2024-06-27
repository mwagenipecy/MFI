<div class="h-full w-full ">


@if (session()->has('message'))
        <div class="alert alert-success bg-blue-100 fw-bold text-center justify-center ">
             <strong>  {{ session('message') }}  </strong>
        </div>
    @endif


    <div class="w-full h-full grid justify-items-center">

        <div class="w-full m-auto grid justify-items-center">

            <div class="w-full bg-gray-100 rounded-lg pl-2 pr-2 pt-1 pb-1 ">
                <!-- message container -->
                <div>

                    {{--                        <input type="text" wire:model="inputValue">--}}
                    {{--                        <div> {{$this->inputValue}}</div>--}}
                    {{--                        {{session()->get('userDepartment')}}--}}
                    <div class="flex">
                        <div class="container mx-auto ">
                            <livewire:dashboard.front-desk/>

                               <div class="bg-white rounded-lg mt-2 p-2 mb-2">
                                   <div class="text-base p-4 mb-2 mt-2  font-bold leading-light">
                                     Repayment Follow up
                                   </div>
                                   <div class="mt-2 mb-2"> </div>


                                       <livewire:dashboard.loan-update/>

                                   <div class="w-full container-fluid">

                                       @if($this->createPromises)

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
                                                           <div class="header-elements text-center justify-center font-bold  stroke-current">
                                                               <h3 class="fw-bold">
                                                                  CREATE PROMISE
                                                               </h3>
                                                           </div>

                                                           <div class="mt-5"> </div>
                                                           <div class="mt-5"> </div>

                                                           <x-jet-label for="max_amount" value="{{ __('Promise Date ') }}" />
                                                           <input id="max_amount" name="max_amount" type="date" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                  wire:model="promise_date" autofocus >

                                                           @error('promise_date')
                                                           <div class="border border-red-400 rounded-b text-red-100 px-4 py-3 text-red-700 mt-1">
                                                               <p> date  is mandatory</p>
                                                           </div>
                                                           @enderror
                                                           <div class="mt-2"></div>

                                                           <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descriptions</label>
                                                           <textarea wire:model="promise_description" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>

                                                           @error('promise_description')
                                                           <div class="border border-red-400 rounded-b text-red-100 px-4 py-3 text-red-700 mt-1">
                                                               <p> description  is mandatory</p>
                                                           </div>
                                                           @enderror
                                                           <div class="mt-2">
                                                           </div><div class="mt-2"></div>

                                                       </div>
                                                       <!-- Add more form fields as needed -->
                                                       <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                                                           <button type="button" wire:click="$toggle('createPromises')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                                               Cancel
                                                           </button>
                                                           <button type="submit" wire:click="createPromise" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                                               Proceed
                                                           </button>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       @endif
                                   </div>



                               </div>


                                <div class="bg-white rounded-lg mt-2 p-2 mb-2">
                                    <div class="text-base p-4 mb-2 mt-2  font-bold leading-light">
                                        Loan Book Healthy
                                    </div>
                                    <div class="mt-2 mb-2"> </div>

                                    <livewire:dashboard.loan-promises />

                                </div>
                        </div>




                    </div>







            </div>
        </div>


    </div>

</div>



</div>
