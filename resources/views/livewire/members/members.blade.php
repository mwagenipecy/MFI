
<div>

    <style>
        .main-color {
            color: red;
        }

        .main-color-hover:hover {
            color: white; /* Change this to the desired hover color for the main color */
        }

        .secondary-color {
            color: red;
        }

        .secondary-color-hover:hover {
            color: white; /* Change this to the desired hover color for the secondary color */
        }
        .main-color-bg {
            background-color: red;
        }
        .main-color-bg-hover:hover {
            background-color: red; /* Change this to the desired hover color for the main color */
            color: white;
        }
        .icon-hover:hover {
            color: red; /* Change this to the desired hover color for the main color */
        }


        .box-button {
            color: red;
        }

        .box-button:hover {
            background-color: red;
            color: white;
        }

        .box-button:hover .icon-svg {
            stroke: white !important;;
        }

        .icon-svg {
            fill: red;
        }
        .icon-color {
            color: red;
        }

    </style>



    <div class="p-2">


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
                            <stop stop-color="#e63b3d" offset="0%" /> <!-- Dark Blue -->
                            <stop stop-color="#e63b3d" offset="100%" /> <!-- Light Blue -->
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#e63b3d" offset="0%" /> <!-- Light Blue -->
                            <stop stop-color="#e63b3d" stop-opacity="0" offset="100%" /> <!-- Dark Blue -->
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
                        MEMBERS MANAGEMENT

                    </div>

                </div>
                <div>



                    <div class="flex flex-wrap">
                        <table class="flex flex-wrap text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                            <tbody>
                            <tr class="">
                                <th scope="row" class="">
                                    <li class="flex items-center text-gray-500 text-xs">
                                        <svg class="w-3.5 h-3.5 mr-2 main-color dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                        </svg>
                                        Total Number of Members:
                                    </li>
                                </th>
                                <td class="text-gray-500 pl-2">
                                    {{ App\Models\MembersModel::count() }}

                                </td>

                            </tr>
                            <tr class="">
                                <th scope="row" class="">
                                    <li class="flex items-center text-gray-500 text-xs">
                                        <svg class="main-color w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                        </svg>
                                        Active Members:
                                    </li>
                                </th>
                                <td class="text-gray-500 pl-2">
                                    {{ App\Models\MembersModel::count() }}
                                </td>

                            </tr>
                            <tr class="">
                                <th scope="row" class="">
                                    <li class="flex items-center text-gray-500 text-xs">
                                        <svg class="main-color w-3.5 h-3.5 mr-2 text-red-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                        </svg>
                                        Pending Applications:

                                    </li>
                                </th>
                                <td class="pl-2">
                                    <p class="text-red-800 text-xs font-medium ">
                                        {{ App\Models\MembersModel::where('member_status','NEW CLIENT')->count() }}
                                    </p>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>

        </div>

        <!-- Dashboard actions -->
        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-lg shadow-md shadow-gray-200">

            <!-- Left: Avatars -->
            <div class="grid grid-cols-6 gap-2 p-2">
                @if (in_array( "Create and manage branches" , session()->get('permission_items')))

                    @php
                        $menuItems = [
                            ['id' => 2, 'label' => ' New Member'],];
                    @endphp

                    @foreach ($menuItems as $menuItem)
                        <button
                                wire:click="showAddMemberModal({{ $menuItem['id'] }})"
                                class="group box-button flex hover:main-color-bg text-center items-center w-full
                            @if ($this->tab_id == $menuItem['id'])
                            main-color-bg text-white font-bold
                            @else
                            bg-gray-100 text-gray-400 font-semibold
                            @endif
                            py-2 px-4 rounded-lg"
                        >

                            <div wire:loading wire:target="showAddMemberModal({{ $menuItem['id'] }})">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                            </div>
                            <div class="mr-2" wire:loading.remove wire:target="showAddMemberModal({{ $menuItem['id'] }})">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path class="group-hover:text-white @if($this->tab_id == $menuItem['id']) text-white-500 @else icon-color  @endif"
                                          stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>


                            </div>



                            {{ $menuItem['label'] }}
                        </button>
                    @endforeach

                @endif



            </div>




            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">



            @if($this->viewMemberDetails)


                <div>{{-- In work, do what you enjoy. --}}
                    <div>
                        <nav class="bg-red-100   rounded-lg pl-2 pr-2 shadow-2xl">
                            <div class="relative flex h-16 items-center justify-between">
                                <div class="flex flex-1 items-center justify-between">
                                    <div class="flex flex-shrink-0 items-start">
                                        <div class="flex items-center justify-between">
                                            <div wire:loading wire:target="menuItemClicked" >
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>

                                            </div>
                                            <div wire:loading.remove wire:target="menuItemClicked">

