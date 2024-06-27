<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\BranchesModel;
use App\Models\MembersModel;
use App\Models\loans_schedules;
use App\Models\LoansModel;
use Carbon\Carbon;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LoanUpdate extends LivewireDatatable
{

    protected $listeners=['refreshLoanUpdateTable'=>'$refresh'];
    public function builder()
    {

        // get loan id
       // dd(auth()->user()->employeeId);
       // $employeeId='';



        // get yesterday's date
        $yesterday=Carbon::yesterday()->format('Y-m-d');

        // Get today's date in 'Y-m-d' format
        $today = Carbon::today()->format('Y-m-d');



      // Get tomorrow's date in 'Y-m-d' format
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

     // Get the day after tomorrow's date in 'Y-m-d' format
        $dayAfterTomorrow = Carbon::tomorrow()->addDay()->format('Y-m-d');

        if(auth()->user()->employeeId){
            $loanId=LoansModel::where('supervisor_id',auth()->user()->employeeId)->pluck('loan_id');

     // Query to get records where the date is today, tomorrow, or day after tomorrow
        $loanSchedule = loans_schedules::query()->whereIn('loan_id',$loanId)->
              whereDate('installment_date', $today)
            ->orWhereDate('installment_date', $tomorrow)
            ->orWhereDate('installment_date', $yesterday)
            ->orWhereDate('installment_date', $dayAfterTomorrow)
            ->orWhereDate('promise_date', $today)
                ->orWhereDate('promise_date', $tomorrow)
                ->orWhereDate('promise_date', $yesterday)
                ->orWhereDate('promise_date', $dayAfterTomorrow)
            ->orderBy('installment_date','ASC');
        }
        else{



        // Query to get records where the date is today, tomorrow, or day after tomorrow
        $loanSchedule = loans_schedules::query()-> whereDate('installment_date', $today)
            ->orWhereDate('installment_date', $tomorrow)
            ->orWhereDate('installment_date', $yesterday)
            ->orWhereDate('installment_date', $dayAfterTomorrow)->orderBy('installment_date','ASC');
        }

        return  $loanSchedule;
    }

    public function columns(): array
    {



            return [

//
//                Column::callback('member_number', function ($member_number) {
//                    //$member_number=LoansModel::where('loan_id',$member_number)->value('member_number');
//                    return MembersModel::where('member_number', $member_number)->value('first_name') . ' ' . MembersModel::where('member_number', $member_number)->value('middle_name') . ' ' . MembersModel::where('member_number', $member_number)->value('last_name');
//                })->label('Member name'),
//
//                Column::callback(['member_number','id'], function ($member_number,$id) {
//                    //$member_number=MembersModel::where('loan_id',$member_number)->value('member_number');
//                 return MembersModel::where('member_number',$member_number)->value('phone_number');
//                })->label('contacts'),


Column::callback('loan_id', function ($loan_id) {
    // Query member number from LoansModel based on loan_id
    $member_number = LoansModel::where('loan_id', $loan_id)->value('member_number');

    // Query member name from MembersModel based on member_number
    $member_name = MembersModel::where('member_number', $member_number)
        ->select('first_name', 'middle_name', 'last_name')
        ->first();

    // Check if member name is found
    if ($member_name) {
        // Concatenate first name, middle name, and last name
        $full_name = $member_name->first_name . ' ' . $member_name->middle_name . ' ' . $member_name->last_name;
        return $full_name;
    } else {
        return 'Member name not found';
    }
})->label('Member name'),

Column::callback(['loan_id','id'], function ($loan_id,$id) {
    // Query member number from LoansModel based on loan_id
    $member_number = LoansModel::where('loan_id', $loan_id)->value('member_number');

    // Query phone number from MembersModel based on member_number
    $phone_number = MembersModel::where('member_number', $member_number)->value('phone_number');

    // Check if phone number is found
    if ($phone_number) {
        return $phone_number;
    } else {
        return 'Phone number not found';
    }
})->label('contacts'),



                Column::callback(['installment_date','installment','payment'],function ($date,$installment,$payment){

                    $payment=(double)$payment;
                    $installment=(double)$installment;
                    $date = Carbon::parse($date);
                   if(round($payment,2)>= round($installment,2)){
                       return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-orange-500"> '.$date->format('Y-m-d').'- Paid </div>';

                   }else{
                        $date=Carbon::parse($date);
                       if($date->isToday()){
                           return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-yellow-500"> '.$date->format('Y-m-d').'   - Today </div>';                       }
                       if($date < Carbon::today()){
                           $today=Carbon::today();
                           $daysDif=$date->diffInDays($today);
                           if($daysDif==1){
                              $x=" - Yesterday";
                           }elseif($daysDif==2){
                               $x=" - Day Before yesterday";
                           }else{
                               $x='';
                           }
                           return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-red-500"> '.$date->format('Y-m-d').' '  .$x.' </div>';

                       }
                       if($date > Carbon::today()){

                           $today=Carbon::today();
                           $daysDif=$date->diffInDays($today);
                           if($daysDif==1){
                               return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-purple-500"> '.$date->format('Y-m-d').' -  Tomorrow  </div>';

                           }elseif($daysDif==2){
                               return '<div class=" p-2 rounded-lg text-align-center item-center bg-green-500"> '.$date->format('Y-m-d').' - Day After Tomorrow </div>';

                           }else{
                               return '<div class=" p-2 rounded-lg text-align-center item-center bg-green-500"> '.$date->format('Y-m-d').'  </div>';

                           }


                       }






                   }

                })->label('Installment date')->searchable(),

                Column::name('comment')->label('officer comment'),
                Column::callback('promise_date',function ($date){
                   if($date==null){

                   }else {


                       $date = Carbon::parse($date);
                       if ($date->isToday()) {
                           return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-yellow-500"> ' . $date->format('Y-m-d') . '   - Today </div>';
                       }

                       if ($date < Carbon::today()) {
                           $today=Carbon::today();
                           $daysDif=$date->diffInDays($today);
                           if($daysDif==1){
                               $x=" - Yesterday";
                           }elseif($daysDif==2){
                               $x=" - Day Before yesterday";
                           }else{
                               $x='';
                           }
                           return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-red-500"> '.$date->format('Y-m-d').' '  .$x.' </div>';

                       }
                       if ($date > Carbon::today()) {
                           $today=Carbon::today();
                           $daysDif=$date->diffInDays($today);
                           if($daysDif==1){
                               return '<div class=" p-2 rounded-lg flex text-align-center item-center bg-purple-500"> '.$date->format('Y-m-d').' -  Tomorrow  </div>';

                           }elseif($daysDif==2){
                               return '<div class=" p-2 rounded-lg text-align-center item-center bg-green-500"> '.$date->format('Y-m-d').' - Day After Tomorrow </div>';

                           }else{
                               return '<div class=" p-2 rounded-lg text-align-center item-center bg-green-500"> '.$date->format('Y-m-d').'  </div>';

                           }                       }
                   }
                })->label('promise date'),


                Column::callback('installment',function ($installment){
                    return number_format($installment,2);
                })->label('amount (TZS)'),
                Column::callback('payment',function ($amount){
                    if($amount){
                        return number_format($amount,2);
                    }
                    else{
                        return 0.00;
                    }
                })->label('amount paid (TZS)'),

                Column::callback('id',function ($id){
                    $html='<button wire:click="edit('.$id.')" type="button" class="hoverable text-white bg-gray-100 hover:bg-blue-100 hover:text-blue focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center mr-2 dark:bg-blue-200 dark:hover:bg-blue-200 dark:focus:ring-blue-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
            </svg>
            <span class="hidden text-blue-800 m-2">Edit</span>
        </button>';


                    $loanId=LoansModel::where('supervisor_id',auth()->user()->employeeId)->pluck('loan_id');
                    if(is_array($loanId)){


                        return $html;
                    }else{
                        return null;
                    }




                })->label('action'),


            ];
        }

        public function edit($id){
        $this->emit('installmentPromises',$id);
        }

}
