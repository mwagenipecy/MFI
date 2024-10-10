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
       $this->charges= $this->culculateCharges($query->pluck('id'));

        return view('livewire.accounting.disbursement');
    }



    function culculateCharges($loan_id){

        $amount=0;
        foreach($loan_id as $id){

            $principle=DB::table('loans')->where('id',$id)->value('principle');

            $charger_ids=DB::table('loan_has_charges')->where('loan_id', $id)->pluck('charge_id')->toArray();

            $charges=DB::table('charges')->whereIn('id',$charger_ids)->get();



            foreach($charges as $charge){

                if( $charge->percentage_charge_amount==null){
                    $amount=$charge->flat_charge_amount;
                 }else{

                    $amount=$charge->percentage_charge_amount * $principle /100 ;
                 }

                 $amount=$amount+$amount;
            }



        }

        return $amount;

    }
}
