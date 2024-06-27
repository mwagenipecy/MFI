<?php

namespace App\Http\Livewire\Loans;

use App\Models\{AccountsModel, Branches, Employee, general_ledger, issured_shares, loan_images, LoansModel, Loan_sub_products, loans_schedules, loans_summary, MembersModel};

use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpParser\Node\Expr\Cast\Double;

class Assessment extends Component
{
    use WithFileUploads;

    public $photo;
    public $futureInterest = false;
    public $collateral_type, $collateral_description, $daily_sales, $loan, $collateral_value, $loan_sub_product;
    public $tenure = 0;
    public $principle = 0;
    public $member, $guarantor, $disbursement_account, $collection_account_loan_interest;
    public $collection_account_loan_principle, $collection_account_loan_charges, $collection_account_loan_penalties;
    public $principle_min_value, $principle_max_value, $min_term, $max_term, $interest_value;
    public $principle_grace_period, $interest_grace_period, $amortization_method;
    public $days_in_a_month = 30;
    public $loan_id, $loan_account_number, $member_number, $topUpBoolena, $new_principle;
    public $interest = 0;
    public $business_licence_number, $business_tin_number, $business_inventory, $cash_at_hand;
    public $cost_of_goods_sold, $operating_expenses, $monthly_taxes, $other_expenses, $monthly_sales;
    public $gross_profit;
        public $table = [];
        public $tablefooter  = [];
        public $recommended_tenure, $recommended_installment;
        public $recommended = true;
    public $business_age, $bank1 = 123456, $available_funds;
    public $interest_method, $future_interests, $futureInsteresAmount, $valueAmmount, $net_profit, $status, $products;

    protected $listeners = ['refreshAssessment' => '$refresh'];

    public function boot(): void
    {

        $this->interest_method = "flat";
        $this->loadLoanDetails();
        $this->loadProductDetails();
        $this->loadMemberDetails();
        //$this->generateSchedule((double)$this->principle, (double)$this->interest, (double)$this->tenure);
    }

    public function actionBtns($x)
    {
        //dd($x);
        if ($x == 1) {
            $this->recommended = false;
            $this->receiveData();
        }
        if ($x == 2) {
            $this->recommended = true;
        }
        if ($x == 3) {
            $this->commit();
        }
        if ($x == 4) {
            $this->approve();



        }
        if ($x == 5) {
            $this->reject();
        }
        if ($x == 6) {
            $this->disburse();
        }
        if ($x == 7) {
            $this->receiveData();
        }
        if($x==33){
            $this->topUpBoolena=true;
            $this->topUp();
        }if($x==44){
        $this->restructure();
    }
        if($x==55){
            $this->futureInterest=true;
            $this->closeLoan();
        }
    }

    public function receiveData(){



        $this->generateSchedule((double)$this->principle, (double)$this->interest, (double)$this->tenure);
    }

    private function loadLoanDetails(): void
    {
        $this->loan = LoansModel::find(Session::get('currentloanID'));
        if ($this->loan) {
            $this->loan_id = $this->loan->loan_id;
            $this->loan_account_number = $this->loan->loan_account_number;
            $this->loan_sub_product = $this->loan->loan_sub_product;
            $this->member_number = $this->loan->member_number;
            $this->guarantor = $this->loan->guarantor;
            $this->principle = $this->loan->principle;
            $this->interest = $this->loan->interest;
            $this->business_licence_number = $this->loan->business_licence_number;
            $this->business_tin_number = $this->loan->business_tin_number;
            $this->business_inventory = $this->loan->business_inventory;
            $this->cash_at_hand = $this->loan->cash_at_hand;
            $this->daily_sales = $this->loan->daily_sales;
            $this->cost_of_goods_sold = $this->loan->cost_of_goods_sold;
            $this->operating_expenses = $this->loan->operating_expenses;
            $this->monthly_taxes = $this->loan->monthly_taxes;
            $this->other_expenses = $this->loan->other_expenses;
            $this->collateral_value = $this->loan->collateral_value;
            $this->collateral_type = $this->loan->collateral_type;
            $this->tenure = $this->loan->tenure;
            $this->business_age = $this->loan->business_age;
            $this->interest_method = $this->loan->interest_method;
            $this->status = $this->loan->status;
        }


    }

