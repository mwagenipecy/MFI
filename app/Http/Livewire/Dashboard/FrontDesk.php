<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\AccountsModel;
use App\Models\ClientsModel;
use App\Models\Employee;
use App\Models\general_ledger;
use App\Models\loans_schedules;
use App\Exports\LoanRepayment;
use App\Mail\LoanProgress;
use App\Models\LoansModel;
use App\Models\Teller;
use Carbon\Carbon;
use App\Http\Livewire\Document\StatementReport;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\CalculateArrearsPenaltiesJob;
use PDF;
use Illuminate\Http\Request;

class FrontDesk extends Component
{


    public $deposit_type;
    public $member;
    public $memberNumber;
    public $depositType;
    public $member1;
    public $LoanPhoneNo;
    public $mob_number;
    public $selectedMemberId = null;
    public $accountSelected1;
    public $item;

    // new parameter(loan repayment part)
    public $payment_type;
    public $bank;
    public $reference_number;
    public $phone_number;
    public $accountSelected=null;
    public $amount;
    public $exceeding_amount;
    public $original_amount;




    // new loan parameters
    public $full_name;
    public $phone_number2;
    public $national_id;
    public $amount2;
    public $loan_officer;
    public $pay_method;
    public $loan_product;
    public $start_date;
    public   $end_date;
    public $maxPrinciple;
    public $minPrinciple;
    public $search;
    public $members;
    public $showDropdown = false;

    // money withdraw
    public $payment_method;
    public $phone_number3;

    public $loan_product1;
    public $bank3;
    public $bank5;
    public $bankAcc;
    public $phone_number4;
    public $amount3;
    public $bank_account;
    public $check_account_number;
    public $daterange;
    public $start_date_input;
    public $end_date_input;
    public $nidaNumber;
    public $cheque_values;
    public  $enableCheque=false;
    public $memberNumber1;



    protected $rules=['payment_type'=>'required', 'memberNumber1'=>'required','amount'=>'required','reference_number'=>'required_if:payment_type,BANK','bank'=>'required_if:payment_type,BANK'];


    public function mount()
    {
        $this->members = DB::table('members')->get();
        $this->updatePrincipleLimits();
    }

