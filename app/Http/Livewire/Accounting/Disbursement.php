<?php

namespace App\Http\Livewire\Accounting;

use Livewire\Component;
use App\Models\LoansModel;
use App\Models\BranchesModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Disbursement extends Component
{
    public $principle;
    public $charges;
    public $applications;
    public function render()
    {
        $query = LoansModel::query()->where('status','ACTIVE')->whereDate('updated_at',Carbon::today());

       $this->principle= $query ->sum('principle');
       $this->applications=$query->count();
       $this->charges= $this->calculateCharges($query->pluck('id'));

        return view('livewire.accounting.disbursement');
    }






    function calculateCharges($loan_ids) {

        $total_amount = 0; // Initialize total amount

        foreach($loan_ids as $id) {

            $principle = DB::table('loans')->where('id', $id)->value('principle');

            $charge_ids = DB::table('loan_has_charges')->where('loan_id', $id)->pluck('charge_id')->toArray();

            $charges = DB::table('charges')->whereIn('id', $charge_ids)->get();

            $loan_amount = 0; // Initialize loan amount for each loan

            foreach($charges as $charge) {

                if ($charge->percentage_charge_amount === null) {
                    // Use flat charge if percentage is null
                    $loan_amount += $charge->flat_charge_amount;
                } else {
                    // Calculate percentage charge based on principle
                    $loan_amount += ($charge->percentage_charge_amount * $principle) / 100;
                }
            }

            // Add the loan's calculated charges to the total amount
            $total_amount += $loan_amount;
        }

        return $total_amount;
    }


}
