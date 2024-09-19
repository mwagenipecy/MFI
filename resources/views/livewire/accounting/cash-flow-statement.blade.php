<div class="bg-white w-full p-4">
    <p class="text-xl font-bold">Cash Flow Statement : Operating Activities</p>
    <div class="bg-gray-100 w-full p-2 rounded-lg">
        <div class="bg-white w-full p-2 rounded-lg flex gap-4">

        <div class="w-1/2">



            @php
                $accountCodes = [

                    "Interest Income - Loans within Term" => 4010,
                    "Income from Fines or Penalties" => 4110,
                    "Membership Fees" => 4210,
                    "Transaction Charges" => 4215,
                    "Other Fees" => 4220,
                    "Profit from Banks (FDR)" => 4310,
                    "Profit from Government Bonds" => 4320,
                    "Profit from Other Investments" => 4330,
                    "Unconditional Grants" => 4430,
                    "Other Contributions" => 4450,
                    "Income from Written-Off Loans" => 4510,
                    "Other Association Income" => 4520
                ];

                // Initialize total sum
                $totalSum = 0;
            @endphp

            <div class="w-full flex justify-between mb-2">
                <p class="text-l font-bold">Cash Inflows:</p>
                <p class="text-l font-bold">Total Sum: {{ $totalSum }}</p>
            </div>
            <hr class="mb-2">

            @if(count($accountCodes) > 0)
                <table border="1" class="w-full">

                    <tbody class="w-full">
                    @foreach($accountCodes as $accountName => $accountCode)
                        @php
                            // Retrieve the account balance from the database
                            $accountBalance = \Illuminate\Support\Facades\DB::table('accounts')
                                ->where('sub_category_code', $accountCode)
                                ->value('balance');

                            // Handle the case where the account code does not exist
                            if ($accountBalance === null) {
                                $accountBalance = 'N/A';
                            } else {
                                // Add to the total sum
                                $totalSum += $accountBalance;
                            }
                        @endphp

                        <tr class="w-full">
                            <td>{{ $accountName }}</td>
                            <td class="w-full flex justify-end text-end " style="width: 100%; text-align: end;">

                                {{ number_format($accountBalance,2) }}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            @else
                <p>No accounts available.</p>
            @endif
        </div>

        <div class="w-1/2">

                @php

                    $expenseAccountCodes = [
                        "Bank Charges" => 5010,
                        "Interest on External Loans" => 5020,
                        "Interest on Member Deposit" => 5025,
                        "Interest on Member Savings" => 5030,
                        "Interest on Member Voluntary Shares" => 5035,
                        "Financial Insurance" => 5040,
                        "Other Financial Expenses" => 5050,
                        "Staff Salaries" => 5110,
                        "Social Security Contributions" => 5112,
                        "Payroll Taxes" => 5114,
                        "Staff Training" => 5116,
                        "Leave and Transfer" => 5118,
                        "Internal Travel Expenses" => 5122,
                        "Accrued Salary" => 5120,
                        "Back Pay" => 5124,
                        "Out of Hours Payments" => 5126,
                        "Employee Incentives" => 5128,
                        "Responsibility Allowance" => 5130,
                        "Housing Allowance" => 5132,
                        "Transport Allowance" => 5134,
                        "Medical Allowance" => 5136,
                        "Food Allowance" => 5138,
                        "Leave" => 5144,
                        "Sick Leave" => 5146,
                        "Other Benefits" => 5148,
                        "Stationery Expenses" => 5210,
                        "Committee Meeting Expenses" => 5212,
                        "Water and Electricity" => 5214,
                        "Various Contributions - Social" => 5216,
                        "Annual General Meeting Expenses" => 5218,
                        "Board Meeting Expenses" => 5220,
                        "Allowances for Sustenance" => 5222,
                        "Cleaning and Security" => 5224,
                        "Education and Training for Management, Committees, and Board" => 5226,
                        "Renovations" => 5228,
                        "Welcoming Costs" => 5230,
                        "Management Meetings" => 5232,
                        "Employee Welfare" => 5234,
                        "Vehicle Licensing and Registration" => 5236,
                        "Insurance Costs" => 5238,
                        "Fuel and Maintenance" => 5240,
                        "Transportation Costs" => 5242,
                        "Cooperative Events (ICUD, SUD, ACCOSCA)" => 5244,
                        "Postal, Telephone, Network, and Advertising" => 5246,
                        "Traveling Expenses for Temporary Workers" => 5248,
                        "Computer Maintenance" => 5250,
                        "Laborer Costs" => 5252,
                        "Other Expenses" => 5256,
                    ];



                    // Initialize total sum
                    $totalSum = 0;
                @endphp

            <div class="w-full flex justify-between mb-2">
                <p class="text-l font-bold">Cash Outflows:</p>
                <p class="text-l font-bold">Total Sum: {{ $totalSum }}</p>
            </div>
            <hr class="mb-2">

                @if(count($expenseAccountCodes) > 0)
                    <table border="1" class="w-full">

                        <tbody class="w-full">
                        @foreach($expenseAccountCodes as $accountName => $accountCode)
                            @php
                                // Retrieve the account balance from the database
                                $accountBalance = \Illuminate\Support\Facades\DB::table('accounts')
                                    ->where('sub_category_code', $accountCode)
                                    ->value('balance');

                                // Handle the case where the account code does not exist
                                if ($accountBalance === null) {
                                    $accountBalance = 'N/A';
                                } else {
                                    // Add to the total sum
                                    $totalSum += $accountBalance;
                                }
                            @endphp

                            <tr class="w-full">
                                <td>{{ $accountName }}</td>
                                <td class="w-full flex justify-end text-end " style="width: 100%; text-align: end;">

                                    {{ $accountBalance }}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                @else
                    <p>No accounts available.</p>
                @endif
            </div>


        </div>
    </div>


    <div class="h-16">

    </div>
    <p class="text-xl font-bold">Cash Flow Statement : Financing Activities</p>
    <div class="bg-gray-100 w-full p-2 rounded-lg">
        <div class="bg-white w-full p-2 rounded-lg flex gap-4">

            <div class="w-1/2">



                @php
                    $cashInflows = [
    "Member Deposits" => 2210,
    "Paid-Up Shares by Members" => 3010,
    "Shares for Special Projects - Current Year" => 3030,
    "Shares for Special Projects - Previous" => 3040,
    "Loans from Bank 1" => 2320,
    "Loans from Bank 2" => 2322,
    "Other Short-Term Loans" => 2330,
    "Loans from Bank 1 (Long-Term)" => 2420,
    "Loans from Bank 2 (Long-Term)" => 2422,
    "Other Long-Term Loans" => 2430,
    "Leasehold Payable" => 2450,
];

                    // Initialize total sum
                    $totalSum = 0;
                @endphp

                <div class="w-full flex justify-between mb-2">
                    <p class="text-l font-bold">Cash Inflows:</p>
                    <p class="text-l font-bold">Total Sum: {{ $totalSum }}</p>
                </div>
                <hr class="mb-2">

                @if(count($cashInflows) > 0)
                    <table border="1" class="w-full">

                        <tbody class="w-full">
                        @foreach($cashInflows as $accountName => $accountCode)
                            @php
                                // Retrieve the account balance from the database
                                $accountBalance = \Illuminate\Support\Facades\DB::table('accounts')
                                    ->where('sub_category_code', $accountCode)
                                    ->value('balance');

                                // Handle the case where the account code does not exist
                                if ($accountBalance === null) {
                                    $accountBalance = 'N/A';
                                } else {
                                    // Add to the total sum
                                    $totalSum += $accountBalance;
                                }
                            @endphp

                            <tr class="w-full">
                                <td>{{ $accountName }}</td>
                                <td class="w-full flex justify-end text-end " style="width: 100%; text-align: end;">

                                    {{ number_format($accountBalance,2) }}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                @else
                    <p>No accounts available.</p>
                @endif
            </div>

            <div class="w-1/2">

                @php

                    $cashOutflows = [
    "Dividends" => 5000,
    "Repayment of Loans" => 2001,
    "Leasehold Payments" => 2002,
];



                    // Initialize total sum
                    $totalSum = 0;
                @endphp

                <div class="w-full flex justify-between mb-2">
                    <p class="text-l font-bold">Cash Outflows:</p>
                    <p class="text-l font-bold">Total Sum: {{ $totalSum }}</p>
                </div>
                <hr class="mb-2">

                @if(count($cashOutflows) > 0)
                    <table border="1" class="w-full">

                        <tbody class="w-full">
                        @foreach($cashOutflows as $accountName => $accountCode)
                            @php
                                // Retrieve the account balance from the database
                                $accountBalance = \Illuminate\Support\Facades\DB::table('accounts')
                                    ->where('sub_category_code', $accountCode)
                                    ->value('balance');

                                // Handle the case where the account code does not exist
                                if ($accountBalance === null) {
                                    $accountBalance = 'N/A';
                                } else {
                                    // Add to the total sum
                                    $totalSum += $accountBalance;
                                }
                            @endphp

                            <tr class="w-full">
                                <td>{{ $accountName }}</td>
                                <td class="w-full flex justify-end text-end " style="width: 100%; text-align: end;">

                                    {{ $accountBalance }}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                @else
                    <p>No accounts available.</p>
                @endif
            </div>


        </div>
    </div>
</div>

