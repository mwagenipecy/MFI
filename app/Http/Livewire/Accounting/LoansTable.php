<?php
namespace App\Http\Livewire\Accounting;
use App\Models\AccountsModel;
use App\Models\approvals;
use App\Models\Employee;
use App\Models\general_ledger;
use App\Models\Loan_sub_products;
use App\Models\loans_schedules;
use App\Models\loans_summary;
use App\Models\LoansModel;
use App\Models\MembersModel;
use App\Mail\LoanProgress;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class LoansTable extends LivewireDatatable
{

    public $photo;

    public $collateral_type;
    public $collateral_description;
    public $daily_sales;
    public $loan;
    public $collateral_value;
    public $loan_sub_product;
    public $tenure = 12;
    public $principle;
    public $member;


    public $guarantor;
    public $disbursement_account;
    public $collection_account_loan_interest;
    public $collection_account_loan_principle;
    public $collection_account_loan_charges;
    public $collection_account_loan_penalties;
    public $principle_min_value;
    public $principle_max_value;
    public $interest_method;
    public $min_term;
    public $max_term;
    public $interest_value;
    public $principle_grace_period;
    public $interest_grace_period;
    public $amortization_method;
    public $days_in_a_month;
    public $loan_id;
    public $loan_account_number;

    public $member_number;


    public $interest;
    public $business_licence_number;
    public $business_tin_number;
    public $business_inventory;
    public $cash_at_hand;

    public $cost_of_goods_sold;
    public $operating_expenses;
    public $monthly_taxes;
    public $other_expenses;
    public $monthly_sales;
    public $gross_profit;
    public $table;
    public $tablefooter;
    public $recommended_tenure;
    public $recommended_installment;
    public $recommended = true;
    public $business_age;
    public $bank1;
    public  $available_funds;
    public $repaymentPlan;

    protected $listeners=[
      'approvalAndDisburse'=>'approveAndDisburse'
    ];




    public function builder()
    {

        return LoansModel::query()->where('status','AWAITING DISBURSEMENT');
        //->leftJoin('branches', 'branches.id', 'members.branch')
    }

    public function viewMember($memberId){
        Session::put('memberToViewId',$memberId);
        $this->emit('refreshMembersListComponent');
    }
    public function editMember($memberId,$name){
        Session::put('memberToEditId',$memberId);
        Session::put('memberToEditName',$name);
        $this->emit('refreshMembersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [

            Column::callback(['member_number'], function ($member_number) {

                return MembersModel::where('member_number',$member_number)->value('first_name').' '.MembersModel::where('member_number',$member_number)->value('middle_name').' '.MembersModel::where('member_number',$member_number)->value('last_name');
            })->label('Member name'),

            Column::callback(['guarantor'], function ($guarantor) {

                return MembersModel::where('member_number',$guarantor)->value('first_name').' '.MembersModel::where('member_number',$guarantor)->value('middle_name').' '.MembersModel::where('member_number',$guarantor)->value('last_name');
            })->label('Guarantor'),
            Column::name('loan_id')
                ->label('loan id'),

            Column::name('loan_account_number')
                ->label('loan account number'),


            Column::name('principle')
                ->label('principle'),

            Column::name('interest')
                ->label('interest'),

            Column::name('heath')
                ->label('health'),


            Column::name('status')
                ->label('Status'),
            Column::callback(['ID'], function ($id) {
                return view('livewire.approvals.action', ['id' => $id, 'move' => false]);
            })->unsortable()->label('Decision'),

        ];



    }


    public function reject($id){
        LoansModel::where('id',$id)->update([
            'status'=> 'REJECTED'
        ]);

        Session::flash('loan_commit', 'The loan has been Rejected!');
        Session::flash('alert-class', 'alert-danger');

        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
        $this->emit('currentloanID');
    }


    function approve($id)
    {
      // if(LoansModel::where('id',$id)->value('has_partner') =="YES"){

            $this->emit('selectPartner',$id);
       // }else{

      //    $this->approveAndDisburse($id);
     // }
    }



    public function transactionTOPartner( $loan_id)
    {
        // debit client account
         $loan = DB::table('loans')->where('id',$loan_id)->first();
        $account=DB::table('accounts')->where('id',session()->get('partner_account_id'))->first();

        if($loan && $account){
             //client information
             $client_account_number=$loan->loan_account_number;
             $loan_amount=$loan->principle;


             // partner information
             $partner_account_number=$account->account_number;


             // debit
            $client_new_balancce= (double)DB::table('accounts')->where('account_number',$client_account_number)->value('balance') - (double)$loan_amount;
            // update amount
            DB::table('accounts')->where('account_number',$client_account_number)->update(['balance'=>$client_new_balancce ]);


            // cledit
            $partner_new_balance= (double)($account->balance + $loan_amount);
            DB::table('accounts')->where('id',session()->get('partner_account_id'))->update([
               'balance'=>$partner_new_balance
            ]);


            // send to partner


         }


    }

    public function approveAndDisburse($id){


        //DB::begginTransaction();
        //DB::beginTransaction();

        try{



        $client_data_values=DB::table('members')->where('member_number',LoansModel::where('id',$id)->value('member_number') )->first();

        $client_name=$client_data_values->first_name.' '.$client_data_values->middle_name.' '.$client_data_values->last_name;
        $client_email=$client_data_values->email;
        $loan_officer_email=Employee::where('id',$client_data_values->loan_officer)->value('email');

//        Mail::to($client_email)->send(new LoanProgress($loan_officer_email,$client_name,
//            " We are pleased to confirm that the funds from your loan application have been successfully posted to your specified account.
//             Should you have any further queries or require assistance, please feel free to contact us.
//                 "));


        // source account number
        $account_id= DB::table('loan_sub_products')->where('sub_product_id',LoansModel::where('id',$id)->value('loan_sub_product'))->value('disbursement_account');
        $this->bank1=AccountsModel::where('id',$account_id)->value('account_number');


        $this->loadData($id);


        LoansModel::where('id', $id)->update([
            'status'=> 'ACTIVE',
        ]);


        $member_number = DB::table('loans')->where('id',$id)->value('member_number');

        DB::table('members')->where('member_number', $member_number)->update([
            'client_status'=> 'ACTIVE',
        ]);







            // Prepare an array to hold all the data to be inserted
            $dataToInsert = [];



            foreach ($this->table as $installment) {

                $dataToInsert[] = [
                    'loan_id' => $this->loan_id,
                    'installment' => $installment['Payment'],
                    'interest' => $installment['Interest'],
                    'principle' => $installment['Principle'], // Corrected key name
                    'balance' => $installment['balance'],
                    'bank_account_number' => $this->bank1,
                    'completion_status' => 'PENDING',
                    'account_status' => 'PENDING',
                    'installment_date' => $installment['Date'],
                    'next_check_date' => null, // You can set this if needed
                    'created_at' => now(), // Assuming you want to set the current timestamp
                    'updated_at' => now(), // Assuming you want to set the current timestamp
                    'penalties' => null, // You can set this if needed
                    'amount_in_arrears' => null, // You can set this if needed
                    'days_in_arrears' => null, // You can set this if needed
                    'payment' => null, // You can set this if needed
                    'promise_date' => null, // You can set this if needed
                    'comment' => null, // You can set this if needed
                ];

                //dd($dataToInsert);

            }

            // Use the insert method to insert all records at once
            try {
                loans_schedules::insert($dataToInsert);
                // Insertion successful
                // You can add any additional logic here if needed
                //echo "Insertion successful!";
                //dd("Insertion successful!");
            } catch (\Exception $e) {
                // Error occurred during insertion
                // Handle the exception
                //echo "Error: " . $e->getMessage();
                dd("Error: " . $e->getMessage());
            }



        foreach ($this->tablefooter as $installment) {

            $product = new loans_summary;
            $product->loan_id = $this->loan_id;
            $product->installment = $installment['Payment'];
            $product->interest = $installment['Interest'];
            $product->principal = $installment['Principle']; // Corrected key name
            $product->balance = $installment['balance'];
            $product->bank_account_number = $this->bank1;
            $product->completion_status = "PENDING";
            $product->account_status = "PENDING";
            $product->save();
        }

        $loanPaymentMethod = LoansModel::where('id',$id)->first();


        if($loanPaymentMethod->loan_status=="TOPUP"){

            $this->topUp($id);

        }else{

            if($loanPaymentMethod->loan_status=="RESTRUCTURED"){

                LoansModel::where('loan_id',$loanPaymentMethod->restructure_loanId)->update(['status'=>'CLOSED']);
                loans_schedules::where('loan_id',$loanPaymentMethod->restructure_loanId)->update(['completion_status'=>'CLOSED']);
            }

            $this->processPayment();

        }

        if($loanPaymentMethod->pay_method == 'MOBILE' || $loanPaymentMethod->pay_method == 'BANK'){


            //amount to be transferred
            $loanAmount = (double)DB::table('members')->where('id',$loanPaymentMethod->client_id)->value('amount');

            $loanSubProduct = Loan_sub_products::where('sub_product_id',$loanPaymentMethod->loan_sub_product)->value('disbursement_account');

            $accountBalance = AccountsModel::where('id',$loanSubProduct)->value('balance');
            //update disbursement account
            AccountsModel::where('id',$loanSubProduct)->update([
                'balance' => DB::raw("balance - $loanAmount")
            ]);
            //change........here.....
//            AccountsModel::where()


            AccountsModel::where('id',$loanPaymentMethod->bank)->update([
                'balance'=> DB::raw("balance - $loanAmount")
            ]);



        }


        Session::flash('loan_commit', 'The loan has been Approved!');
        Session::flash('alert-class', 'alert-success');
        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
        $this->emit('currentloanID');

          //DB::commit();
        }
        catch (\Exception $e){
            DB::rollback();

            return $e->getMessage();

        }


    }



    public function topUp($id){

        $loan=LoansModel::where('id',$id)->first();

        $account=Loan_sub_products::where('sub_product_id',$loan->loan_sub_product)->first();

        //principle account
        $principle_collection=$account->collection_account_loan_principle;
        $principle_account_data=AccountsModel::where('id',$principle_collection)->first();
        $principle_account_number=$principle_account_data->account_number;
        $principle_prev_balance=$principle_account_data->balance;
        $total_principle=$loan->total_principle;


        // interest transactions
        $interest_collection=$account->collection_account_loan_interest;
        $interest_account_data=AccountsModel::where('id',$interest_collection)->first();
        $interest_account_number=$interest_account_data->account_number;
        $interest_prev_balance=$interest_account_data->balance;
        $total_interest=$loan->future_interest;




        //client informations
        $client_total_amount=$loan->principle;
        $client_account_number=$loan->loan_account_number;





        if($client_total_amount >=($total_principle+$total_interest)){

            // debit client account
            $client_new_balance=(double)$client_total_amount-(double)$total_principle;

            // update amount which is debited
            AccountsModel::where('account_number',$client_account_number)->update(['balance'=>$client_new_balance]);

            // credit section  with  principle
            $principle_collection_account_new_balance=(double)$total_principle + (double)$principle_prev_balance;
            // update balance
            AccountsModel::where('account_number',$principle_account_number )->update(['balance'=>$principle_collection_account_new_balance]);


            // record on the general ledger
            $record_on_general_ledger=new general_ledger();
            //debit
            $record_on_general_ledger->debit($client_account_number,$client_new_balance
                ,$principle_account_number,$total_principle,'Loan top up principle transaction',$loan->loan_id);

            // credit
            $record_on_general_ledger->credit($principle_account_number,$principle_collection_account_new_balance,
                $client_account_number,$total_principle,'Loan top up principle transaction',$loan->loan_id);




            // interest transactions
            $client_new_balance=$client_new_balance-(double)$total_interest;
            //update amount
            AccountsModel::where('account_number',$client_account_number)->update(['balance'=>$client_new_balance]);

            // credit section with interest
            $interest_collection_new_balance=(double)$interest_prev_balance + (double)$total_interest;
            // update balance
            AccountsModel::where('account_number',$interest_account_number)->update(['balance'=>$interest_collection_new_balance]);


            //debit
            $record_on_general_ledger->debit($client_account_number,$client_new_balance
                ,$interest_account_number,$total_interest,'Loan top up interest transaction',$loan->loan_id);

            //credit interest
            $record_on_general_ledger->credit($interest_account_number,$interest_collection_new_balance,
                $client_account_number,$total_interest,'Loan top up interest transaction',$loan->loan_id);


            Session::flash('loan_commit', 'The loan has been Approved!');
            Session::flash('alert-class', 'alert-success');
            Session::put('currentloanID',null);
            Session::put('currentloanMember',null);
            $this->emit('currentloanID');


        }else{
            session()->flash('message_fail','sorry invalid  amount');
        }







    }





    public function processPayment()
    {
        //debit
        $savings_ledger_account_prev_balance = (double)AccountsModel::where('account_number', $this->bank1)->value('balance');
        $savings_ledger_account_new_balance=(double)($savings_ledger_account_prev_balance - $this->principle);
        AccountsModel::where('account_number', $this->bank1)->update(['balance' => $savings_ledger_account_new_balance]);

        //credit
        $savings_account_new_balance = (double)AccountsModel::where('account_number', $this->loan_account_number)->value('balance') + (double)$this->principle;
        AccountsModel::where('account_number', $this->loan_account_number)->update(['balance' => $savings_account_new_balance]);
        //

        $reference_number = time();
        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $this->loan_account_number,
            'record_on_account_number_balance' => $savings_account_new_balance,
            'sender_branch_id' =>auth()->user()->branch,
            'beneficiary_branch_id' => auth()->user()->branch,
            'sender_product_id' =>3,
            'sender_sub_product_id' => 5,
            'beneficiary_product_id' => 6,
            'beneficiary_sub_product_id' =>5,
            'sender_id' => '999999',
            'branch_id' => auth()->user()->branch,
            'beneficiary_id' => 3,
            'sender_name' => 'Organization',
            'beneficiary_name' => DB::table('members')->where('member_number', $this->member_number)->value('first_name') . ' ' . DB::table('members')->where('member_number', $this->member_number)->value('middle_name') . ' ' . DB::table('members')->where('client_number', $this->member_number)->value('last_name'),
            'sender_account_number' => $this->bank1,
            'beneficiary_account_number' => $this->loan_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => 'Loan disbursement',
            'credit' => (double)$this->principle,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $reference_number,
        ]);


        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number' => $this->bank1,
            'record_on_account_number_balance' => $savings_ledger_account_new_balance,
            'sender_branch_id' => 1,
            'beneficiary_branch_id' => 1,
            'sender_product_id' =>3,
            'sender_sub_product_id' => 3,
            'beneficiary_product_id' => 34,
            'beneficiary_sub_product_id' =>2,
            'sender_id' => '999999',
            'branch_id' => 1,
            'beneficiary_id' => 3,
            'sender_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'beneficiary_name' =>'',
            'sender_account_number' => $this->bank1,
            'beneficiary_account_number' => $this->loan_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => 'Loan Disbursement',
            'credit' => 0,
            'debit' => (double)$this->principle,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $reference_number,
        ]);



    }


    public function loadData($id): void
    {

        $this->loan = LoansModel::where('id', $id)->get();

        foreach ($this->loan as $theloan) {
            $this->loan_id = $theloan->loan_id;
            $this->loan_account_number = $theloan->loan_account_number;
            $this->loan_sub_product = $theloan->loan_sub_product;
            $this->member_number = $theloan->member_number;

            $this->guarantor = $theloan->guarantor;
            $this->principle = $theloan->principle;
            $this->interest = $theloan->interest;

            $this->business_licence_number = $theloan->business_licence_number;
            $this->business_tin_number = $theloan->business_tin_number;
            $this->business_inventory = $theloan->business_inventory;

            $this->cash_at_hand = $theloan->cash_at_hand;
            $this->daily_sales = $theloan->daily_sales;
            $this->cost_of_goods_sold = $theloan->cost_of_goods_sold;

            $this->operating_expenses = $theloan->operating_expenses;
            $this->monthly_taxes = $theloan->monthly_taxes;
            $this->other_expenses = $theloan->other_expenses;

            $this->collateral_value = $theloan->collateral_value;
            $this->collateral_type = $theloan->collateral_type;
            $this->tenure = $theloan->tenure;
            $this->business_age = $theloan->business_age;

            $this->interest_method=$theloan->interest_method;

            $this->status = $theloan->status;

        }



        $this->products = Loan_sub_products::where('sub_product_id', $this->loan_sub_product)->get();



        foreach ($this->products as $product) {
            $this->disbursement_account = $product->disbursement_account;
            $this->collection_account_loan_interest = $product->collection_account_loan_interest;
            $this->collection_account_loan_principle = $product->collection_account_loan_principle;
            $this->collection_account_loan_charges = $product->collection_account_loan_charges;

            $this->collection_account_loan_penalties = $product->collection_account_loan_penalties;
            $this->principle_min_value = $product->principle_min_value;
            $this->principle_max_value = $product->principle_max_value;

            $this->min_term = $product->min_term;
            $this->max_term = $product->max_term;
            $this->interest_value = $product->interest_value;

            $this->principle_grace_period = $product->principle_grace_period;
            $this->interest_grace_period = $product->interest_grace_period;
            $this->amortization_method = $product->amortization_method;

            $this->days_in_a_month = $product->days_in_a_month;
        }

        $this->guarantor = DB::table('members')->where('client_number', $this->guarantor)->get();
        $this->member = DB::table('members')->where('client_number', $this->member_number)->get();


        $this->proccessData($id);
    }




    public function proccessData($id)
    {

        $this->generateRepaymentSchedule();
    }



    /**
     * @throws Exception
     */


    function print_schedule($disbursed_amount, $interest_rate, $tenure)
    {

        $principal = $disbursed_amount;
        $dailyInterestRate = $interest_rate / 100;
        $termDays = $tenure;

        $balance = $principal;
//        $date = new DateTime();
        $date = Carbon::now()->addDay();

        $datalist = [];
        $totPayment = 0;
        $totInterest = 0;
        $totPrincipal = 0;
        $dailyInstallment = 0;


        for ($i = 0; $i < $termDays; $i++) {
            $dailyInstallment = ($principal + ($principal * $dailyInterestRate)) / $termDays;
            $principalPayment = $principal / $termDays;
            $interest = $dailyInstallment - $principalPayment;
            $balance -= $principalPayment;
            $totPayment += $dailyInstallment;
            $totInterest += $interest;
            $totPrincipal += $principalPayment;



            $datalist[] = [
                "Payment" => $dailyInstallment,
                "Interest" => $interest,
                "Principle" => $principalPayment,
                "balance" => $balance,
                "Date" => $date->format('Y-m-d')
            ];

            $date->modify('+1 day');
        }


        $this->table = $datalist;




        $this->tablefooter = [[
            "Payment" => $totPayment,
            "Interest" => $totInterest,
            "Principle" => $totPrincipal,
            "balance" => $balance,
        ]];

        $this->recommended_tenure = $termDays;
        $this->recommended_installment = $dailyInstallment;

    }

    /**
     * @throws Exception
     */
    public function generateRepaymentSchedule()
    {

        $this->repaymentPlan = 'Daily';

        if ($this->repaymentPlan == 'Quarterly') {
            $this->getQuarterlyRepaymentSchedule();
        } elseif ($this->repaymentPlan == 'Monthly') {
            $this->getMonthlyRepaymentSchedule();
        } elseif ($this->repaymentPlan == 'Weekly') {
            $this->getWeeklyRepaymentSchedule();
        } elseif ($this->repaymentPlan == 'Daily') {
            $this->getDailyRepaymentSchedule();
        } else {
            throw new Exception("Invalid repayment plan specified.");
        }
    }

    public function getQuarterlyRepaymentSchedule()
    {
        $payment = $this->calc_payment($this->principle, $this->tenure, $this->interest_value, 'quarterly');
        $this->print_schedule($this->principle, $this->interest_value / 4, $payment, 'quarterly');
    }


    public function getMonthlyRepaymentSchedule()
    {
        $payment = $this->calc_payment($this->principle, $this->tenure, $this->interest_value, 'monthly');
        $this->print_schedule($this->principle, $this->interest_value / 12, $payment, 'monthly');
    }


    public function getWeeklyRepaymentSchedule()
    {
        $payment = $this->calc_payment($this->principle, $this->tenure, $this->interest_value, 'weekly');
        $this->print_schedule($this->principle, $this->interest_value / 52, $payment, 'weekly');
    }


    public function getDailyRepaymentSchedule()
    {


        $this->print_schedule($this->principle, $this->interest, $this->tenure);


    }





}