    public function updatedSearch()
    {
        // Filter members based on search query
        $this->members = DB::table('members')
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function selectMember($memberId)
    {
        $this->selectedMemberId = $memberId;

        // Optional: Set the selected member's name in the search input
        $selectedMember = DB::table('members')->find($memberId);
        $this->search = $selectedMember->first_name . ' ' . $selectedMember->middle_name . ' ' . $selectedMember->last_name;

        // Clear the dropdown options after selecting
        $this->showDropdown = false;
    }

    public function showAllMembers()
    {
        $this->showDropdown = true;
        $this->members = DB::table('members')->get();
    }

    public function updatedLoanProduct()
    {
        $this->updatePrincipleLimits();
    }

    private function updatePrincipleLimits()
    {
        // Retrieve the max and min principle values based on the loan product
        $this->maxPrinciple = DB::table('loan_sub_products')->where('sub_product_id', $this->loan_product)->value('principle_max_value');
        $this->minPrinciple = DB::table('loan_sub_products')->where('sub_product_id', $this->loan_product)->value('principle_min_value');
    }
    public function calculatePenalties()
    {
        try {
            // Dispatch the job
            CalculateArrearsPenaltiesJob::dispatch();

            dd("done");
        } catch (Exception $e) {
            // Handle any exceptions

            dd($e->getMessage());

        }
    }

    public function formatNumber($value)
    {
        return number_format($value, 0, '.', ',');
    }


    public function downloadPDFFile(){
     $id=1;

     $value=new StatementReport();
     $value->Download(1);
      $this->emitTo('document.statement-report','downloadPDF',$id);

    }


    public  function downloadExcelFile(){

        $this->validate(['check_account_number'=>'required']);
        $getNumber=strlen($this->check_account_number);
        if($getNumber> 4){

            $getAcountNumber=AccountsModel::where('account_number',$this->check_account_number)->first();

            if($getAcountNumber){
                return    Excel::download(new  LoanRepayment([$getAcountNumber->account_number]) , 'loanSchedule.xlsx');

                // generate report here
            }else{
                Session::flash('error1', 'invalid input account number /member number');

            }
        }elseif($getNumber==4){
            $getAcountNumber=LoansModel::where('member_number',$this->check_account_number)->first();
             if($getAcountNumber){
                 return    Excel::download(new  LoanRepayment([$getAcountNumber->loan_account_number]) , 'loanSchedule.xlsx');
                 //   return    Excel::download(new  loans_schedules([$loandId]) , 'loanSchedule.xlsx');
                 // generate report here
             }else{
                 Session::flash('error1', 'invalid input account number /member number');
             }
        }
        else{
            Session::flash('error1', 'invalid input account number /member number');
        }
    }


    public function process3(){


        $this->validate([
            'payment_method'=>'required',
            'memberNumber'=>'required',
            'amount3'=>'required',
        ]);

        $this->amount3=$this->removeNumberFormat($this->amount3);

        if($this->payment_method=="CASH"){



            if( AccountsModel::where('id',Teller::where('employee_id',auth()->user()->employeeId)->value('account_id'))->exists()){


                // debit teller and customer  loan account
                $teller_account_details=    AccountsModel::where('id',Teller::where('employee_id',auth()->user()->employeeId)->value('account_id'))->first();
                // debit teller account
                $teller_balance= $teller_account_details->balance;

                if($teller_balance< $this->amount3){
                    session()->flash('message_fail3','internal  insufficient balance');


                }else{


                    // update balance
                    $teller_new_balance= (double)$teller_balance- (double)$this->amount3;
                    AccountsModel::where('id',Teller::where('employee_id',auth()->user()->employeeId)->value('account_id'))->update(['balance'=>$teller_new_balance]);

                    // gl debit teller account
                    $general_ledger_record=new general_ledger();
                    $general_ledger_record->debit($teller_account_details->account_number,$teller_new_balance,'0000',$this->amount3,'Cash payment','');

                    // for customer loan account
                    $custome_loan_account_data=DB::table('loans')->where('loan_account_number',$this->accountSelected)->first();

                    // update balance
                    AccountsModel::where('account_number',$this->accountSelected)->update(['balance'=>0]);

                    // gr record
                    $general_ledger_record->debit($custome_loan_account_data->loan_account_number,'00','0000',$this->amount3,'Cash payment','');

                    $this->resetLoanRepayment();
                    session()->flash('message_3','successfully');
                }
            }else{
                session()->flash('message_fail3','I kindly ask you to recognize that you are not a teller');
            }


        }

        elseif($this->payment_method=="BANK" ||  $this->payment_method=="MOBILE"){

//            dump("awaiting API");
            //destinantion bank account number
            $destination_account_number=$this->bank_account;
            // get mirror account number
            $mirror_account_array_data=AccountsModel::where('id',$this->bank3)->first();
            // update mirror account number
            $mirror_account_new_balance= (double)$mirror_account_array_data->balance + (double)$this->amount3;
            AccountsModel::where('id',$this->bank3)->update(['balance'=>$mirror_account_new_balance]);
            //  get customer account number
            $custome_loan_account_data=DB::table('loans')->where('loan_sub_product',$this->loan_product1)->where('member_number',DB::table('members')->where('phone_number',$this->phone_number3)->value('member_number'))->first();
            // update amount
            DB::table('loans')->where('loan_sub_product',$this->loan_product1)->where('member_number',DB::table('members')->where('phone_number',$this->phone_number3)->value('member_number'))->update(['principle'=>"0"]);

//            dump("awaiting API");

            // record to the general ledger
            $general_ledger_records= new general_ledger();
            $general_ledger_records->credit($mirror_account_array_data->account_number,$mirror_account_new_balance,$custome_loan_account_data->loan_account_number,(double)$this->amount3,'bank/ mobile transaction','');

            // customer side  gl for debit
            $general_ledger_records->debit($custome_loan_account_data->loan_account_number,'0000',$custome_loan_account_data->loan_account_number,$this->amount3,'bank/ mobile transaction','');

            $this->resetLoanRepayment();
            session()->flash('message_3','successfully');


//            if( $this->payment_method=="MOBILE"){
//                dump('mobile');
//
//            }



        }

        elseif($this->payment_method=="CHEQUE"){


            // if cheque
            $this->validate(['bank3'=>'required','accountSelected'=>'required','amount3'=>'required']);

            // debit the customer account
            $cutomer_account_data=AccountsModel::where('account_number',$this->accountSelected)->first();
            $customer_account_number=$cutomer_account_data->account_number;
            $customer_new_balance=(double)$cutomer_account_data->balance - (double)$this->amount3;

            $loan = LoansModel::where('loan_account_number', $customer_account_number)
                ->latest('created_at')
                ->first();
            if ($loan) {
                $loan_id = $loan->loan_id;
            } else {
                $loan_id = null;
            }


            // update customer account
            AccountsModel::where('account_number',$customer_account_number)->update(['balance'=>$customer_new_balance]);


            // credit side
            $mirror_account_data=AccountsModel::where('account_number',$this->bank3)->first();
            $bank_account_number=$mirror_account_data->account_number;
            $bank_new_balance=(double)$mirror_account_data->balance + (double)$this->amount3;

            // update mirror account
            AccountsModel::where('account_number',$bank_account_number)->update(['balance'=>$bank_new_balance]);



            //record on general ledger
            $record_on_gl=new general_ledger();
            $record_on_gl->debit($customer_account_number,$customer_new_balance,
                $bank_account_number,$this->amount3,"Cheque Transaction",$loan_id);

            // credit
            $record_on_gl->credit($bank_account_number,$bank_new_balance
                ,$customer_account_number,$this->amount3,"Cheque Transaction",$loan_id);

            // update and insert into cheque table


            $cheque_number="CHQ".substr(time(),4);

        $id=  DB::table('cheques')->insertGetId([
               'customer_account'=>$customer_account_number,
                'amount'=>$this->amount3,
                'cheque_number'=>$cheque_number,
                'branch'=>$cutomer_account_data->branch_number,
                'bank_account'=>$bank_account_number,
                'finance_approver'=>auth()->user()->employeeId,
                 'status'=>"PENDING",


            ]);


            $this->cheque_values=DB::table('cheques')->where('id',$id)->get();
            $this->enableCheque=true;

            $this->resetLoanRepayment();
            session()->flash('message_3','Cheque Issued Successfully');

        }




    }




    public function process(){


        $this->validate();
        $this->amount=$this->removeNumberFormat($this->amount);
        if($this->payment_type=="CASH"){
            // get loan id of member
            $loanUser = LoansModel::where('loan_id',$this->accountSelected)->first();


            $id=Teller::where('id',1)->value('account_id');
            // teller account number
            $teller_account_data=AccountsModel::where('id',$id)->first();

            // credit
            $customer_account_data=AccountsModel::where('id',$loanUser->loan_account_number)->first();
            $new_customer_balance= (double)$this->amount + (double)$customer_account_data->balance;
            // update
            AccountsModel::where('account_number',$customer_account_data->account_number)->update(['balance'=>$new_customer_balance]);


            // records on general ledger
            $records_on_general_ledger=new general_ledger();
            $records_on_general_ledger->credit($customer_account_data->account_number,$new_customer_balance,'0000',$this->amount,'Cash payment','');


            // credit to the teller account
            $new_teller_balance=(double)$this->amount +(double)$teller_account_data->balance;
            // update
            AccountsModel::where('account_number',$teller_account_data->account_number)->update(['balance'=>$new_teller_balance]);

            $records_on_general_ledger=new general_ledger();
            $records_on_general_ledger->credit($teller_account_data->account_number,$new_teller_balance,'0000',$this->amount,'Cash payment','');


            $this->update_repayment($this->accountSelected, (double)$this->amount);

          session()->flash('message1','Successfully paid');
            $this->resetLoanRepayment();

        }

        elseif($this->payment_type=="BANK" || $this->payment_type=="MOBILE"  ){

            // if  bank
            $mirror_account_data= AccountsModel::where('id',  $this->bank)->first();
            $mirror_account=$mirror_account_data->account_number;

            // get balance
            $bank_balance=$mirror_account_data->balance;
            $mirrorr_account_new_balance=(double)$bank_balance - (double) $this->amount;

            // update balance
            AccountsModel::where('id',$this->bank)->update(['balance'=>$mirrorr_account_new_balance]);


            // customer
            $customer_account_details= AccountsModel::where('account_number',$this->accountSelected)->first();

            //update balance
            $loan_account_new_balance=(double)$customer_account_details->balance + (double)$this->amount;
            AccountsModel::where('account_number',$customer_account_details->account_number)->update(['balance'=>$loan_account_new_balance]);


            // credit on
            $gl_credit_record_on_customer_account=new general_ledger();
            $gl_credit_record_on_customer_account->creditWithReference($customer_account_details->account_number,$loan_account_new_balance,$mirror_account,$this->amount,'bank/ mobile transaction',$this->reference_number);

            // debit on mirror account
            $gl_credit_record_on_customer_account->withBankReferenceNumber($mirror_account,$mirrorr_account_new_balance,$mirror_account,$this->amount,'bank/ mobile transaction',$this->reference_number);


            session()->flash('message1',"successfully");
        }elseif($this->payment_type=="SAVINGS"){

            //dd($this->accountSelected);
            // customer
            $customer_account_details= AccountsModel::where('id',$this->accountSelected)->first();


            //update balance
            $loan_account_new_balance=(double)$customer_account_details->balance + (double)$this->amount;
            AccountsModel::where('account_number',$customer_account_details->account_number)->update(['balance'=>$loan_account_new_balance]);


            // credit on
            $gl_credit_record_on_customer_account=new general_ledger();
            $gl_credit_record_on_customer_account->creditWithReference($customer_account_details->account_number,$loan_account_new_balance,'520100002220',$this->amount,'Savings deposit by member',$this->reference_number);


            // customer
            $member_savings_account_details= AccountsModel::where('account_number','520100002220')->first();

            //update balance
            $member_savings_account_new_balance=(double)$member_savings_account_details->balance - (double)$this->amount;
            // debit on mirror account
            $gl_credit_record_on_customer_account->withBankReferenceNumber('520100002220',$member_savings_account_new_balance,$customer_account_details->account_number,$this->amount,'Savings deposit by member',$this->reference_number);

            session()->flash('message1','Successfully deposited');

        }elseif($this->payment_type=="REPAYMENT-SAVINGS"){




            // get loan id of member
            $loanUser = LoansModel::where('loan_id',$this->accountSelected)->first();


            $id=4;
            // teller account number
            $teller_account_data=AccountsModel::where('id',$id)->first();

            // credit
            $customer_account_data=AccountsModel::where('member_number',$this->memberNumber1)->where('sub_category_code','2220')->first();
            $new_customer_balance= (double)$customer_account_data->balance - (double)$this->amount;
            // update
            AccountsModel::where('account_number',$customer_account_data->account_number)->update(['balance'=>$new_customer_balance]);


            // records on general ledger
            $records_on_general_ledger=new general_ledger();
            $records_on_general_ledger->credit($customer_account_data->account_number,$new_customer_balance,'0000',$this->amount,'Cash payment','');


            // credit to the teller account
            $new_teller_balance=(double)$this->amount +(double)$teller_account_data->balance;
            // update
            AccountsModel::where('account_number',$teller_account_data->account_number)->update(['balance'=>$new_teller_balance]);

            $records_on_general_ledger=new general_ledger();
            $records_on_general_ledger->credit($teller_account_data->account_number,$new_teller_balance,'0000',$this->amount,'Cash payment','');


            $this->update_repayment($this->accountSelected, (double)$this->amount);

            session()->flash('message1','Successfully paid');
            $this->resetLoanRepayment();

        }

        $this->resetLoanRepayment();
    }


    public function process1(Request $request)
    {

        // Update the principle limits before validation
        $this->updatePrincipleLimits();

        // Register full name in member table
        $this->amount2 = $this->removeNumberFormat($this->amount2);
        $this->validate([
            'amount2' => [
                'required',
                // 'numeric',
                function ($attribute, $value, $fail) {
                    if ($value > $this->maxPrinciple) {
                        $fail('The amount must not exceed ' . number_format($this->maxPrinciple) . ' TZS.');
                    }

                    if ($value < $this->minPrinciple) {
                        $fail('The amount must be at least ' . number_format($this->minPrinciple) . ' TZS.');
                    }
                },
            ],
            'loan_officer' => 'required',
            'pay_method' => 'required',
            'loan_product' => 'required',
        ], [
            'amount2.required' => 'The amount field is required.'
        ]);


        // Check if user exists by selected member ID
        $check_user = DB::table('members')->where('id', $this->selectedMemberId)->exists();

        if ($check_user) {
//            $this->validate([
//                'selectedMemberId' => 'required|exists:members,id',
//                'amount2' => 'required',
//                'loan_officer' => 'required'
//            ]);

            $member_id = DB::table('members')->where('id', $this->selectedMemberId)->first();
            $accountNumber = $member_id->account_number;

            $loan_id = time();

            LoansModel::create([
                'principle' => $this->amount2,
                'member_id' => $member_id->id,
                'member_number' => $member_id->member_number,
                'loan_sub_product' => $this->loan_product,
                'pay_method' => $this->pay_method,
                'branch_id' => auth()->user()->branch,
                'supervisor_id' => $this->loan_officer,
                'loan_account_number' => $accountNumber,
                'loan_id' => $loan_id,
                'tenure' => DB::table('loan_sub_products')->where('sub_product_id', $this->loan_product)->value('interest_tenure'),
                'interest' => DB::table('loan_sub_products')->where('sub_product_id', $this->loan_product)->value('interest_value'),
                'status' => "ONPROGRESS"
            ]);



            // Create loan account
            $id2 = AccountsModel::create([
                'account_use' => 'external',
                'institution_number' => auth()->user()->institution_id,
                'branch_number' => auth()->user()->branch,
                'member_number' => $member_id->member_number,
                'product_number' => $this->loan_product,
                'sub_product_number' => '',
                'major_category_code' => 1000,
                'category_code' => 1200,
                'sub_category_code' => 1210,
                'account_name' => $member_id->first_name . ' ' . $member_id->middle_name . ' ' . $member_id->last_name,
                'account_number' => $accountNumber,
                'notes' => " ",
            ])->id;
//
//            $officer_phone_number = Employee::where('id', $this->loan_officer)->value('email');
//            $member_name = $member_id->first_name . ' ' . $member_id->middle_name . ' ' . $member_id->last_name;
//
//            Mail::to($member_id->email)->send(new LoanProgress($officer_phone_number, $member_name, 'We acknowledge the successful receipt of your loan application. Our team is now processing it and will be in touch shortly regarding further stages '));



            session()->flash('message_2', 'Successfully saved');
            $this->resetLoanRepayment();
        } else {
            $this->validate([
                'full_name' => 'required|string|min:4',
                'selectedMemberId' => 'required|exists:members,id',
                'LoanPhoneNo' => 'required_if:pay_method,MOBILE',
                'phone_number2' => 'required',
                'bank5' => 'required_if:pay_method,BANK,MOBILE',
                'bankAcc' => 'required_if:pay_method,BANK',
                'loan_product' => 'required',
                'pay_method' => 'required',
                'loan_officer' => 'required',
                'amount2' => 'required|numeric'
            ]);

            $id = ClientsModel::create([
                'first_name' => $this->full_name,
                'phone_number' => $this->phone_number2,
//                'national_id' => $this->national_id,
                'loan_officer' => $this->loan_officer,
                'branch' => auth()->user()->branch,
                'institution_id' => auth()->user()->institution_id,
                'amount' => $this->amount2,
                'member_status' => "NEW CLIENT"
            ])->id;

            LoansModel::create([
                'principle' => $this->amount2,
                'member_id' => $id,
                'member_number' => DB::table('members')->where('id', $id)->value('member_number'),
                'loan_sub_product' => $this->loan_product,
                'pay_method' => $this->pay_method,
                'bank' => $this->bank5,
                'bank_account_number' => $this->bankAcc,
                'LoanPhoneNo' => $this->LoanPhoneNo,
                'status' => 'NEW LOAN',
                'interest' => DB::table('loan_sub_products')->where('sub_product_id', $this->loan_product)->value('interest_value'),
                'tenure' => DB::table('loan_sub_products')->where('sub_product_id', $this->loan_product)->value('interest_tenure'),
                'supervisor_id' => $this->loan_officer,
                'branch_id' => auth()->user()->branch
            ]);

            $this->resetLoanRepayment();

        }

        session()->flash('message_2', 'Successfully saved');
    }

    public function setAccount($account){
        $this->accountSelected=$account;
    }

    public function resetLoanRepayment(){
        $this->accountSelected=null;
        $this->bank=null;
        $this->reference_number=null;
        $this->phone_number=null;
        $this->pay_type=null;
        $this->phone_number2=null;
        $this->phone_number3=null;
        $this->amount3=null;
        $this->amount=null;
        $this->bank_account=null;
        $this->amount2=null;
        $this->loan_product=null;
        $this->loan_officer=null;
        $this->pay_method=null;
        $this->national_id=null;
        $this->nidaNumber=null;
        $this->payment_method=null;
         $this->bank3=null;
         $this->memberNumber1=null;
         $this->payment_type=null;
        $this->mrmber_number=null;

    }

//    function updatedAmount($amaunt)
//    {
//
//            $this->amount= $amaunt;
//
//    }
    function updatedAmount2($amaunt)
    {$amaunt= (int)$amaunt;
            $this->amount2= number_format($amaunt);

    }
    function updatedAmount3($amaunt)
    {$amaunt= (int)$amaunt;
            $this->amount3= number_format($amaunt);

    }

    function removeNumberFormat($amount)
    {
        return (float) str_replace(',', '', $amount);
    }



    public function render()
    {


        if( $this->start_date  &&  $this->end_date){

        }else{
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $this->start_date = $startOfMonth->toDateString();
            $this->end_date = $endOfMonth->toDateString();

            $this->start_date_input = $startOfMonth->format('m-d-Y');
            $this->end_date_input = $endOfMonth->format('m-d-Y');

        }

        $this->amount3=DB::table('accounts')->where('account_number',$this->accountSelected)->value('balance');
        $this->amount3=$this->amount3 ?: null;


        return view('livewire.dashboard.front-desk');
    }




//    function update_repayment($loan_id, $amount)
//    {
//
//        // Fetch all pending schedules for the given loan ID
//        $schedules = DB::table('loans_schedules')
//            ->where('loan_id', $loan_id)
//            ->where('completion_status', 'PENDING')
//            ->orWhere('completion_status', 'PARTIAL')
//            ->orderBy('installment_date', 'asc')
//            ->get();
//
//
//        foreach ($schedules as $schedule) {
//            // Initialize payment values
//            $interest_payment = 0;
//            $principal_payment = 0;
//
//            // Pay off the interest first
//            if ($amount >= $schedule->interest) {
//                $interest_payment = $schedule->interest;
//                $amount -= $interest_payment;
//                $schedule->interest_payment += $interest_payment;
//            } else {
//                $interest_payment = $amount;
//                $schedule->interest_payment += $interest_payment;
//                $amount = 0;
//            }
//
//
//            // Pay off the principal next
//            if ($amount > 0) {
//                if ($amount >= $schedule->principle) {
//                    $principal_payment = $schedule->principle;
//                    $amount -= $principal_payment;
//                    $schedule->principle_payment += $principal_payment;
//                } else {
//                    $principal_payment = $amount;
//                    $schedule->principle_payment += $principal_payment;
//                    $amount = 0;
//                }
//            }
//
//            // Calculate total payment made
//            $total_payment = $interest_payment + $principal_payment;
//
//            // Determine the completion status
//            if ($schedule->installment == $total_payment) {
//                $completion_status = 'PAID';
//            } elseif ($amount > 0) {
//                $completion_status = 'PAID';
//            } else {
//                $completion_status = 'PARTIAL';
//            }
//
//            //dd($interest_payment,$principal_payment,$total_payment);
//            // Update the schedule record in the database
//            DB::table('loans_schedules')
//                ->where('id', $schedule->id)
//                ->update([
//                    'interest_payment' => (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('interest_payment') + $interest_payment,
//                    'principle_payment' => (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('principle_payment') + $principal_payment,
//                    //'payment' => (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('interest_payment') + (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('principle_payment'),
//                    'completion_status' => $completion_status,
//                    'updated_at' => now()
//                ]);
//
//            DB::table('loans_schedules')
//                ->where('id', $schedule->id)
//                ->update([
//                    //'interest_payment' => (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('interest_payment') + $interest_payment,
//                    //'principle_payment' => (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('principle_payment') + $principal_payment,
//                    'payment' => (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('interest_payment') + (double)DB::table('loans_schedules')->where('id', $schedule->id)->value('principle_payment'),
//                    //'completion_status' => $completion_status,
//                    //'updated_at' => now()
//                ]);
//
//
//            // If the remaining amount is exhausted, break out of the loop
//            if ($amount <= 0) {
//                break;
//            }
//        }
//
//
//    }

    function update_repayment($loan_id, $amount)
    {
        // Fetch all pending schedules for the given loan ID
        $schedules = DB::table('loans_schedules')
            ->where('loan_id', $loan_id)
            ->whereIn('completion_status', ['ACTIVE','PENDING', 'PARTIAL'])
            ->orderBy('installment_date', 'asc')
            ->get();

        foreach ($schedules as $schedule) {
            // Initialize payment values
            $interest_payment = 0;
            $principal_payment = 0;

            // Pay off the interest first
            if ($amount >= $schedule->interest - $schedule->interest_payment) {
                $interest_payment = $schedule->interest - $schedule->interest_payment;
                $amount -= $interest_payment;
            } else {
                $interest_payment = $amount;
                $amount = 0;
            }
            $schedule->interest_payment += $interest_payment;

            // Pay off the principal next
            if ($amount > 0) {
                if ($amount >= $schedule->principle - $schedule->principle_payment) {
                    $principal_payment = $schedule->principle - $schedule->principle_payment;
                    $amount -= $principal_payment;
                } else {
                    $principal_payment = $amount;
                    $amount = 0;
                }
                $schedule->principle_payment += $principal_payment;
            }

            // Calculate total payment made
            $total_payment = $schedule->interest_payment + $schedule->principle_payment;

            //dd($total_payment,$schedule->installment);

            // Determine the completion status
            if ((double)$total_payment >= (double)$schedule->installment) {
                $completion_status = 'PAID';
            } else {
                $completion_status = 'PARTIAL';
            }

            // Update the schedule record in the database
            DB::table('loans_schedules')
                ->where('id', $schedule->id)
                ->update([
                    'interest_payment' => $schedule->interest_payment,
                    'principle_payment' => $schedule->principle_payment,
                    'payment' => $total_payment,
                    'completion_status' => $completion_status,
                    'updated_at' => now()
                ]);

            // If the remaining amount is exhausted, break out of the loop
            if ($amount <= 0) {
                break;
            }
        }
    }

//    function update_repayment($loan_id, $amount)
//    {
//        // Fetch all pending schedules for the given loan ID
//        $schedules = DB::table('loans_schedules')
//            ->where('loan_id', $loan_id)
//            ->whereIn('completion_status', ['PENDING', 'PARTIAL'])
//            ->orderBy('installment_date', 'asc')
//            ->get();
//
//        // Initialize variable to track the original amount
//        $original_amount = $amount;
//
//        foreach ($schedules as $schedule) {
//            // Initialize payment values
//            $interest_payment = 0;
//            $principal_payment = 0;
//
//            // Pay off the interest first
//            if ($amount >= $schedule->interest - $schedule->interest_payment) {
//                $interest_payment = $schedule->interest - $schedule->interest_payment;
//                $amount -= $interest_payment;
//            } else {
//                $interest_payment = $amount;
//                $amount = 0;
//            }
//            $schedule->interest_payment += $interest_payment;
//
//            // Pay off the principal next
//            if ($amount > 0) {
//                if ($amount >= $schedule->principle - $schedule->principle_payment) {
//                    $principal_payment = $schedule->principle - $schedule->principle_payment;
//                    $amount -= $principal_payment;
//                } else {
//                    $principal_payment = $amount;
//                    $amount = 0;
//                }
//                $schedule->principle_payment += $principal_payment;
//            }
//
//            // Calculate total payment made
//            $total_payment = $schedule->interest_payment + $schedule->principle_payment;
//
//            // Determine the completion status
//            if ((double)$total_payment == (double)$schedule->installment) {
//                $completion_status = 'PAID';
//            } else {
//                $completion_status = 'PARTIAL';
//            }
//
//            // Update the schedule record in the database
//            DB::table('loans_schedules')
//                ->where('id', $schedule->id)
//                ->update([
//                    'interest_payment' => $schedule->interest_payment,
//                    'principle_payment' => $schedule->principle_payment,
//                    'payment' => $total_payment,
//                    'completion_status' => $completion_status,
//                    'updated_at' => now()
//                ]);
//
//            // If the remaining amount is exhausted, break out of the loop
//            if ($amount <= 0) {
//                break;
//            }
//        }
//
//        // Calculate the exceeding amount
//        $exceeding_amount = $original_amount - ($original_amount - $amount);
//
//
////        dd($exceeding_amount);
//
////        // Return the exceeding amount
//        return $exceeding_amount;
//    }



}

