<?php

namespace App\Http\Livewire\ProductsManagement;

use Livewire\Component;
use App\Models\Loan_sub_products;
use App\Models\Currencies;
use App\Models\AccountsModel;
use App\Models\Charges;

use Illuminate\Support\Facades\Auth;
use App\Models\approvals;
use App\Models\TeamUser;




class NewLoanProduct extends Component
{

    public $accounts;
    public $sub_product_name;
    public $has_partner;
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


    protected $rules = [
        'sub_product_name'=> 'required|min:3|unique:loan_sub_products',
       // 'currency'=> 'required|min:2',
        'notes'=> 'required|min:2',
        "disbursement_account"=>'required',
            "collection_account_loan_interest"=>'required',
        "collection_account_loan_principle"=>'required'
    ];

    public function mount($product_id){// make this dynamic
        $this->product_id = $product_id;
    }


    public function sendApproval($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;


        approvals::create([
//            'institution' => $institution,
            'process_name' => 'createLanProduct',
            'process_description' => $msg,
            'approval_process_description' => auth()->user()->name.' has created new loan product ',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => "",
        ]);

    }

    public function sendApproval1($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;


        approvals::create([
//            'institution' => $institution,
            'process_name' => 'editLoanProduct',
            'process_description' => $msg,
            'approval_process_description' => 'has created new loan product ',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => "",
        ]);

    }

    public function sendApproval2($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;


        approvals::create([
//            'institution' => $institution,
            'process_name' => 'deleteLoanProduct',
            'process_description' => $msg,
            'approval_process_description' => 'has created new loan product ',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => "",
        ]);

    }


    public function render()
    {
        $this->charges = Charges::get();
        $this->currencies = Currencies::get();
        $this->accounts = AccountsModel::where('major_category_code',1000)->get();
        return view('livewire.products-management.new-loan-product');
    }

    public function saveNewSubProduct(){

         $this->validate();

        $idp = Loan_sub_products::create([
            "sub_product_id" => "104_".rand(0000,9999),
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
            'has_partner'=>$this->has_partner,
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
            "product_id"=> $this->product_id,
        ])->id;

        //Session::flash('message', 'A new user has been successfully created!');
        //Session::flash('alert-class', 'alert-success');
        $this->sendApproval($idp,'has created a new loan product','13');
        $this->emit('refreshProductListComponent');

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
        $this->sendApproval1($id,'has edited loan product charges','14');
    }

    public function deleteCharge($id){
        Charges::where('id',$id)->delete();
        $this->sendApproval2($id,'has deleted a loan product charge','14');
    }
}