    private function loadProductDetails(): void
    {
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
        }
    }

    private function loadMemberDetails(): void
    {
        $this->guarantor = MembersModel::where('member_number', $this->guarantor)->first();
        $this->member = MembersModel::where('member_number', $this->member_number)->first();
    }

    public function render(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.loans.assessment');
    }

    private function generateSchedule($disbursed_amount, $interest_rate, $tenure): void
    {

        $principal = $disbursed_amount;
        $dailyInterestRate = $interest_rate / 100;
        $termDays = $tenure;

        $balance = $principal;
        $date =Carbon::now()->addDay() ;
//        $date = new DateTime();



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

        //dd($this->tablefooter);
    }




    public function commit()
    {
        if ($this->recommended) {

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle' => $this->principle,
                'interest' => $this->interest,
                'tenure' => $this->recommended_tenure,
                'available_funds'=> $this->available_funds,
                'status'=> 'AWAITING APPROVAL',
                'interest_method'=>$this->interest_method,
            ]);
            Session::flash('loan_commit', 'The loan has been committed!');
            Session::flash('alert-class', 'alert-success');

        } else {

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle' => $this->principle,
                'interest' => $this->interest,
                'tenure' => $this->tenure,
                'available_funds'=> $this->available_funds,
                'status'=> 'AWAITING APPROVAL',
                'interest_method'=>$this->interest_method,

            ]);

            Session::flash('loan_commit', 'The loan has been committed!');
            Session::flash('alert-class', 'alert-success');
        }

        Session::put('currentloanID',null);
        Session::put('currentloanClient',null);
        $this->emit('currentloanID');

    }


    public function updatedFutureInsteresAmount(){

        if($this->futureInsteresAmount > $this->valueAmmount){
            return $this->futureInsteresAmount= round($this->valueAmmount,2);
        }else{
            return $this->futureInsteresAmount;
        }
    }

    public function closeLoan(){

        $loan_data=LoansModel::where('id',Session::get('currentloanID'))->first();

        LoansModel::where('id',Session::get('currentloanID'))->update(['status'=>"CLOSED"]);


        if($this->future_interests){
            // get total amount to be debited/credited as principle
            $total_principle_amount=loans_schedules::where('loan_id',$loan_data->loan_id)->where('installment_date','>',Carbon::today()->format('Y-m-d'))->sum('principle');

            // get total amount to be debited/credited as interest
            $total_interest_amount=loans_schedules::where('loan_id',$loan_data->loan_id)->where('installment_date','>',Carbon::today()->format('Y-m-d'))->sum('interest');


            // get principle collection account
            $loan_product_account_id=Loan_sub_products::where('sub_product_id',$loan_data->loan_sub_product)->value('collection_account_loan_principle');
            $principle_collection_account=AccountsModel::where('id',$loan_product_account_id)->first();
            $principle_collection_account_number=$principle_collection_account->account_number;
            $principle_collection_prev_balance=$principle_collection_account->balance;


            // get interest account collections
            $loan_product_account_interest_id=Loan_sub_products::where('sub_product_id',$loan_data->loan_sub_product)->value('collection_account_loan_interest');
            $interest_collection_account=AccountsModel::where('id',$loan_product_account_interest_id)->first();
            $interest_collection_account_number=$interest_collection_account->account_number;
            $interest_collection_prev_balance=$interest_collection_account->balance;


            if($this->future_interests=="YES")
            {
                // other process here
                $debit_account_number=$loan_data->loan_account_number;

                // check if there is a balance
                $balance=AccountsModel::where('account_number',$debit_account_number)->value('balance');
                if($balance >= $total_principle_amount ){
                    // debit client account
                    $client_new_balance=(double)$balance-(double)$total_principle_amount;

                    // update amount which is debited
                    AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$client_new_balance]);


                    // credit section  with no interest
                    $principle_collection_account_new_balance=(double)$total_principle_amount + (double)$principle_collection_prev_balance;
                    // update balance
                    AccountsModel::where('account_number',$principle_collection_account_number )->update(['balance'=>$principle_collection_account_new_balance]);

                    // record on the general ledger
                    $record_on_general_ledger=new general_ledger();
                    //debit
                    $record_on_general_ledger->debit($debit_account_number,$client_new_balance
                        ,$principle_collection_account_number,$total_principle_amount,'loan repayment on close loan option',$loan_data->loan_id);

                    // credit
                    $record_on_general_ledger->credit($principle_collection_account_number,$principle_collection_account_new_balance,
                        $debit_account_number,$total_principle_amount,'loan repayment on close loan option',$loan_data->loan_id);




                    Session::put('currentloanID',null);
                    Session::put('currentloanClient',null);
                    $this->emit('currentloanID');
                }else{

                    session()->flash('message_fail','insufficient balance');
                }

            }
            elseif($this->future_interests=="NO"){
                $this->validate(['futureInsteresAmount'=>'required']);

                // other process here
                $total_interest_amount=$this->futureInsteresAmount;

                // debit user account balance// but check if has enough balance
                // other process here
                $debit_account_number=$loan_data->loan_account_number;

                $total_amount=(double)$total_interest_amount + (double)$total_principle_amount;

                // check if there is a balance
                $balance=AccountsModel::where('account_number',$debit_account_number)->value('balance');
                if($balance >= $total_amount ){

                    // principle transactions

                    // debit client account
                    $client_new_balance=(double)$balance-(double)$total_principle_amount;

                    // update amount which is debited
                    AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$client_new_balance]);
                    // credit section  with  principle
                    $principle_collection_account_new_balance=(double)$total_principle_amount + (double)$principle_collection_prev_balance;
                    // update balance
                    AccountsModel::where('account_number',$principle_collection_account_number )->update(['balance'=>$principle_collection_account_new_balance]);


                    // record on the general ledger
                    $record_on_general_ledger=new general_ledger();
                    //debit
                    $record_on_general_ledger->debit($debit_account_number,$client_new_balance
                        ,$principle_collection_account_number,$total_principle_amount,'loan repayment on close loan  for principle amount',$loan_data->loan_id);

                    // credit
                    $record_on_general_ledger->credit($principle_collection_account_number,$principle_collection_account_new_balance,
                        $debit_account_number,$total_principle_amount,'loan repayment on close loan for principle amount',$loan_data->loan_id);




                    // interest transactions
                    $client_new_balance=$client_new_balance-(double)$total_interest_amount;
                    //update amount
                    AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$client_new_balance]);

                    // credit section with interest
                    $interest_collection_new_balance=(double)$interest_collection_prev_balance + (double)$total_interest_amount;
                    // update balance
                    AccountsModel::where('account_number',$interest_collection_account_number)->update(['balance'=>$interest_collection_new_balance]);


                    //debit
                    $record_on_general_ledger->debit($debit_account_number,$client_new_balance
                        ,$interest_collection_account_number,$total_interest_amount,'loan repayment on close loan for interest amount',$loan_data->loan_id);

                    //credit interest
                    $record_on_general_ledger->credit($interest_collection_account_number,$interest_collection_new_balance,
                        $debit_account_number,$total_interest_amount,'loan repayment on close loan for interest amount',$loan_data->loan_id);



                    Session::put('currentloanID',null);
                    Session::put('currentloanClient',null);
                    $this->emit('currentloanID');
                }else{
                    session()->flash('message_fail','insufficient balance');
                }


            }
        }else{
            $this->emit('refreshAssessment');
        }


    }

    public function restructure(){


        $loanData=LoansModel::where('id',Session::get('currentloanID'))->first();
        // get tatol amount remaining

        if(LoansModel::where('loan_status','RESTRUCTURED')->where('restructure_loanId',$loanData->loan_id)->exists()) {

            session()->flash('message_fail','process failed');
        }else{



            $loanSchedules= loans_schedules::where('loan_id',$loanData->loan_id)->where('completion_status','ACTIVE')->get();

            $amount=0;

            foreach ($loanSchedules as $loan){
                $amount=$amount +$loan->installment;
            }


            $loanId=time();

            LoansModel::create([
                'restructure_loanId'=>$loanData->loan_id,
                'loan_id'=>$loanId,
                'loan_account_number'=>$loanData->loan_account_number,
                'loan_sub_product'=>$loanData->loan_sub_product,
                'client_number'=>$loanData->client_number,
                'guarantor'=>$loanData->guarantor,
                'institution_id'=>$loanData->institution_id,
                'branch_id'=>$loanData->branch_id,
                'principle'=>round($amount,2),
                'interest'=>$loanData->interest,
                'business_name'=>$loanData->business_name,
                'business_age'=>$loanData->business_age,
                'business_category'=>$loanData->business_category,
                'business_type'=>$loanData->business_type,
                'business_licence_number'=>$loanData->business_licence_number,
                'business_tin_number'=>$loanData->business_tin_number,
                'business_inventory'=>$loanData->business_inventory,
                'cash_at_hand'=>$loanData->cash_at_hand,
                'daily_sales'=>$loanData->daily_sales,
                'cost_of_goods_sold'=>$loanData->cost_of_goods_sold,
                'available_funds'=>$loanData->available_funds,
                'operating_expenses'=>$loanData->operating_expenses,
                'monthly_taxes'=>$loanData->monthly_taxes,
                'other_expenses'=>$loanData->other_expenses,
                'collateral_value'=>$loanData->collateral_value,
                'collateral_location'=>$loanData->collateral_location,
                'collateral_description'=>$loanData->collateral_description,
                'collateral_type'=>$loanData->collateral_type,
                'tenure'=>$loanData->tenure,
                'principle_amount'=>round($amount,2),
                'bank_account_number'=>$loanData->bank_account_number,
                'bank'=>$loanData->bank,
                'LoanPhoneNo'=>$loanData->LoanPhoneNo,
                'status'=>"ONPROGRESS",
                'loan_status'=>"RESTRUCTURED",
                'heath'=>'GOOD',
                'phone_number'=>$loanData->phone_number,
                'pay_method'=>$loanData->pay_method,
                'days_in_arrears'=>0,
                'supervisor_id'=>$loanData->supervisor_id,
                'client_id'=>$loanData->client_id,
                'relationship'=>$loanData->relationship,
                'loan_type'=>$loanData->loan_type,


            ]);
            Session::put('currentloanID',null);
            Session::put('currentloanClient',null);
            $this->emit('currentloanID');

        }




    }


    public function topUp(){

        $this->validate(['new_principle'=>'required']);
        $loanData=LoansModel::where('id',Session::get('currentloanID'))->first();
        // get tatol amount remaining


        if(LoansModel::where('loan_status','TOPUP')->where('restructure_loanId',$loanData->loan_id)->exists()) {

            session()->flash('message_fail','process failed');
        }else {

            $loanSchedules = loans_schedules::where('loan_id', $loanData->loan_id)->where('completion_status', 'ACTIVE')->get();

            $amount=0;

            foreach ($loanSchedules as $loan){
                $amount=$amount +$loan->principle;
            }


            if( $this->new_principle > $amount){



                $loanId = time();

                LoansModel::create([
                    'future_interest'=>$this->futureInsteresAmount,
                    'total_principle'=>$amount,
                    'restructure_loanId' => $loanData->loan_id,
                    'loan_id' => $loanId,
                    'loan_account_number' => $loanData->loan_account_number,
                    'loan_sub_product' => $loanData->loan_sub_product,
                    'client_number' => $loanData->client_number,
                    'guarantor' => $loanData->guarantor,
                    'institution_id' => $loanData->institution_id,
                    'branch_id' => $loanData->branch_id,
                    'principle' => $this->new_principle,
                    'interest' => $loanData->interest,
                    'business_name' => $loanData->business_name,
                    'business_age' => $loanData->business_age,
                    'business_category' => $loanData->business_category,
                    'business_type' => $loanData->business_type,
                    'business_licence_number' => $loanData->business_licence_number,
                    'business_tin_number' => $loanData->business_tin_number,
                    'business_inventory' => $loanData->business_inventory,
                    'cash_at_hand' => $loanData->cash_at_hand,
                    'daily_sales' => $loanData->daily_sales,
                    'cost_of_goods_sold' => $loanData->cost_of_goods_sold,
                    'available_funds' => $loanData->available_funds,
                    'operating_expenses' => $loanData->operating_expenses,
                    'monthly_taxes' => $loanData->monthly_taxes,
                    'other_expenses' => $loanData->other_expenses,
                    'collateral_value' => $loanData->collateral_value,
                    'collateral_location' => $loanData->collateral_location,
                    'collateral_description' => $loanData->collateral_description,
                    'collateral_type' => $loanData->collateral_type,
                    'tenure' => $loanData->tenure,
                    'principle_amount' => $this->new_principle,
                    'bank_account_number' => $loanData->bank_account_number,
                    'bank' => $loanData->bank,
                    'LoanPhoneNo' => $loanData->LoanPhoneNo,
                    'status' => "ONPROGRESS",
                    'loan_status' => "TOPUP",
                    'heath' => 'GOOD',
                    'phone_number' => $loanData->phone_number,
                    'pay_method' => $loanData->pay_method,
                    'days_in_arrears' => 0,
                    'supervisor_id' => $loanData->supervisor_id,
                    'client_id' => $loanData->client_id,
                    'relationship' => $loanData->relationship,
                    'loan_type' => $loanData->loan_type,


                ]);


                Session::put('currentloanID',null);
                Session::put('currentloanClient',null);
                $this->emit('currentloanID');
            }else{
                session()->flash('message_fail','invalid amount');
            }
        }


    }

    public function approve(){


        // CREATE LOAN ACCOUNT
        $loan=  LoansModel::where('id',session()->get('currentloanID'))->first();


        $client_email=MembersModel::where('member_number',$loan->member_number)->first();
        $client_name=$client_email->first_name.' '.$client_email->middle_name.' '.$client_email->last_name;
        $officer_phone_number=Employee::where('id',$client_email->loan_officer)->value('email');

//        Mail::to($client_email->email)->send(new LoanProgress($officer_phone_number,$client_name,'Your loan has been approved! We are now finalizing the disbursement process'));
        if(LoansModel::where('id',session()->get('currentloanID'))->value('loan_status')=="RESTRUCTURED"){

            loans_schedules::where('loan_id',$loan->restructure_loanId)->where('completion_status','ACTIVE')->update([
                'completion_status'=>'CLOSED',
                'account_status'=>'CLOSED'
            ]);


            //  LoansModel::where('id',session()->get('currentloanID'))->update(['status'=>"CLOSED"]);
            // source account number

            $next_due_date = Carbon::now()->toDateTimeString();

            foreach ($this->table as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_schedules;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->installment_date = $next_due_date;
                // $product->save();
            }

            foreach ($this->tablefooter as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_summary;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                //   $product->save();
            }



            LoansModel::where('id', Session::get('currentloanID'))->update([
                'status'=> 'AWAITING DISBURSEMENT',
//
            ]);



        }


        elseif(LoansModel::where('id',session()->get('currentloanID'))->value('loan_status')=="TOPUP"){
            // top up process here  TOPUP

            $loanValues=LoansModel::where('id',session()->get('currentloanID'))->where('loan_status','TOPUP')->first();


            //principle
            $prev_loan=$loanValues->restructure_loanId;
// close loan
            LoansModel::where('loan_id',$loanValues->restructure_loanId)->update(['status'=>"CLOSED"]);

            // close installment
            loans_schedules::where('loan_id',$prev_loan)->update(['completion_status'=>'CLOSED']);

            $next_due_date = Carbon::now()->toDateTimeString();

            foreach ($this->table as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_schedules;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->installment_date = $next_due_date;
                //   $product->save();
            }

            foreach ($this->tablefooter as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_summary;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                //   $product->save();
            }



            LoansModel::where('id', Session::get('currentloanID'))->update([
                'status'=> 'AWAITING DISBURSEMENT',
//
            ]);





            Session::flash('loan_commit', 'The loan has been Approved!');
            Session::flash('alert-class', 'alert-success');

            Session::put('currentloanID',null);
            Session::put('currentloanClient',null);
            $this->emit('currentloanID');


        }


        else{

            $next_due_date = Carbon::now()->toDateTimeString();

            foreach ($this->table as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_schedules;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                $product->installment_date = $next_due_date;
                //  $product->save();
            }

            foreach ($this->tablefooter as $installment) {
                $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));
                $product = new loans_summary;
                $product->loan_id = $loan->loan_id;
                $product->installment = $installment['Payment'];
                $product->interest = $installment['Interest'];
                $product->principle = $installment['Principle'];
                $product->balance = $installment['balance'];
                $product->bank_account_number = $loan->bank1;
                $product->completion_status = "ACTIVE";
                $product->account_status = "ACTIVE";
                //   $product->save();
            }

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'status'=> 'AWAITING DISBURSEMENT',

            ]);


        }

        Session::flash('loan_commit', 'The loan has been Approved!');
        Session::flash('alert-class', 'alert-success');

        Session::put('currentloanID',null);
        Session::put('currentloanClient',null);
        $this->emit('currentloanID');
    }

    public function reject(){
        LoansModel::where('id', Session::get('currentloanID'))->update([
            'status'=> 'REJECTED'
        ]);
        MembersModel::where('id',DB::table('loans')->where('id',Session::get('currentloanID'))->value('client_id'))->update([
            'client_status'=> 'REJECTED',
        ]);

        Session::flash('loan_commit', 'The loan has been Rejected!');
        Session::flash('alert-class', 'alert-danger');

        Session::put('currentloanID',null);
        Session::put('currentloanClient',null);
        $this->emit('currentloanID');
    }






}
