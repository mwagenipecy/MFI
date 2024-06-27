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
use Illuminate\Support\Facades\Session;



class NewProduct extends Component
{


    public $sub_product_name;
    public $prefix;
    public $productStatus;
    public $currency;
    public $currencies;
    public $deposit;
    public $deposit_charge;
    public $deposit_charge_min_value;
    public $deposit_charge_max_value;
    public $withdraw;
    public $withdraw_charge;
    public $withdraw_charge_min_value;
    public $withdraw_charge_max_value;
    public $interest_value;
    public $interest_tenure;
    public $maintenance_fees;
    public $profit_account;
    public $inactivity;
    public $create_during_registration;
    public $activated_by_lower_limit;
    public $requires_approval;
    public $generate_atm_card_profile;
    public $allow_statement_generation;
    public $send_notifications;
    public $require_image_member;
    public $require_image_id;
    public $require_mobile_number;
    public $number_of_accounts;
    public $total_value_of_accounts;
    public $profits;
    public $notes;
    public $interest;
    public $ledger_fees;
    public $ledger_fees_value;
    public $maintenance_fees_value;
    public $product_id;
    public $generate_mobile_profile;


    public $total_shares;
    public $shares_per_member;
    public $nominal_price;
    public $available_shares;


    protected $rules = [
        'product_name'=> 'required|min:3',
        'currency'=> 'required|min:2',
        'notes'=> 'required|min:2',
    ];

    public function mount($product_id){
        $this->currency = 1;  // make this dynamic
        //$this->product_id = $product_id;
        $this->product_id = Session::get('ProductID','');
    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();



        approvals::create([
            'institution' => "",
            'process_name' => 'createBranch',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ''
        ]);

    }

    public function render()
    {
        $this->currencies = Currencies::get();
        return view('livewire.products-management.new-product');
    }

    public function saveNewSubProduct(){

        //dd('jj');
        $idp = sub_products::create([

            "generate_mobile_profile" => $this->generate_mobile_profile,
            "product_name" => "",
            "product_id" => $this->product_id,
            "sub_product_name" => $this->sub_product_name,
            "sub_product_id" => $this->product_id.str_pad(rand(00,99),2,'0',STR_PAD_LEFT),
            "sub_product_status" => false,
            "currency" => $this->currency,
            "deposit" => $this->deposit,
            "deposit_charge" => $this->deposit_charge,
            "deposit_charge_min_value" => $this->deposit_charge_min_value,
            "deposit_charge_max_value" => $this->deposit_charge_max_value,
            "withdraw" => $this->withdraw,
            "withdraw_charge" => $this->withdraw_charge,
            "withdraw_charge_min_value" => $this->withdraw_charge_min_value,
            "withdraw_charge_max_value" => $this->withdraw_charge_max_value,
            "interest_value"=> $this->interest_value,
            "interest_tenure" => $this->interest_tenure,
            "maintenance_fees" => $this->maintenance_fees,
            "profit_account" => $this->profit_account,
            "inactivity" => $this->inactivity,
            "create_during_registration" => $this->create_during_registration,
            "activated_by_lower_limit" => $this->activated_by_lower_limit,
            "requires_approval"=> $this->requires_approval,
            "generate_atm_card_profile" => $this->generate_atm_card_profile,
            "allow_statement_generation" => $this->allow_statement_generation,
            "send_notifications" => $this->send_notifications,
            "require_image_member"=> $this->require_image_member,
            "require_image_id" => $this->require_image_id,
            "require_mobile_number" => $this->require_mobile_number,
            "notes" => $this->notes,
            "interest" => $this->interest,
            "ledger_fees" => $this->ledger_fees,
            "ledger_fees_value"=> $this->ledger_fees_value,
            "maintenance_fees_value"=> $this->maintenance_fees_value,

            "total_shares" => $this->total_shares,
            "shares_per_member"=> $this->shares_per_member,
            "nominal_price"=> $this->nominal_price,
            "available_shares"=> $this->available_shares,
        ])->id;

        //Session::flash('message', 'A new user has been successfully created!');
        //Session::flash('alert-class', 'alert-success');
        $this->sendApproval($idp,'has created a new product','13');

        $this->emit('refreshProductListComponent');

    }
}
