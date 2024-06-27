<?php

namespace App\Http\Livewire\ProductsManagement;

use Livewire\Component;

use App\Models\sub_products;
use App\Models\Currencies;

use App\Models\Loan_sub_products;
use App\Models\AccountsModel;
use App\Models\Charges;

use Illuminate\Support\Facades\Auth;
use App\Models\approvals;
use App\Models\TeamUser;


class LoanProductDataLoader extends Component
{


    public $accounts;
    public $sub_product_name;
    public $prefix;
    public $sub_product_status;
    public $currency;
    public $disbursement_account;
    public $collection_account_loan_interest;
    public $collection_account_loan_principle;
    public $collection_account_loan_charges;
    public $collection_account_loan_penalties;
    public $principle_min_value;
    public $principle_max_value;
    public $min_term;
    public $max_term;
    public $interest_value;
    public $interest_tenure;
    public $principle_grace_period;
    public $interest_grace_period;
    public $interest_method;
    public $amortization_method;
    public $days_in_a_year;
    public $days_in_a_month;
    public $repayment_strategy;
    public $maintenance_fees_value;
    public $repayment_frequency;
    public $ledger_fees;
    public $has_partner;
    public $ledger_fees_value;
    public $lock_guarantee_funds;
    public $charge_type = 'fixed';
    public $charge_name;
    public $charge_amount;
    public $charge_percent;
    public $maintenance_fees;
    public $inactivity;

    public $requires_approval;

    public $allow_statement_generation;
    public $send_notifications;
    public $require_image_member;
    public $require_image_id;
    public $require_mobile_number;
    public $create_during_registration;
    public $notes;


    public $product_id;

// Inside your Livewire component class
    protected $listeners = ['mount'];

