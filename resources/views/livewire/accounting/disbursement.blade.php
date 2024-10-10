<div>
    <div class="w-full">

        <section class=" relative">
            <div class="w-full max-w-7xl mb-4 md:px-2 lg-6 mx-auto">
                <div class="flex items-start flex-col gap-4 xl:flex-row ">
                    <div class="w-full max-w-sm md:max-w-3xl xl:max-w-sm flex items-start flex-col gap-8 max-xl:mx-auto">
                        <div class="p-2 border-2 rounded-lg border-red-500  w-full group transition-all duration-500 hover:border-gray-400 ">
                            <div
                                class=" flex font-manrope font-semibold text-base leading-20 text-black pb-2 border-b  border-gray-200 ">
                                Disbursement Summary -   <div class="text-red-500 mx-4  pb-2 ">  {{ now()->format('Y-M-d') }} </div>
                        </div>
                            <div class="data py-2 border-b border-gray-200">
                                <div class="flex items-center justify-between  mx-4 mb-5">
                                    <p class="font-normal text-lg leading-8 text-gray-400 transition-all duration-500 group-hover:text-gray-700">Total principle </p>
                                    <p class="font-medium text-lg leading-8 text-gray-900"> {{ number_format($principle,2 ) }}  TZS</p>
                                </div>
                                <div class="flex items-center justify-between  mx-4  mb-5">
                                    <p class="font-normal text-lg leading-8 text-gray-400 transition-all duration-500 group-hover:text-gray-700">Total Charges </p>
                                    <p class="font-medium text-lg leading-8 text-red-600">{{ number_format($charges,2) }}   TZS </p>
                                </div>
                                <div class="flex items-center justify-between mx-4 ">
                                    <p class="font-normal text-lg leading-8 text-gray-400 transition-all duration-500 group-hover:text-gray-700 "> Applications </p>
                                    <p class="font-medium text-lg leading-8 text-emerald-500"> {{ $applications  }}   </p>
                                </div>
                            </div>
                            <div class="total flex items-center justify-between  mx-4 ">
                                <p class="font-normal  leading-8 text-black "> Amount Payable  </p>
                                <h5 class="font-manrope font-bold text-xl leading-9 text-indigo-600"> {{ number_format( ($principle -$charges ),2) }} TZS </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>


<div class=" overflow-x-auto flex w-full">
    <livewire:accounting.disbursement-table/>


</div>



</div>
