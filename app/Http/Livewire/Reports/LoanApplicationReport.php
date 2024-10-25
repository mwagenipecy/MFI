<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\issured_shares;
use App\Models\LoansModel;
use App\Models\BranchesModel;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use App\Models\loans_schedules;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class LoanApplicationReport extends LivewireDatatable
{

    public $exportable = true;

    public $value;
    public $start_date;
    public $end_date,$status,$aging,$branch;
    public $sortByBranch;
    public $exportStyles=false,$exportWidths=false;

    protected $listeners=['changeStatus','changeAging',
                       'changeStartDate','changeEndDate','changeBranch'];



    function changeEndDate($date){
        $this->end_date=$date;
    }
    function changeStartDate($date){
    $this->start_date=$date;
    }

    function changeBranch($branch){
        $this->branch=$branch;
        }

        function changeStatus($status){
            $this->status=$status;
            }

  public function builder(){

     $query=LoansModel::query();
     //->where('status','ACTIVE');

    if(!empty($this->start_date)){
        $query=$query->where('created_at','>=',$this->start_date);
        //->where('branch_id',session()->get('sortingBranch'));
    }

    if(!empty($this->end_date)){
       $query= $query->where('created_at','<=',$this->end_date);
       //->where('branch_id',session()->get('sortingBranch'));
    }


    if(!empty($this->branch)){
        $query= $query->where('branch_id',$this->branch);
     }

     if(!empty($this->status)){
        $query= $query->where('status',$this->status);
     }


     if(!empty($this->aging)){
        $query= $query->where('status',$this->aging);
     }

    // session()->put('summAmount',$query->sum('principle') );
     //session()->put('interest',$query->sum('interest') );

   return  $query;
}


    public function columns(): array
    {
        $html ='';

            return [

                Column::callback(['member_id'], function ($member_number) {

                    //return $member_number;
                    return DB::table('members')->where('id',$member_number)->value('first_name').' '.DB::table('members')->where('id',$member_number)->value('middle_name').' '.DB::table('members')->where('id',$member_number)->value('last_name');
                })->label('Member name'),

                Column::callback(['branch_id'], function ($branch_id) {

                    return BranchesModel::where('id',$branch_id)->value('name');
                })->label('Branch'),

                Column::name('loan_id')
                    ->label('loan id'),

                Column::name('loan_account_number')
                    ->label('loan account number'),
            column::callback('loan_sub_product',function($sub_product_id){
                return DB::table('loan_sub_products')->where('sub_product_id',$sub_product_id)->value('sub_product_name');
            })->label('product name')->filterable(DB::table('loan_sub_products')->pluck('sub_product_name', 'sub_product_id')->toArray()),

                Column::callback(['days_in_arrears'],function($days_in_arrears){
                    if($days_in_arrears >0){
                        return '<div class="bg-red-500 p-2 "> '.$days_in_arrears.' </div>';
                    }else{
                        return '<div class=" "> 0 </div>';
                    }
                })->label('past due days')->searchable(),


                Column::callback('principle',function ($principle){
                    return number_format($principle,2);
                })
                    ->label('principle (TZS)')->searchable(),

                Column::callback('interest',function ($interest){
                    return $interest .'%';
                })
                    ->label('interest'),

                Column::name('heath')
                    ->label('health'),

                Column::callback('supervisor_id',function($supervisor){
                    $employee=Employee::where('id',$supervisor)->first();
                    if($employee) {
                        return $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name;
                    }else{
                        return null;
                    }

                    })->label('Loan officer'),

                Column::name('loan_status')
                    ->label('Loan Type'),


                Column::callback('status',function ($status){

                    return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
                })->label('Status')->searchable(),


            ];


    }


}