    public function refreshData()
    {
        // Logic to refresh component data
    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;


        approvals::create([
            'institution' => auth()->user()->institution_id,
            'process_name' => 'createLoanProduct',
            'process_description' => $msg,
            'approval_process_description' => ' has approved a loan product ',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);

    }


    public function mount($sub_id)
    {
        $this->idx = $sub_id;
        $sub_products = Loan_sub_products::where('id',$this->idx )->get();
        foreach ($sub_products as $sub_product){

            $this->sub_product_name= $sub_product->sub_product_name;
            $this->prefix= $sub_product->prefix;
            $this->sub_product_status= $sub_product->sub_product_status;
            $this->currency= $sub_product->currency;
            $this->has_partner= $sub_product->has_partner;
            $this->disbursement_account= $sub_product->disbursement_account;
            $this->collection_account_loan_interest= $sub_product->collection_account_loan_interest;
            $this->collection_account_loan_principle= $sub_product->collection_account_loan_principle;
            $this->collection_account_loan_charges= $sub_product->collection_account_loan_charges;
            $this->collection_account_loan_penalties= $sub_product->collection_account_loan_penalties;
            $this->principle_min_value= $sub_product->principle_min_value;
            $this->principle_max_value= $sub_product->principle_max_value;
            $this->min_term= $sub_product->min_term;
            $this->max_term= $sub_product->max_term;
            $this->interest_value= $sub_product->interest_value;
            $this->interest_tenure= $sub_product->interest_tenure;
            $this->principle_grace_period= $sub_product->principle_grace_period;
            $this->interest_grace_period= $sub_product->interest_grace_period;
            $this->interest_method= $sub_product->interest_method;
            $this->amortization_method= $sub_product->amortization_method;
            $this->days_in_a_year= $sub_product->days_in_a_year;
            $this->days_in_a_month= $sub_product->days_in_a_month;
            $this->repayment_strategy= $sub_product->repayment_strategy;
            $this->maintenance_fees_value= $sub_product->maintenance_fees_value;
            $this->ledger_fees= $sub_product->ledger_fees;
            $this->ledger_fees_value= $sub_product->ledger_fees_value;
            $this->lock_guarantee_funds= $sub_product->lock_guarantee_funds;
            $this->maintenance_fees= $sub_product->maintenance_fees;
            $this->inactivity= $sub_product->inactivity;
            $this->requires_approval= $sub_product->requires_approval;
            $this->allow_statement_generation= $sub_product->allow_statement_generation;
            $this->send_notifications= $sub_product->send_notifications;
            $this->require_image_member= $sub_product->require_image_member;
            $this->require_image_id= $sub_product->require_image_id;
            $this->require_mobile_number= $sub_product->require_mobile_number;
            $this->notes= $sub_product->notes;
            $this->product_id= $sub_product->product_id;





        }

    }



    function updatedPrincipleMinValue($amaunt)
    {
        $amaunt= (int)$amaunt;
        $this->principle_min_value= number_format($amaunt);

    }
    function updatedPrincipleMaxValue($amaunt)
    {$amaunt= (int)$amaunt;
        $this->principle_max_value= number_format($amaunt);

    }
    function updatedChargeAmount($amaunt)
    {
        $amaunt= (int)$amaunt;
        $this->charge_amount= number_format($amaunt);

    }

    function removeNumberFormat($amount)
    {
        return (float) str_replace(',', '', $amount);
    }

    public function updated(){

        $this->principle_min_value=$this->removeNumberFormat($this->principle_min_value);
        $this->principle_max_value=$this->removeNumberFormat($this->principle_max_value);
        $this->charge_amount=$this->removeNumberFormat($this->charge_amount);

        $affectedRows = Loan_sub_products::where('id',$this->idx)->update(
            [


                "sub_product_name" => $this->sub_product_name,
                "prefix" => $this->prefix,
                "sub_product_status" => $this->sub_product_status,
                "currency" => $this->currency,
                "disbursement_account" => $this->disbursement_account,
                "collection_account_loan_interest" => $this->collection_account_loan_interest,
                "collection_account_loan_principle" => $this->collection_account_loan_principle,
                "collection_account_loan_charges" => $this->collection_account_loan_charges,
                "collection_account_loan_penalties" => $this->collection_account_loan_penalties,
                "principle_min_value" => $this->principle_min_value,
                "principle_max_value" => $this->principle_max_value,
                "min_term" => $this->min_term,
                "max_term" => $this->max_term,
                "interest_value" => $this->interest_value,
                "interest_tenure"=> $this->interest_tenure,
                "principle_grace_period" => $this->principle_grace_period,
                "interest_grace_period" => $this->interest_grace_period,
                "interest_method" => $this->interest_method,
                "amortization_method" => $this->amortization_method,
                "days_in_a_year" => $this->days_in_a_year,
                "days_in_a_month" => $this->days_in_a_month,
                "repayment_strategy"=> $this->repayment_strategy,
                "maintenance_fees_value" => $this->maintenance_fees_value,
                "ledger_fees" => $this->ledger_fees,
                "ledger_fees_value" => $this->ledger_fees_value,
                "lock_guarantee_funds"=> $this->lock_guarantee_funds,
                "maintenance_fees" => $this->maintenance_fees,
                "inactivity"=> $this->inactivity,
                "requires_approval"=> $this->requires_approval,
                "allow_statement_generation" => $this->allow_statement_generation,
                "send_notifications" => $this->send_notifications,
                "require_image_member" => $this->require_image_member,
                "require_image_id" => $this->require_image_id,
                "require_mobile_number" => $this->require_mobile_number,
                "notes"=> $this->notes,
                "sub_product_status"=> "Pending",





            ]
        );

        //$this->emit('refreshProductListComponent');
        $this->sendApproval($this->idx,'has edited loan product information','13');
    }


    public function render()
    {

        $this->charges = Charges::get();
        $this->currencies = Currencies::get();
        $this->accounts = AccountsModel::where('account_use','internal')->get();
        return view('livewire.products-management.loan-product-data-loader');
    }

    public function saveCharge(){
        $id = Charges::create([

            "institution_number" => '1001',
            "branch_number" => "101",
            "charge_number" => "101",
            "charge_name" => $this->charge_name,
            "charge_type" => $this->charge_type,
            "flat_charge_amount" => $this->charge_amount,
            "percentage_charge_amount" => $this->charge_percent,

        ])->id;

        $this->sendApproval($id,'has edited loan product charges','14');
    }

    public function deleteCharge($id){
        Charges::where('id',$id)->delete();
        $this->sendApproval($id,'has deleted a loan product charge','14');
    }
}
