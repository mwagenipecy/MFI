<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\BranchesModel;
use App\Models\general_ledger;
use App\Models\LoansModel;
use App\Models\sub_products;
use DateTime;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Repayment extends LivewireDatatable
{

    public $value;
    public $exportable=true;
    public $start_date;
    public $end_date;
    public $sortByBranch;

  public function builder(){

    $member_numbers=DB::table('members')->pluck('id')->toArray();

    $accounts=DB::table('accounts')->whereIn('member_number',$member_numbers)->pluck('account_number')->toArray();

    return general_ledger::query()
    ->leftJoin('accounts', 'general_ledger.record_on_account_number', '=', 'accounts.account_number')
         ->where('accounts.account_use', 'external')

    ;



}


public function columns()
{
    return [
        column::name('created_at')->label('issue date'),
        // column::name('loan_id')->label(label: 'id'),
        column::callback(['general_ledger.loan_id','accounts.account_name'],function($loan_number,$member_no){

            return $member_no;
            // $member= DB::table('members')->where('id',$member_no)->first();
            // return $member ?->first_name.' '. $member ?->middle_name.'  '. $member ?->last_name .'('.$loan_number.')';

        })->label('account number'),

        column::callback('accounts.branch_number',function($branch_id){
            return BranchesModel::where('id',$branch_id)->value('name');
        })->label('branch'),
        column::callback('general_ledger.credit',function($principle){
            return number_format($principle);
        })->label('credit')->searchable(),

        column::callback('general_ledger.debit',function($principle){
            return number_format($principle);
        })->label('debit')->searchable(),


        column::name('general_ledger.narration')->label('description'),
        // column::name('tenure')->label('tenure'),
        // column::name('status')->label('status')


    ];

    // TODO: Change the autogenerated stub
}


}