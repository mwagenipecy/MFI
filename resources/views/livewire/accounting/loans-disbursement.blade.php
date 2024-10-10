





<div>

    @if(session()->has('reject_loan'))
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

                        <div class="mb-4">
                            <h5 >
                                <title>Warning: Action Required</title> <!-- Description added for accessibility -->
                            </h5>
                        </div>

                    </div>


                    <div class="flex flex-col justify-center items-center">
                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="red" class="w-12 h-12" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                        </svg>
                        <span class="text-red-600 mt-2 mb-4 "> Are you sure you want to reject this loan ? </span> <!-- Added text description below the icon -->
                      </div>


                </div>

                <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                    <button type="button" wire:click="close" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                        Cancel
                    </button>
                    <button type="submit" wire:click="reject" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-500 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                        Proceed
                    </button>
                </div>

            </div>
        </div>
    </div>

@endif







    @if(session()->has('loan_id'))
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

                        <div class="mb-4">
                            <h5 >
                               Loan Disbursement
                            </h5>
                        </div>


@php


                    $charges=[];

                    $charge_ids=DB::table('loan_has_charges')->where('loan_id',session('loan_id'))->pluck('charge_id')->toArray();

                    $charges=DB::table('charges')->whereIn('id',$charge_ids)->get();

                    $loan= DB::table('loans')->where('id',session('loan_id'))->first();

                    $loan_amount= $loan->principle;

                    $total_percent= DB::table('charges')
                    ->where("charge_type","percentage")->whereIn('id',$charge_ids)->sum('percentage_charge_amount');
                    $fixed_charges=
                    DB::table('charges')->where("charge_type","fixed")->whereIn('id',$charge_ids)->sum('flat_charge_amount');
                    $total_charger= $total_percent*$loan_amount/100 + $fixed_charges;


                    $take_home= $loan_amount- $total_charger;







   @endphp

                            <div >
                                <!-- Name -->
                                <div class="container mx-auto">
                                    <table class="table-auto border-collapse border border-gray-400 w-full">
                                        <!-- Table Head -->
                                        <thead>
                                            <tr>
                                                <th class="border border-gray-400 px-4 py-2 bg-gray-100"> Attribute</th>
                                                <th colspan="2" class="border border-gray-400 px-4 py-2 bg-gray-100"> Params  </th>

                                            </tr>
                                        </thead>
                                        <!-- Table Body -->
                                    <tbody>

                                             <tr>
                                                <th class="border border-gray-400 px-4 py-2 bg-gray-100"> Loan Amount  </th>
                                                <th colspan="2" class="border border-gray-400 px-4 py-2 bg-gray-100"> {{ number_format($loan_amount,2)}}  TZS </th>
                                            </tr>

                                    <tr>
                                        <td  class="border border-gray-400 px-4 py-2"> Charges   </td>
                                        <td  class="border border-gray-400 px-4 py-2"> Name   </td>
                                                <td  class="border border-gray-400 px-4 py-2"> Amount(TZS)   </td>
                                         </tr>



                             @foreach($charges as $charge)
                                       <tr>
                                               <td> </td>
                                                <td class="border border-gray-400 px-4 py-2"> {{ $charge->charge_name}}  </td>
                                        <td class="border border-gray-400 px-4 py-2">

                                      @if($charge->charge_type=="fixed")
                                       {{ number_format($charge->flat_charge_amount,2)}}

                                      @elseif($charge->charge_type=="percentage")

                                      {{  number_format( (($charge->percentage_charge_amount *  $loan_amount )/100  ),2) }}

                                  @endif


                                </td>
                              </tr>
                             @endforeach

                                    <tr>
                                               <td>  </td>
                                                <td class="border border-gray-400 px-4 py-2"> Total Charges </td>
                                                <td clospan="2"  class="border border-gray-400 px-4 py-2"> {{number_format($total_charger,2) }} </td>
                                            </tr>
                                    <tr>
                            <td class="border border-gray-400 bg-gray-100  px-4 py-2"> Take Home </td>
                                                <td colspan="2"  class="border bg-gray-100 border-gray-400 px-4 py-2">{{ number_format($take_home,2)}} TZS</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- Add more form fields as needed -->
                <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                    <button type="button" wire:click="close" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                        Cancel
                    </button>
                    <button type="submit" wire:click="approve" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                        Proceed
                    </button>
                </div>
            </div>
        </div>
    </div>

@endif




    <div class="w-full" >
        <div class="w-fit bg-gray-200 rounded-lg pl-1 pr-1 pt-1 pb-1 m-1">
            <livewire:accounting.loans-table/>
        </div>
    </div>


</div>


