<?php

namespace App\Http\Livewire\BudgetManagement;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Budget extends Component
{
    public $tab_id=1;
    public $selectYear;

    public $setCapitalAccount=true;



    public $enableSetCapital;
    public $amount;
    public $account_id;


    function setCapitaModal ()
    {
        $this->enableSetCapital=true;
    }

    public function refreshComponent(){

        $this->emitTo('budget-management.all-budget','updateYear',$this->selectYear);
    }

    public function menuItemClicked($id){
        $this->tab_id=$id;
        if($id==2){
            $this->setCapitalAccount=false;
        }else{
            $this->setCapitalAccount=true;
        }
    }

    function setAccount()
    {
        $revenue_amount='';
        $capital_amount='';
        $organisition_settings=DB::table('institutions')->where('id',1)->first();



        if(!is_null($organisition_settings)){
            $revenue_amount=$organisition_settings->amount;
            $amount=$revenue_amount;
            $source_account_number=DB::table('accounts')->where('id',$organisition_settings->revenue_account)->value('account_number');
            $destination_account_number=DB::table('accounts')->where('id',$organisition_settings->operation_account)->value('account_number');


            $capital_amount=DB::table('main_budget')->where('year',$this->selectYear)->sum('total');



        if($revenue_amount >= $capital_amount){
            DB::beginTransaction();

            try{

                // credit the amount
                $reference_number=time();
                $prev_balance=DB::table('accounts')->where('account_number',$destination_account_number)->value('balance');
                $new_balance=(double)$prev_balance+$amount;

                // update the new blance
                DB::table('accounts')->where('account_number',$destination_account_number)->update(['balance',$new_balance]);
                // record on gl
                general_ledger::create([
                    'record_on_account_number'=> $destination_account_number,
                    'record_on_account_number_balance'=> $new_balance,
                    'sender_branch_id'=> auth()->user()->branh,
                    'beneficiary_branch_id'=> auth()->user()->branh,
                    'sender_product_id'=>  AccountsModel::where('account_number',$source_account_number)->value('product_number'),
                    'sender_sub_product_id'=> AccountsModel::where('account_number',$source_account_number)->value('sub_product_number'),
                    'beneficiary_product_id'=> AccountsModel::where('account_number',$destination_account_number)->value('product_number'),
                    'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$destination_account_number)->value('sub_product_number'),
                    'sender_id'=> 1,
                    'beneficiary_id'=> 1,
                    'sender_name'=> 1,
                    'beneficiary_name'=> 2,
                    'sender_account_number'=> $source_account_number,
                    'beneficiary_account_number'=> $destination_account_number,
                    'transaction_type'=> 'IFT',
                    'sender_account_currency_type'=> 'TZS',
                    'beneficiary_account_currency_type'=> 'TZS',
                    'narration'=> 'Payment for accounts issued',
                    'credit'=> $amount,
                    'debit'=> 0,
                    'reference_number'=> $reference_number,
                    'trans_status'=> 'Successful',
                    'trans_status_description'=> 'Successful',
                    'swift_code'=> '',
                    'destination_bank_name'=> '',
                    'destination_bank_number'=> null,
                    'payment_status'=> 'Successful',
                    'recon_status'=> 'Pending',
                ]);
                DB::table('institutions')->where('id',1)->update([
                    'status'=>'ACTIVE'
                ]);
                session()->flash('success_message','process  completed successfully');

                DB::commit();

            }catch (\Exception $e){
                DB::rollBack();

                return $e->getMessage();

                session()->flash('message_fail','something went wrong please recheck the budget');

            }


        }else{
            // revenue account

            session()->flash('message_fail','something went wrong please recheck the budget');
        }


    }
        else{

            session()->flash('message_fail','something went wrong please recheck the budget');

        }

    }
    public function boot(){
        $this->selectYear=Carbon::now()->year;
    }
    public function render()
    {
        return view('livewire.budget-management.budget');
    }
}
