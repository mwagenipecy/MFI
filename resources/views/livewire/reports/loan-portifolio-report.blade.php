<div>




  <!-- Report Header -->
  <div class="mb-8 flex justify-between bg-red-50  ">
    <div class="p-4">
    <h1 class="text-3xl font-bold text-gray-800 uppercase ">Loan Portfolio Report</h1>
    <p class="text-lg text-gray-600">Report Date: <span class="font-semibold">October 2024</span></p>
    </div>

    <div class="p-4 ">
 {{-- icon --}}
 <svg data-slot="icon" class="rounded-full bg-white w-10 cursor-pointer h-10" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"></path>
  </svg>

    </div>
  </div>


  {{-- <div class="flex w-full gap-4 "> --}}

  <!-- Portfolio Summary -->
  <hr class="border-2 border-red-500 mx-2 ">


  <div class="bg-white rounded-lg p-2 mb-8">
    <h4 class="text-lg font-semibold uppercase mb-4">1. Portfolio Summary</h4>
    <table class="min-w-full table-auto">

        <thead class="bg-red-50">
            <tr>
              <th class="px-4 border py-2 text-left text-gray-600 font-medium"> Total Loans Disbursed </th>
              <th class="px-4 border py-2 text-left text-gray-600 font-medium"> Number of Active Loans </th>
              <th class="px-4 border py-2 text-left text-gray-600 font-medium">Total Outstanding Principal </th>
              <th class="px-4 border py-2 text-left text-gray-600 font-medium"> Total Repaid Loans </th>
              <th class="px-4 border py-2 text-left text-gray-600 font-medium"> Average Loan Size</th>
              <th class="px-4 border py-2 text-left text-gray-600 font-medium"> Loan Disbursement Rate (Monthly) </th>

            </tr>
          </thead>

      <tbody class="divide-y divide-gray-200 gap-2 p-2">
        <tr>
          <td class="py-2 border text-center  text-gray-600"> {{ number_format($loan_disbursement,2) }} TZS  </td>
          <td class="py-2 border text-center  text-gray-600 ">{{ $total_active_loan ?:0 }} </td>

          <td class="py-2 border text-center  text-gray-600 f"> {{ number_format($out_standing_amount,2 ) }} TZS </td>

          <td class="py-2 border text-center  text-gray-600 "> {{ number_format($total_repaid_amount,2) }} TZS</td>

          <td class="py-2 border text-center  text-gray-600 "> {{ number_format($loan_average_size,2) }} TZS</td>

          <td class="py-2 border  text-center  text-gray-600 "> 20 %  </td>
        </tr>

      </tbody>
    </table>
  </div>


  <!-- Loan Distribution by Loan Type -->
  <hr class="border-2 border-red-500 mx-2 ">

  <div class="bg-white  rounded-lg p-2 mb-8">
    <h4 class="text-lg font-semibold uppercase mb-4">2. Loan Distribution by Loan Type</h4>
    <table class="min-w-full table-auto">
      <thead class="bg-red-50">
        <tr>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Loan Type</th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Number of Loans</th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Total Amount Disbursed</th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Outstanding Amount</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach ($loan_product as $data)


        <tr>
          <td class="px-4 py-2 border text-gray-800"> {{ $data->sub_product_name }}</td>
          <td class="px-4 py-2  border text-gray-800"> {{ $data->loan_no }} </td>
          <td class="px-4 py-2border  text-gray-800"> {{ number_format($data->amount_disbursed ,2) }} TZS </td>
          <td class="px-4 py-2 border text-gray-800"> {{ number_format( $data->out_standing_amount,2) }}  TZS</td>
        </tr>

        @endforeach

      </tbody>
      <thead class="bg-red-50">
        <tr>
          <th class="  bg-white text-left text-gray-600 font-medium"> </th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium"> {{ $count }} </th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium"> {{ number_format( $amount,2) }} TZS </th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium"> {{ number_format($amount2,2) }} TZS </th>
        </tr>
      </thead>

    </table>
  </div>

  {{-- </div> --}}


  <!-- Loan Status Breakdown -->
  <hr class="border-2 border-red-500 mx-2 ">
  <div class="bg-white  rounded-lg p-2 mb-8">
    <h4 class="text-lg font-semibold uppercase mb-4">3. Loan Status Breakdown</h4>
    <table class="min-w-full table-auto">
      <thead class="bg-red-50">
        <tr>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Status</th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Number of Loans</th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium">Total Outstanding</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">

        @foreach ($loanStatusData as  $value)


        <tr>
          <td class="px-4 border py-2 text-gray-800"> {{ $value['label'] }}</td>
          <td class="px-4  border py-2 text-gray-800">{{$value['count']  }} </td>
          <td class="px-4 border py-2 text-gray-800">{{ number_format($value['principle'],2) }} </td>
        </tr>

        @endforeach


      </tbody>
      <tfoot class="bg-red-50">
        <tr>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium"> Total </th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium"> {{ $total_count }} </th>
          <th class="px-4 border py-2 text-left text-gray-600 font-medium"> {{number_format( $total_principle,2) }} TZS </th>
        </tr>
      </tfoot>

    </table>
  </div>





</div>
