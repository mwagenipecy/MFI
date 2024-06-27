


<div class="w-full">
    <!-- message container -->


    <div class="w-full flex gap-2">
        <div class="w-1/4 ">

            <div  wire:click="setView(0)" class=" @if($this->currentView == 0) bg-red-100 @else bg-white @endif p-1 rounded-md w-full mb-1 cursor-pointer">

                <div class="flex items-center space-x-4">
                    <div class="h-8 w-8 flex items-center justify-center rounded-full bg-gray-500 text-white">
                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1">
                        <h3 class="text-sm font-medium">NEW PRODUCT</h3>
                        <div class="divide-x divide-gray-200 mt-auto">
                                                                    <span class="inline-block px-3 text-xs leading-none text-gray-400 font-normal first:pl-0">
                                                                        Create A New Product
                                                                    </span>
                        </div>
                    </div>
                </div>
            </div>

            @foreach(App\Models\Loan_sub_products::get() as $subProduct)


                <div  wire:click="setView({{$subProduct->id}})" class=" @if($this->currentView == $subProduct->id) bg-red-100 @else bg-white @endif p-1 rounded-md w-full mb-1 cursor-pointer">

                    <div class="flex items-center space-x-4">
                        <div class="h-8 w-8 flex items-center justify-center rounded-full bg-gray-500
                                                            text-white">{{$subProduct->id}}</div>
                        <div class="flex flex-col flex-1">
                            <h3 class="text-sm font-medium">{{$subProduct->sub_product_name}}</h3>
                            <div class="divide-x divide-gray-200 mt-auto">
                                                                    <span class="inline-block px-3 text-xs leading-none text-gray-400 font-normal first:pl-0">
                                                                        {{$subProduct->sub_product_name}}
                                                                    </span>
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach

        </div>

        <div class="w-3/4 bg-white rounded-md">

            @if($this->currentView > 0)

                <livewire:products-management.loan-product-data-loader :sub_id="$this->currentView"/>
            @else
                <livewire:products-management.new-loan-product :product_id="104" />
            @endif

        </div>
    </div>


</div>







