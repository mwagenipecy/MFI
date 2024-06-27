<?php

namespace App\Http\Livewire\ProductsManagement;

use Livewire\Component;
use App\Models\sub_products;
use App\Models\Currencies;

use Illuminate\Support\Facades\Auth;
use App\Models\approvals;
use App\Models\TeamUser;



class ProductDataLoader extends Component
{

    public $sub_product_id;


    public $sub_product_name;
    public $prefix;
    public $sub_product_status;
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
    public $number_of_accounts = 0;
    public $total_value_of_accounts = 0;
    public $profits = 0;
    public $notes;
    public $interest = false;
    public $ledger_fees;
    public $ledger_fees_value;
    public $maintenance_fees_value;
    public $idx;
    public $generate_mobile_profile;

    public $total_shares;
    public $shares_per_member;
    public $nominal_price;
    public $available_shares;



    public function mount($sub_id)
    {
        $this->idx = $sub_id;
        $sub_products = sub_products::where('id',$this->idx )->get();
        foreach ($sub_products as $sub_product){

            $this->sub_product_name = $sub_product->sub_product_name;
            $this->sub_product_status= $sub_product->sub_product_status;
            $this->currency= $sub_product->currency;
            $this->deposit = $sub_product->deposit;
            $this->deposit_charge= $sub_product->deposit_charge;
            $this->deposit_charge_min_value= $sub_product->deposit_charge_min_value;
            $this->deposit_charge_max_value= $sub_product->deposit_charge_max_value;
            $this->withdraw = $sub_product->withdraw;
            $this->withdraw_charge= $sub_product->withdraw_charge;
            $this->withdraw_charge_min_value= $sub_product->withdraw_charge_min_value;
            $this->withdraw_charge_max_value= $sub_product->withdraw_charge_max_value;
            $this->interest_value= $sub_product->interest_value;
            $this->interest_tenure= $sub_product->interest_tenure;
            $this->maintenance_fees= $sub_product->maintenance_fees;
            $this->profit_account= $sub_product->profit_account;
            $this->inactivity= $sub_product->inactivity;
            $this->create_during_registration= $sub_product->create_during_registration;
            $this->activated_by_lower_limit= $sub_product->activated_by_lower_limit;
            $this->requires_approval= $sub_product->requires_approval;
            $this->generate_atm_card_profile= $sub_product->generate_atm_card_profile;
            $this->allow_statement_generation= $sub_product->allow_statement_generation;
            $this->send_notifications= $sub_product->send_notifications;
            $this->require_image_member= $sub_product->require_image_member;
            $this->require_image_id= $sub_product->require_image_id;
            $this->require_mobile_number= $sub_product->require_mobile_number;
            $this->notes= $sub_product->notes;
            $this->interest = $sub_product->interest;
            $this->ledger_fees= $sub_product->ledger_fees;
            $this->ledger_fees_value= $sub_product->ledger_fees_value;
            $this->maintenance_fees_value= $sub_product->maintenance_fees_value;
            $this->generate_mobile_profile= $sub_product->generate_mobile_profile;

            $this->total_shares= $sub_product->total_shares;
            $this->shares_per_member= $sub_product->shares_per_member;
            $this->nominal_price= $sub_product->nominal_price;
            $this->available_shares= $sub_product->available_shares;



        }

    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createBranch',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);

    }

    public function updated(){

            $affectedRows = sub_products::where('id',$this->idx)->update(
            [
                "sub_product_name" => $this->sub_product_name,
                "sub_product_status"=> $this->sub_product_status,
                "currency"=> $this->currency,
                "deposit" => $this->deposit,
                "deposit_charge"=> $this->deposit_charge,
                "deposit_charge_min_value"=> $this->deposit_charge_min_value,
                "deposit_charge_max_value"=> $this->deposit_charge_max_value,
                "withdraw" => $this->withdraw,
                "withdraw_charge"=> $this->withdraw_charge,
                "withdraw_charge_min_value"=> $this->withdraw_charge_min_value,
                "withdraw_charge_max_value"=> $this->withdraw_charge_max_value,
                "interest_value"=> $this->interest_value,
                "interest_tenure"=> $this->interest_tenure,
                "maintenance_fees"=> $this->maintenance_fees,
                "profit_account"=> $this->profit_account,
                "inactivity"=> $this->inactivity,
                "create_during_registration"=> $this->create_during_registration,
                "activated_by_lower_limit"=> $this->activated_by_lower_limit,
                "requires_approval"=> $this->requires_approval,
                "generate_atm_card_profile"=> $this->generate_atm_card_profile,
                "allow_statement_generation"=> $this->allow_statement_generation,
                "send_notifications"=> $this->send_notifications,
                "require_image_member"=> $this->require_image_member,
                "require_image_id"=> $this->require_image_id,
                "require_mobile_number"=> $this->require_mobile_number,
                "notes"=> $this->notes,
                "interest" => $this->interest,
                "ledger_fees"=> $this->ledger_fees,
                "ledger_fees_value"=> $this->ledger_fees_value,
                "maintenance_fees_value"=> $this->maintenance_fees_value,
                "generate_mobile_profile"=> $this->generate_mobile_profile,

                "total_shares" => $this->total_shares,
                "shares_per_member"=> $this->shares_per_member,
                "nominal_price"=> $this->nominal_price,
                "available_shares"=> $this->available_shares,

            ]
        );

        //$this->emit('refreshProductListComponent');
        $this->sendApproval($this->idx,'has created a new product','13');
    }

    public function render()
    {
        $this->currencies = Currencies::get();
        return view('livewire.products-management.product-data-loader');
    }
}
