<div>


    <style>
        .main-color {
            color: #E63B3D;
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
            background-color: #E63B3D;
        }
        .main-color-bg-hover:hover {
            background-color: #E63B33; /* Change this to the desired hover color for the main color */
            color: white;
        }
        .icon-hover:hover {
            color: #E63B33; /* Change this to the desired hover color for the main color */
        }


        .box-button {
            color: #2D3D88;
        }

        .box-button:hover {
            background-color: #E63B33;
            color: white;
        }

        .box-button:hover .icon-svg {
            stroke: white !important;;
        }

        .icon-svg {
            fill: #2D3D88;
        }
        .icon-color {
            color: #2D3D88;
        }

    </style>





    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
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
                        ORGANIZATION SETTINGS

                    </div>

                </div>

                <div class="flex flex-wrap">
                    <table class="flex flex-wrap text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                        <tbody>
                        <tr class="">
                            <th scope="row" class="">
                                <li class="flex items-center text-gray-500 text-xs">
                                    <svg class="w-3.5 h-3.5 mr-2 main-color dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    Required Settings:
                                </li>
                            </th>
                            <td class="text-gray-500 ml-4">
                                22
                            </td>

                        </tr>

                        <tr class="">
                            <th scope="row" class="">
                                <li class="flex items-center text-gray-500 text-xs">
                                    <svg class="main-color w-3.5 h-3.5 mr-2 text-red-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    Pending Settings:

                                </li>
                            </th>
                            <td class="ml-4">
                                <p class="text-red-800 text-xs font-medium ">
                                <span>
                                <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"> 3</span>
                                </span>
                                </p>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>





            </div>

        </div>




        <div class="bg-white p-4 mb-2 rounded-lg">

            <div class="flex gap-2 p-2" >

                @php
                    $menuItems = [
                        ['id' => 1, 'label' => 'Settings'],
                        ['id' => 2, 'label' => 'Leadership'],
                        ['id' => 3, 'label' => 'End of Day'],
                        ['id' => 5, 'label' => 'End of Year'],

                    ];
                @endphp


                @foreach ($menuItems as $menuItem)

                    <button
                            wire:click="menu_sub_button({{ $menuItem['id'] }})"
                            class="group box-button flex hover:main-color-bg text-center items-center w-full
                            @if ($this->teller_tab == $menuItem['id'])
                            main-color-bg text-white font-bold
                            @else
                            bg-gray-100 text-gray-400 font-semibold
                            @endif
                            py-2 px-4 rounded-lg"
                    >

                        <div wire:loading wire:target="menu_sub_button({{ $menuItem['id'] }})">
                            <svg aria-hidden="true" class="w-6 h-6 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
                        <div class="mr-2" wire:loading.remove wire:target="menu_sub_button({{ $menuItem['id'] }})">

                        @if($menuItem['id'] == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path class="group-hover:text-white @if($this->teller_tab == $menuItem['id']) text-white @else icon-color  @endif" stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path class="group-hover:text-white @if($this->teller_tab == $menuItem['id']) text-white @else icon-color  @endif" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                        @endif
                        @if($menuItem['id'] == 2)

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path class="group-hover:text-white @if($this->teller_tab == $menuItem['id']) text-white @else icon-color  @endif" stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>

                        @endif
                            @if($menuItem['id'] == 3 or $menuItem['id'] == 4 or $menuItem['id'] == 5)


                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path class="group-hover:text-white @if($this->teller_tab == $menuItem['id']) text-white @else icon-color  @endif" stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>


                            @endif




                        </div>



                        <span class="group-hover:text-white @if( trim($this->teller_tab) == trim($menuItem['id'])) text-white @else icon-color  @endif" >{{ $menuItem['label'] }}</span>
                    </button>

                @endforeach



            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            @if($this->teller_tab==1)
            <livewire:profile-setting.organization-setting/>
            @endif
            @if($this->teller_tab==2)
                <livewire:profile-setting.leader-ship />
            @endif

            @if($this->teller_tab==3)
            <livewire:profile-setting.end-of-day />
            @endif
            @if($this->teller_tab==5)
                    <livewire:profile-setting.divident />
            @endif

        </div>
    </div>
</div>
