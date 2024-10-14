<?php

namespace App\Http\Livewire\Accounting;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\issured_shares;
use App\Models\LoansModel;
use App\Models\BranchesModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisbursementTable extends LivewireDatatable
{

    public $exportable=true;

    public function builder()
    {

        $query = LoansModel::query()->where('status','ACTIVE')->whereDate('updated_at',Carbon::today());
        return $query;
    }


    public function columns(): array
    {
        $html ='';

            return [

                Column::name('updated_at')->label('disbursement date')->searchable(),

                Column::callback(['member_id'], function ($member_number) {

                    //return $member_number;
                    return DB::table('members')->where('id',$member_number)->value('first_name').' '.DB::table('members')->where('id',$member_number)->value('middle_name').' '.DB::table('members')->where('id',$member_number)->value('last_name');
                })->label('Member name'),

                Column::callback('principle',function($amount){
                    return number_format($amount,2);
                })->label('Loan Amount'),
                Column::callback(['id', 'principle', 'created_at'], function ($id, $principle, $date) {

                    $charge_ids = DB::table('loan_has_charges')->where('loan_id', $id)->pluck('charge_id')->toArray();

                    $charges = DB::table('charges')->whereIn('id', $charge_ids)->get();

                    $amount = 0;

                    foreach($charges as $charge) {
                        if ($charge->percentage_charge_amount === null) {
                            // Add flat charge
                            $amount += $charge->flat_charge_amount;
                        } else {
                            // Calculate and add percentage charge based on the principle
                            $amount += ($charge->percentage_charge_amount * $principle) / 100;
                        }
                    }

                    return number_format($amount, 2); // Format amount to 2 decimal places
                })->label('Total Charges'),

                Column::callback(['id', 'principle'], function ($id, $principle) {

                    $charge_ids = DB::table('loan_has_charges')->where('loan_id', $id)->pluck('charge_id')->toArray();

                    $charges = DB::table('charges')->whereIn('id', $charge_ids)->get();

                    $total_charges = 0;

                    foreach($charges as $charge) {
                        if ($charge->percentage_charge_amount === null) {
                            // Add flat charge
                            $total_charges += $charge->flat_charge_amount;
                        } else {
                            // Calculate and add percentage charge based on the principle
                            $total_charges += ($charge->percentage_charge_amount * $principle) / 100;
                        }
                    }

                    // Subtract total charges from principle to get amount payable
                    $amount_payable = $principle - $total_charges;

                    return number_format($amount_payable, 2); // Format to 2 decimal places
                })->label('Amount Payable'),



                Column::callback(['branch_id'], function ($branch_id) {

                    return BranchesModel::where('id',$branch_id)->value('name');
                })->label('Branch'),

                Column::name('pay_method')->label('disbursement method')->searchable(),

                Column::name('bank_account_number')->label('bank account number')->searchable(),


            ];

        }




}
