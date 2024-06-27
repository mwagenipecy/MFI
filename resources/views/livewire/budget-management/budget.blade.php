<div>
    <div class="p-2">

        <div class="bg-white rounded-2xl">



            <!-- Welcome banner -->
            <div class="relative p-4 mb-2 overflow-hidden rounded-lg bg-white" >

                <!-- Background illustration -->
                <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                    <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                            <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                            <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                            <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                                <stop stop-color="#e63b3d" offset="0%" /> <!-- Dark red -->
                                <stop stop-color="#e63b3d" offset="100%" /> <!-- Light red -->
                            </linearGradient>
                            <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                                <stop stop-color="#e63b3d" offset="0%" /> <!-- Light red -->
                                <stop stop-color="#e63b3d" stop-opacity="0" offset="100%" /> <!-- Dark red -->
                            </linearGradient>
                        </defs>
                        <g fill="none" fill-rule="evenodd">
                            <g transform="rotate(64 36.592 105.604)">
                                <mask id="welcome-d" fill="#fff">
                                    <use xlink:href="#welcome-a" />
                                </mask>
                                <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                                <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                            </g>
                            <g transform="rotate(-51 91.324 -105.372)">
                                <mask id="welcome-f" fill="#fff">
                                    <use xlink:href="#welcome-e" />
                                </mask>
                                <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                                <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                            </g>
                            <g transform="rotate(44 61.546 392.623)">
                                <mask id="welcome-h" fill="#fff">
                                    <use xlink:href="#welcome-g" />
                                </mask>
                                <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                                <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                            </g>
                        </g>
                    </svg>
                </div>

                <!-- Content -->
                <div class="relative w-full">
                    <div class="min-w-full text-center text-sm font-light">
                        <div class="text-xl text-slate-400 font-bold mb-1 ">
                            BUDGET  MANAGEMENT

                        </div>

                    </div>
                    <div>

                        <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                @if($this->selectYear==\Carbon\Carbon::now()->year)
                                Budget For Current Year : {{$this->selectYear}}

                                @else
                                    Budget For Year
                                    {{$this->selectYear}}
                                @endif
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Total Budget : {{number_format(DB::table('main_budget')->where('year',$this->selectYear)->sum('total'))}} TZS
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Total Accounts
                                <span>
                                <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"> {{ App\Models\AccountsModel::count() }}</span>
                            </span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-lg">
            <div class="flex w-full mb-4 gap-2 h-30 ">
                <div class="grid grid-cols-6 gap-2 p-2">
                    @php
                        $menuItems = [
                            ['id' => 1, 'label' => 'Budget Item'],
                            ['id' => 2, 'label' => 'Pending Budget'],

                        ];
                    @endphp

                    @foreach ($menuItems as $menuItem)



                        <button
                                wire:click="menuItemClicked({{ $menuItem['id'] }})"
                                class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                                @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                        py-2 px-4 rounded-lg"

                                onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                                onmouseout="this.style.backgroundColor=''; this.style.color='';"
                        >

                            <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                            </div>
                            <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                     class="w-4 h-4 mr-2 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                            </div>



                            {{ $menuItem['label'] }}
                        </button>

                    @endforeach
                </div>


            </div>




            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            <div class=" flex justify-end item-end ">

                <div class="flex w-1/3">
                    <button id="states-button"  class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
                        YEAR
                    </button>

                    <label for="states" class="sr-only">Choose a year</label>
                    <select id="states" wire:model="selectYear" wire:change="refreshComponent"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg
                        border-l-gray-100 dark:border-l-gray-700 border-l-2
                        block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white">
                        <option value="2022">2022</option>
                        <option value="2023"> 2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                    </select>
                </div>

            </div>


          @if($setCapitalAccount)
            <div class="space-y-3 sm:flex sm:items-start sm:space-y-0 sm:justify-between">

                <a href="#" wire:click="setCapitaModal" class="flex items-center justify-center px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>

                    <span class="mx-1">Set Operational Account</span>
                </a>
            </div>
            @endif

            <div class="tab-pane fade " id="tabs-homeJustify"
                 role="tabpanel" aria-labelledby="tabs-home-tabJustify">
                <div class="mt-2"></div>
                <div class="w-full flex items-center justify-center">
                    <div wire:loading wire:target="setView">
                        <div class="h-96 m-auto flex items-center justify-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-500"></div>
                        </div>
                    </div>
                </div>





            </div>


            <div class="row-span-1 col-span-7 flex flex-col bg-white rounded-2xl">
                @switch($this->tab_id)
                    @case('3')
                    <livewire:budget-management.budget-item />
                    @break
                    @case('1')

                    <livewire:budget-management.all-budget />
                    @break
                    @case('2')
                    <livewire:budget-management.awaiting-approval />
                    @break

                @endswitch

            </div>

        </div>





    </div>




    <div class="w-full container-fluid">

        @if($this->enableSetCapital)
            <div class="fixed z-10 inset-0 overflow-y-auto"  >
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                        <div class="p-4">
                            <div>
                                <div>
                                    @if (session()->has('success_message'))
{{--                                        @if (session('alert-class') == 'alert-success')--}}
                                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                                <div class="flex">
                                                    <div class="py-1">
                                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="font-bold">The process is completed</p>
                                                        <p class="text-sm">{{ session('success_message') }} </p>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        @endif--}}
                                    @endif

                                        @if (session()->has('message_fail'))
{{--                                        @if (session('alert-class') == 'alert-success')--}}
                                            <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                                <div class="flex">
                                                    <div class="py-1">
                                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="font-bold">The process is completed</p>
                                                        <p class="text-sm">{{ session('message_fail') }} </p>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        @endif--}}
                                    @endif


                                </div>

                            </div>
                            <div class="header-elements text-center justify-center font-bold  stroke-current">
                                <h5 class="fw-bold">
                                    CONFIRM THE CAPITAL ACCOUNT
                                </h5>
                            </div>

                            <div class="mt-5">

                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="expense_category" value="{{ __('Revenue Account') }}" />
                                    @php
                                        $account=DB::table('accounts')->where('id',DB::table('institutions')->where('id',1)->value('revenue_account'))->first();
                                                                        $value=  $account->account_name.' '.$account->account_number;
                                    @endphp
                                    <x-jet-label for="expense_category" value="{{ $value
                                                                       }}" />

                                    <x-jet-input-error for="expense_category" class="mt-2" /> <br>

                                    <x-jet-label for="expense_category" value="{{ __('Revenue balance') }}" />

                                    <x-jet-label for="expense_category" value="{{ DB::table('institutions')->where('id',1)->value('amount')
                                                                      }}" />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="expense_category" value="{{ __('Total Budget Amount') }}" />
                                    <x-jet-label for="expense_category" value="{{number_format(DB::table('main_budget')->where('year',$this->selectYear)->sum('total'))}} TZS" />
                                    <x-jet-input-error for="expense_category" class="mt-2" />
                                </div>
                            </div>
                        </div>


                            <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('enableSetCapital')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>

                            <button wire:click="setAccount" wire:loading.attr="disabled" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md focus-visible:ring-2 focus-visible:ring-offset-2">
                                <span wire:loading wire:target="setAccount">Loading...</span>
                                <span wire:loading.remove> Confirm and Approve</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>



</div>




                {{-- Because she competes with no one, no one can compete with her. --}}
