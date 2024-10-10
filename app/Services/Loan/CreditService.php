<?php

namespace App\Services\Loan;

use App\Livewire\Accounting\Account;
use App\Models\Account as Accounts;
use App\Models\AccountsModel;
use App\Models\Activity;
use App\Models\general_ledger;
use App\Models\GeneralLedger;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class CreditService
{

    // credit only dest account

    public function makeTransaction($source_account, $amount, $destination_accounts, $narration)
    {
        DB::beginTransaction();
        try {
            $this->disburse($source_account, $amount, $destination_accounts, $narration);
            DB::commit();
            return "successfully ";
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }



    public function disburse($source_account, $amount, $destination_accounts, $narration)
    {
        // get source account details
        $reference_number = time();
        $accounts = AccountsModel::where("account_number", $source_account)->first();
        $destination_account = AccountsModel::where("account_number", $destination_accounts)->first();

        if ($accounts && $destination_account) {

            $destinantion_account_name = $destination_account->account_name;

            // credit
            $destination_account_prev_balance = $destination_account->balance;
            $destination_account_new_balance = (float) ($destination_account_prev_balance + $amount);
            // update account balance
            AccountsModel::where('account_number', $destination_account->account_number)->update(['balance' => $destination_account_new_balance]);

            $this->credit($reference_number, $source_account, $destination_accounts, $amount, $narration, $destination_account_new_balance, $accounts->account_name, $destinantion_account_name);

        }



}




    public function credit($reference, $source_account_number, $destination_account_number, $credit, $narration, $running_balance, $source_account_name, $destinantion_account_name)
    {


        /**
         * @var mixed prepare sender data
         */

        $sender_branch_id='';
        $sender_product_id='';
        $sender_sub_product_id='';
        $sender_id='';
        $sender_name='';


        $senderInfo=  DB::table('members')->where('member_number', DB::table('accounts')
                     ->where('account_number', $destinantion_account_name)->value('member_number'))->first();
        if($senderInfo){
             $accounts=DB::table('accounts')->where('account_number',$source_account_number)->first();
            $sender_branch_id=$senderInfo->branch_id;
            $sender_product_id=$accounts->category_code;
            $sender_sub_product_id=$accounts->sub_category_code;
            $sender_id=$senderInfo->client_number;
            $sender_name=$senderInfo->first_name.' '.$senderInfo->middle_name.' .'.$senderInfo->last_name;

        }

        //DEBIT RECORD MEMBER
         $beneficiary_branch_id='';
         $beneficiary_product_id='';
         $beneficiary_sub_product_id='';
         $beneficiary_id='';
         $beneficiary_name='';

        $receiverInfo= DB::table('members')->where('member_number', DB::table('accounts')
                      ->where('account_number', $destinantion_account_name)->value('client_number'))->first();
        if($receiverInfo){

            $accounts=DB::table('accounts')->where('account_number',$source_account_number)->first();
            $beneficiary_branch_id=$senderInfo->branch_id;
            $beneficiary_product_id=$accounts->category_code;
            $beneficiary_sub_product_id=$accounts->sub_category_code;
            $beneficiary_id=$senderInfo->client_number;
            $beneficiary_name=$senderInfo->first_name.' '.$senderInfo->middle_name.' '.$senderInfo->last_name;
        }


        general_ledger::create([
            'record_on_account_number' => $destination_account_number ? :0,
            'record_on_account_number_balance' => $running_balance ? :0,
            'sender_branch_id' =>$sender_branch_id  ? :0,
            'beneficiary_branch_id' => $beneficiary_branch_id  ? :0,
           'sender_product_id' => $sender_sub_product_id  ? :0,
            'sender_sub_product_id' =>  $sender_product_id  ? :0,
           'beneficiary_product_id' => $beneficiary_product_id  ?:1,
            'beneficiary_sub_product_id' => $beneficiary_sub_product_id  ?:1,
            'sender_id' =>  $sender_id  ?:1,
            'beneficiary_id' => $beneficiary_id  ?:1,
            'sender_name' => $sender_name,
            'beneficiary_name' => $beneficiary_name,
            'sender_account_number' => $source_account_number,
            'beneficiary_account_number' => $destination_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $narration,
            'credit'  => (double)$credit,
            'debit' => 0,
            'reference_number' => $reference,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank_transaction_reference_number' => '0000',

        ]);



    }


}