{{--                                                <div class="flex items-center justify-between">--}}
{{--                                                    <div>--}}
{{--                                                        <button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">--}}
{{--                                                                <?php--}}
{{--                                                                $urlValue=  \App\Models\MembersModel::where('id',Session::get('viewMemberId'))->value('profile_photo_path');--}}
{{--                                                                ?>--}}
{{--                                                            @if($urlValue)--}}

{{--                                                            @else--}}
{{--                                                                <img class="h-8 w-8 rounded-full" src="{{asset('/images/download-1.png')}}" alt="">--}}
{{--                                                            @endif--}}

{{--                                                        </button>--}}

{{--                                                    </div>--}}

                                                <p class="font-semibold ml-3 text-slate-600 text-red-900"> {{App\Models\MembersModel::where('id',Session::get('viewMemberId'))->value('first_name').' '.App\Models\MembersModel::where('id',Session::get('viewMemberId'))->value('middle_name').' '.App\Models\MembersModel::where('id',Session::get('viewMemberId'))->value('last_name')}}</p>

                                                </div>
                                                <div class="text-red-400 ml-4 mr-5 ">
                                                    <div class="ml-12 text-blue-900 font-bold">
                                                        {{App\Models\MembersModel::where('id',Session::get('viewMemberId'))->value('member_status')}}
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="flex">
                                        <div class="flex space-x-4">
                                            <!-- Current: "bg-gray-900 text-white", Default:"text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                        </div>

                                        <button type="button" class="rounded-full bg-white p-1 text-gray-400 hover:text-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">

                                            <svg wire:click="$toggle('viewMemberDetails')" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>



                                    </div>
                                </div>

                            </div>

                        </nav>

                        <div class="relative flex py-5 items-center">
                            <div class="flex-grow border-t border-gray-400"></div>
                            <span class="flex-shrink mx-4 text-gray-400">Member Data</span>
                            <div class="flex-grow border-t border-gray-400"></div>
                        </div>

                        <div class="w-full h-full grid p-2 ">
                                <?php        $employees=App\Models\MembersModel::where('id',session()->get('viewMemberId'))->get();                      ?>
                            @foreach($employees as $employee)
                                <div class="w-fit m-auto grid justify-items-center">
                                    <div class="w-fit text-center m-4" >
                                        @if($employee->profile_photo_path)
                                            <div style="display: flex; justify-content: center;">
                                                <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                                     src="{{$employee->profile_photo_path}}"
                                                     alt="{{$employee->first_name}}"/>
                                            </div>
                                        @else
                                            <div style="display: flex; justify-content: center;">
                                                <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                                     src="{{asset('/images/download-1.png')}}"
                                                     alt="{{$employee->first_name}}"/>
                                            </div>
                                        @endif
                                        <p class="text-2xl mt-4 border-b-2 border-b-blue-400 ">{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}}</p>
                                        <p class="m-4">{{$employee->address}}</p>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-lg pl-2 pr-2 pt-2 pb-2 ">
                                        <!-- message container -->
                                        <div>

                                            <div class="flex">

                                                <div class="container mx-auto ">
                                                    <div class="flex flex-col w-full" >

                                                        <div class="grid gap-3 grid-cols-1 sm:grid-cols-3 mb-2">


                                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >


                                                                <table>
                                                                    <tbody class="bg-white">
                                                                    @for ($i = 0; $i < 17; $i++)
                                                                        @if (isset($variables[$i]))
                                                                            <tr class="whitespace-nowrap">
                                                                                <td class="px-2 mr-2 py-4 text-sm text-gray-500 font-semibold">
                                                                                    <p>{{ $variables[$i]['label'] }}</p>
                                                                                </td>
                                                                                <td class="px-6 py-4">
                                                                                    <p class="text-sm text-gray-900">
                                                                                        {{ DB::table('members')->where('id', Session::get('viewMemberId'))->value($variables[$i]['name']) }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endfor
                                                                    </tbody>
                                                                </table>

                                                            </div>


                                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >
                                                                <!-- Second Table -->
                                                                <table>
                                                                    <tbody class="bg-white">
                                                                    @for ($i = 17; $i < 34; $i++)
                                                                        @if (isset($variables[$i]))
                                                                            <tr class="whitespace-nowrap">
                                                                                <td class="px-2 mr-2 py-4 text-sm text-gray-500 font-semibold">
                                                                                    <p>{{ $variables[$i]['label'] }}</p>
                                                                                </td>
                                                                                <td class="px-6 py-4">
                                                                                    <p class="text-sm text-gray-900">
                                                                                        {{ DB::table('members')->where('id', Session::get('viewMemberId'))->value($variables[$i]['name']) }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endfor
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class=" metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >
                                                                <!-- Second Table -->
                                                                <table>
                                                                    <tbody class="bg-white">





                                                                    @php
                                                                        $memberData = DB::table('members')
                                                                            ->where('id', Session::get('viewMemberId'))
                                                                            ->first();
                                                                    @endphp

                                                                    @if (is_array($variables) && count($variables) > 0)
                                                                        @for ($i = 34; $i < count($variables); $i++)
                                                                            @if (isset($variables[$i]))
                                                                                <tr class="whitespace-nowrap">
                                                                                    <td class="px-2 mr-2 py-4 text-sm text-gray-500 font-semibold">
                                                                                        <p>{{ $variables[$i]['label'] }}</p>
                                                                                    </td>
                                                                                    <td class="px-6 py-4">
                                                                                        @if (isset($memberData->{$variables[$i]['name']}))
                                                                                            <p class="text-sm text-gray-900">
                                                                                                {{ $memberData->{$variables[$i]['name']} }}
                                                                                            </p>
                                                                                        @else
                                                                                            <p class="text-sm text-gray-900">
                                                                                                N/A
                                                                                            </p>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endfor
                                                                    @else
                                                                        <p>No variables available.</p>
                                                                    @endif



                                                                    </tbody>
                                                                </table>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-white rounded-2xl mt-1 p-4">
                                            <h2 class="heading uppercase">  Available  Loans </h2>
                                            <div class="flex w-full">
                                                <div class="w-1/2 text-light font-bold  ">
                                                    Loan Products
                                                </div>

                                                <div class="w-1/2 text-light  font-bold ">
                                                    amount
                                                </div>

                                                <div class="w-1/2 text-light   font-bold">
                                                    status
                                                </div>
                                            </div>



                                            @foreach($this->loanStatus as $loan)
                                                <div class="flex w-full">

                                                    <div class="w-1/2 text-light  ">
                                                        {{DB::table('loan_sub_products')->where('sub_product_id',$loan->loan_sub_product)->value('sub_product_name')}}
                                                    </div>

                                                    <div class="w-1/2 text-light  ">
                                                        {{number_format($loan->principle)}} TZS
                                                    </div>

                                                    <div class="w-1/2 text-light  ">
                                                        {{$loan->status}}
                                                    </div>
                                                </div>
                                            @endforeach



                                        </div>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            @else
                <livewire:members.members-table/>


            @endif





        </div>
    </div>




    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showCreateNewMember">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">


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

                <div class="w-full bg-white  p-4">

                    <div class="w-full">
                        <div class="mb-4">
                            <h5 >
                                CREATE Member
                            </h5>
                        </div>


                        <div class="col-span-6 sm:col-span-4 mb-4">


                            <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Member Name</p>
                            <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" wire:model.defer="name" autofocus />
                            @error('name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The name is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Region</p>
                            <x-jet-input id="region" name="region" type="text" class="mt-1 block w-full" wire:model.defer="region" autofocus />
                            @error('region')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The region is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="wilaya" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Wilaya</p>
                            <x-jet-input id="wilaya" name="wilaya" type="text" class="mt-1 block w-full" wire:model.defer="wilaya" autofocus />
                            @error('wilaya')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The wilaya is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="membershipNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Membership Number</p>
                            <x-jet-input id="membershipNumber" name="membershipNumber" type="text" class="mt-1 block w-full" wire:model.defer="membershipNumber" autofocus />
                            @error('membershipNumber')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The membership number is mandatory, it should be more than three characters and unique.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="parentMember" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Parent Member</p>
                            <select wire:model.bounce="parentMember" name="parentMember" id="parentMember" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Select</option>
                                @foreach(App\Models\MembersModel::all() as $Member)
                                    <option value="{{$Member->id}}">{{$Member->name}}</option>
                                @endforeach

                            </select>
                            @error('parentMember')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The Parent Member is mandatory.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                        </div>






                    </div>




                </div>



            </div>



        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showCreateNewMember')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove>
                <x-jet-button class="ml-3"
                              wire:click="submit"
                              wire:loading.attr="disabled">
                    {{ __('Create user') }}
                </x-jet-button>
            </div>
            <div wire:loading>
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>



    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showDeleteMember">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
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
                    @if (session('alert-class') == 'alert-warning')
                        <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">Error</p>
                                    <p class="text-sm">{{ session('message') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="flex w-full">
                    <!-- message container -->
                    <div class="w-full p-4 ">
                        @if($this->memberSelected)
                            <p  class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">Member SELECTED</p>
                            <div class="flex items-center mb-2 text-sm spacing-sm text-slate-600 mt-2" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p>{{ App\Models\MembersModel::where('id', $this->memberSelected)->value('first_name') }}</p>
                            </div>
                            <div class="mt-4 w-full">
                                <p for="MemberSelected" class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SELECT ACTION</p>
                                <div class="flex gap-4 items-center text-center">
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="DELETED" /> End Membership
                                </div>
                                @if($this->permission=="DELETED")
                                    <div class="active:text-inherit p-4 mt-4">
                                        <label> Upload exit  document</label>
                                        <x-jet-input type="file" wire:model="member_exit_document"  required></x-jet-input>
                                    </div>
                                @endif
                            </div>
                            <p for="password" class="block mb-1 mt-4 text-sm capitalize text-slate-400 dark:text-white ">ENTER PASSWORD TO CONFIRM</p>
                            <input wire:model.defer="password" id="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                            <x-jet-input-error for="current_password" class="mt-2" />
                        @endif
                    </div>
                </div>
                <div class="mt-8"></div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteMember')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="confirmPassword" >
                <x-jet-button class="ml-3"
                              wire:click="confirmPassword"
                              wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="confirmPassword">
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Log Out Other Devices Confirmation Modal -->



    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showAddMemberk">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">


            <div>
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

                    @if (session()->has('message_fail'))

                        <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">The process fail</p>
                                    <p class="text-sm">{{ session('message_fail') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="justify-center">




                    <section class=" w-full bg-white-300 flex flex-col items-center justify-center">
                        @if ($this->photo)
                            <img class="object-fill w-5/5 rounded-l-lg" src="{{ $photo->temporaryUrl() }}">
                        @else
                            @if ($this->profile_photo_path)
                                <img class="object-fill w-5/5 rounded-l-lg" src="{{$this->profile_photo_path}}">
                            @else

                            @endif

                        @endif
                    </section>




                    <div class="  w-full  flex items-center justify-center hover:bg-gray-100 hover:border-gray-300">



                        <label class="flex flex-col w-full h-19 cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-7">

                                <div wire:loading wire:target="photo" class="" >

                                    <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                    </svg>
                                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                                </div>

                                <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                        Select new image</p>

                                </div>

                            </div>



                            <input type="file" class="opacity-0" wire:model="photo"/>
                        </label>
                    </div>
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                </div>
                <x-jet-section-border />

{{--                <!-- Email -->--}}
{{--                <div class="col-span-6 sm:col-span-4">--}}
{{--                    <x-jet-label for="phone_number" value="{{ __('Phone Number (Reference Number)') }}" />--}}
{{--                    <x-jet-input id="phone_number" type="tel" class="mt-1 block w-full" wire:model="phone_number" />--}}
{{--                    <x-jet-input-error for="phone_number" class="mt-2" />--}}
{{--                </div>--}}

{{--                @if($this->phone_number)--}}
{{--                    <div class="font-bold mb-4">--}}
{{--                        <div class="flex space-x-4 space-y-1">--}}
{{--                            <div class="p-1">Registration fees:  {{number_format(DB::table('pending_registrations')->where('nida_number',$this->phone_number)->where('status','INITIAL PAY')->value('amount'))}} TZS--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="space-x-4 flex space-y-1">--}}
{{--                            <div class="p-1"> Allocated shares:--}}
{{--                                {{ number_format(DB::table('pending_registrations')->where('nida_number',$this->phone_number)->where('status','ACTIVE')->value('amount'))}}TZS--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                    <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" autocomplete="first_name" />

                    <x-jet-input-error for="first_name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                    <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autocomplete="middle_name" />
                    <x-jet-input-error for="middle_name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autocomplete="last_name" />
                    <x-jet-input-error for="last_name" class="mt-2" />
                </div>


                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="incorporation_number" value="{{ __('Incorporation Number') }}" />
                    <x-jet-input id="incorporation_number" type="text" class="mt-1 block w-full" wire:model.defer="incorporation_number" />
                    <x-jet-input-error for="incorporation_number" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="next_of_kin_name" value="{{ __('Next of Kin Full Name') }}" />
                    <x-jet-input id="next_of_kin_name" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_name" />
                    <x-jet-input-error for="next_of_kin_full_name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="next_of_kin_phone" value="{{ __('Next of Kin Phone Number') }}" />
                    <x-jet-input id="next_of_kin_phone" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_phone" />
                    <x-jet-input-error for="next_of_kin_phone" class="mt-2" />
                </div>




                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="business_name" value="{{ __('Business Name') }}" />

                    <x-jet-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" wire:model.defer="business_name" />
                    @error('business_name')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Business Name is mandatory, it should be more than three characters.</p>
                    </div>
                    @enderror
                </div>


                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>


                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="date_of_birth" value="{{ __('Date Of Birth') }}" />
                    <x-jet-input id="date_of_birth" type="date" class="mt-1 block w-full" wire:model.defer="date_of_birth" />
                    <x-jet-input-error for="date_of_birth" class="mt-2" />
                </div>



                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="gender" value="{{ __('Gender') }}" />
                    <select wire:model.defer="gender" name="gender" id="gender" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>

                    </select>
                    @error('gender')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Gender is mandatory.</p>
                    </div>
                    @enderror

                </div>


                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="marital_status" value="{{ __('Marital Status') }}" />
                    <select wire:model.defer="marital_status" name="marital_status" id="marital_status" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option  value="Married">Married</option>
                        <option  value="Single">Single</option>
                        <option  value="Divorced">Divorced</option>
                        <option  value="Widow">Widow</option>

                    </select>
                    @error('marital_status')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Marital Status is mandatory.</p>
                    </div>
                    @enderror

                </div>


                <div class="col-span-6 sm:col-span-4">

                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ __('By changing the branch of the member, you are transferring the member from the previous branch to newly selected branch. A new Account will be created for this member .') }}
                        </p>
                    </div>
                </div>
                <br>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Branch</label>
                    <select wire:model.bounce="branch" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        @foreach(App\Models\BranchesModel::all() as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach

                    </select>
                    @error('branch')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Branch is mandatory.</p>
                    </div>
                    @enderror

                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Membership Type</label>
                    <select wire:model.bounce="membership_type" name="membership_type" id="membership_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="Individual">Individual</option>
                        <option value="Group">Group</option>
                        <option value="Business">Business</option>


                    </select>
                    @error('membership_type')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Membership Type is mandatory.</p>
                    </div>
                    @enderror

                </div>


                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="street" value="{{ __('Street') }}" />
                    <x-jet-input id="street" name="street" type="text" class="mt-1 block w-full" wire:model.defer="street" />
                    @error('street')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Street is mandatory, it should be more than three characters and unique.</p>
                    </div>
                    @enderror
                </div>



                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="address" value="{{ __('Residential Address') }}" />
                    <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" wire:model.defer="address" />
                    @error('address')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Address is mandatory, it should be more than three characters.</p>
                    </div>
                    @enderror
                </div>


                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="notes" value="{{ __('Notes') }}" />
                    <textarea id="notes" name="notes" wire:model.defer="notes" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
                    @error('notes')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Notes is mandatory, it should be more than three characters.</p>
                    </div>
                    @enderror
                </div>






            </div>





        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showAddMember')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="addMemberv" >
                <x-jet-button class="ml-3"
                              wire:click="addMember"
                              wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="addMemberx">
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>


    <div class="w-full container-fluid">

        @if($this->showAddMember)

            <div class="fixed z-10 inset-0 overflow-y-auto"  >
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <!-- Your form elements go here -->
                        <div class="p-2 mx-2">
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

                                @if (session()->has('message_fail'))

                                    <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                            <div>
                                                <p class="font-bold">The process fail</p>
                                                <p class="text-sm">{{ session('message_fail') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>


                            <div class="justify-center">




                                <section class=" w-full bg-white-300 flex flex-col items-center justify-center">
                                    @if ($this->photo)
                                        <img class="object-fill w-5/5 rounded-l-lg" src="{{ $photo->temporaryUrl() }}">
                                    @else
                                        @if ($this->profile_photo_path)
                                            <img class="object-fill w-5/5 rounded-l-lg" src="{{$this->profile_photo_path}}">
                                        @else

                                        @endif

                                    @endif
                                </section>



                                <div class="  w-full  flex items-center justify-center hover:bg-gray-100 hover:border-gray-300">

                                    <label class="flex flex-col w-full h-19 cursor-pointer">
                                        <div class="flex flex-col items-center justify-center pt-7">

                                            <div wire:loading wire:target="photo" class="" >

                                                <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>
                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                                            </div>

                                            <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                    Select new image</p>

                                            </div>

                                        </div>
                                        <input type="file" class="opacity-0" wire:model="photo" accept=".png, .jpeg, .jpg" />
                                        {{--                                        <input type="file" class="opacity-0" wire:model="photo"/>--}}
                                    </label>
                                </div>
                                @error('photo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <x-jet-section-border />

                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                                <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" autocomplete="first_name" />

                                <x-jet-input-error for="first_name" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                                <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autocomplete="middle_name" />
                                <x-jet-input-error for="middle_name" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                                <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autocomplete="last_name" />
                                <x-jet-input-error for="last_name" class="mt-2" />
                            </div>


                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="member_number" value="{{ __('Member Number') }}" />
                                <x-jet-input id="member_number" type="text" class="mt-1 block w-full" wire:model.defer="member_number" />
                                <x-jet-input-error for="member_number" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="phone_number" />
                                <x-jet-input-error for="phone_number" class="mt-2" />
                            </div>


                            <!-- Boda Number -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="boda_number" value="{{ __('Motorcycle plate Number') }}" />
                                <x-jet-input id="boda_number" type="text" class="mt-1 block w-full" wire:model.defer="boda_number" />
                                <x-jet-input-error for="boda_number" class="mt-2" />
                            </div>

                            <!-- Tawi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="tawi" value="{{ __('Tawi') }}" />
                                <x-jet-input id="tawi" type="text" class="mt-1 block w-full" wire:model.defer="tawi" />
                                <x-jet-input-error for="tawi" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="ward" value="{{ __('Ward') }}" />
                                <x-jet-input id="ward" type="text" class="mt-1 block w-full" wire:model.defer="ward" />
                                <x-jet-input-error for="ward" class="mt-2" />
                            </div>

                            <!-- District -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="district" value="{{ __('District') }}" />
                                <x-jet-input id="district" type="text" class="mt-1 block w-full" wire:model.defer="district" />
                                <x-jet-input-error for="district" class="mt-2" />
                            </div>

                            <!-- Region -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="region" value="{{ __('Region') }}" />
                                <x-jet-input id="region" type="text" class="mt-1 block w-full" wire:model.defer="region" />
                                <x-jet-input-error for="region" class="mt-2" />
                            </div>

                            <!-- Next of kin Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="next_of_kin_name" value="{{ __('Next of Kin Full Name') }}" />
                                <x-jet-input id="next_of_kin_name" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_name" />
                                <x-jet-input-error for="next_of_kin_full_name" class="mt-2" />
                            </div>

                            <!-- Naxt of kin Phone number-->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="next_of_kin_phone" value="{{ __('Next of Kin Phone Number') }}" />
                                <x-jet-input id="next_of_kin_phone" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_phone" />
                                <x-jet-input-error for="next_of_kin_phone" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="next_of_kin_relationship" value="{{ __('Next of Kin Relationship') }}" />
                                <x-jet-input id="next_of_kin_relationship" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_relationship" />
                                <x-jet-input-error for="next_of_kin_relationship" class="mt-2" />
                            </div>



                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="nationarity" value="{{ __('Nationality') }}" />
                                <x-jet-input id="nationarity" type="text" class="mt-1 block w-full" wire:model.defer="nationarity" />
                                <x-jet-input-error for="nationarity" class="mt-2" />
                            </div>



                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                                <select wire:model.defer="gender" name="gender" id="gender" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>

                                </select>
                                @error('gender')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p>Gender is mandatory.</p>
                                </div>
                                @enderror

                            </div>


                            <div class="col-span-6 sm:col-span-4">

                                <div class="mt-3 max-w-xl text-sm text-gray-600">
                                    <p>
                                        {{ __('By changing the branch of the member, you are transferring the member from the previous branch to newly selected branch. A new Account will be created for this member .') }}
                                    </p>
                                </div>
                            </div>
                            <br>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Branch</label>
                                <select wire:model.bounce="branch" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    @foreach(App\Models\BranchesModel::all() as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach

                                </select>
                                @error('branch')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p>Branch is mandatory.</p>
                                </div>
                                @enderror

                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Membership Type</label>
                                <select wire:model.bounce="membership_type" name="membership_type" id="membership_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <option value="Individual">Individual</option>
                                    <option value="Group">Group</option>
                                    <option value="Business">Business</option>


                                </select>
                                @error('membership_type')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p>Membership Type is mandatory.</p>
                                </div>
                                @enderror

                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="attachments" value="{{ __('Attachments') }}" />

                                <!-- Document 1 -->
                                <div class="mt-2">
                                    <x-jet-label for="personal_identification" value="{{ __('National ID(NIDA)/Voter Id/Driving licence') }}" />
                                    <input id="personal_identification" type="file" class="mt-1 block w-full" wire:model.defer="personal_identification" accept=".pdf"/>

                                    <x-jet-input-error for="personal_identification" class="mt-2" />
                                </div>

                                <!-- Document 2 -->
                                <div class="mt-2">
                                    <x-jet-label for="local_government_letter" value="{{ __('Local government letter') }}" />
                                    <input id="local_government_letter" type="file" class="mt-1 block w-full" wire:model.defer="local_government_letter" accept=".pdf"/>

                                    <x-jet-input-error for="local_government_letter" class="mt-2" />
                                </div>

                                <!-- Ownership -->
                                <div class="mt-2">
                                    <x-jet-label for="is_owner" value="{{ __('Is the member the owner?') }}" />
                                    <select id="is_owner" wire:model="is_owner" class="mt-1 block w-full">
                                        <option value="yes">{{ __('Yes') }}</option>
                                        <option value="no">{{ __('No') }}</option>
                                    </select>
                                    <x-jet-input-error for="is_owner" class="mt-2" />
                                </div>

                                <!-- Document 3 (Visible if member is owner) -->
                                @if($is_owner === 'yes')
                                    <div class="mt-2">
                                        <x-jet-label for="motorcycle_card" value="{{ __('Motorcycle card') }}" />
                                        <input id="motorcycle_card" type="file" class="mt-1 block w-full" wire:model.defer="motorcycle_card" accept=".pdf"/>

                                        <x-jet-input-error for="motorcycle_card" class="mt-2" />
                                    </div>
                                @endif

                                <!-- Document 4 (Visible if member is not owner) -->
                                @if($is_owner === 'no')
                                    <div class="mt-2">
                                        <x-jet-label for="motorcycle_contract" value="{{ __('Motorcycle contract') }}" />
                                        <input id="motorcycle_contract" type="file" class="mt-1 block w-full" wire:model.defer="motorcycle_contract" accept=".pdf" />

                                        <x-jet-input-error for="motorcycle_contract" class="mt-2" />
                                    </div>
                                @endif
                            </div>


                            <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('showAddMember')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            <button wire:click="addMember" wire:loading.attr="disabled" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md focus-visible:ring-2 focus-visible:ring-offset-2">
                                <span wire:loading wire:target="addMember">Loading...</span>
                                <span wire:loading.remove>Proceed</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>






    <div class="w-full container-fluid">

        @if($this->showEditMember)

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
                            </div>



                            <div class="bg-white p-4">
                                <div class="flex justify-center m-8">
                                    <div class="max-w-2xl rounded-lg shadow-sm bg-gray-50">
                                        <div class="m-4">

                                            <section class="bg-white-300 flex flex-col items-center justify-center">
                                                @if ($this->photo)
                                                    <img class="object-fill w-3/5 " src="{{ $photo->temporaryUrl() }}" alt="">
                                                @else
                                                    <img class="block rounded-b w-64" src="{{ asset($this->profile_photo_path)}}" alt="profile Pic">
                                                @endif


                                            </section>




                                            <div class="flex items-center justify-center w-full">
                                                <label class="flex flex-col w-full h-19 hover:bg-gray-100 hover:border-gray-300">
                                                    <div class="flex flex-col items-center justify-center pt-7">


                                                        <p>  <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center mt-0 mb-8">

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                            </svg>
                                                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                Attach Member Photo</p>

                                                        </div>

                                                        </p>
                                                    </div>
                                                    <div wire:loading wire:target="photo" class="" >

                                                        <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                        </svg>
                                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                                                    </div>
                                                    <input type="file" class="opacity-0" wire:model="photo"  @disabled(Session::get('disableInputs'))  />
                                                </label>


                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h5 >
                                        EDIT CLIENT : {{$this->pendingMembername}}
                                    </h5>
                                </div>


                                @if($this->member)



                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Member Type</label>
                                        <select wire:model="membership_type"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected >select</option>
                                            <option value="individual" >Individual</option>
                                            <option value="company">Company</option>


                                        </select>
                                        @error('membership_type')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Member Type is mandatory.</p>
                                        </div>
                                        @enderror

                                    </div>
                                    @if($this->membership_type == "individual")
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Gender</label>
                                            <select wire:model.defer="gender"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" selected >select</option>
                                                <option value="Male" >Male</option>
                                                <option value="Female">Female</option>


                                            </select>
                                            @error('gender')
                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                <p>Gender is mandatory.</p>
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="marital_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Marital Status</label>
                                            <select wire:model.defer="marital_status"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" selected >select</option>
                                                <option value="Single" >Single</option>
                                                <option value="Married" >Married</option>
                                                <option value="Widow" >Widow</option>
                                                <option value="Widower" >Widower</option>
                                                <option value="Divorced" >Divorced</option>



                                            </select>
                                            @error('marital_status')
                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                <p>Marital Status is mandatory.</p>
                                            </div>
                                            @enderror

                                        </div>
                                    @endif


                                    @foreach ($this->variables as $variable)
                                        @if($this->membership_type == $variable['for'] or $variable['for'] == 'both')
                                            <div class="col-span-6 sm:col-span-4">
                                                <x-jet-label for="{{ $variable['name'] }}" value="{{ __($variable['label']) }}" />
                                                <x-jet-input id="{{ $variable['name'] }}" type="{{ $variable['type'] }}" class="mt-1 block w-full" wire:model.defer="{{ $variable['name'] }}" />
                                                <x-jet-input-error for="{{ $variable['name'] }}" class="mt-2" />
                                            </div>

                                        @endif


                                    @endforeach

                                @endif

                            </div>




                            <div class="mt-2"></div>

                        </div>

                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('showEditMember')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            <button wire:click="updateMember" wire:loading.attr="disabled" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md focus-visible:ring-2 focus-visible:ring-offset-2">
                                <span wire:loading wire:target="updateMember">Loading...</span>
                                <span wire:loading.remove>Proceed</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>







</div>




</div>
