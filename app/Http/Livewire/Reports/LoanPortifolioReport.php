<?php

namespace App\Http\Livewire\Reports;

use App\Models\Loan_sub_products;
use App\Models\loans_schedules;
use App\Models\LoansModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LoanPortifolioReport extends Component
{

    public $loan_disbursement;
    public $total_active_loan;
    public $out_standing_amountx;
    public $total_repaid_amount;
    public $loan_average_size;
    public $loan_product,$loanStatusData;
    public $count,$amount,$amount2;
    public $total_count;
    public $total_principle;

    public $loan_status=[
        ['id'=>1,'day'=>0, 'label'=>'Current Loan(Below 10)'],
        ['id'=>2,'day'=>10, 'label'=>'In Arrears (over 10 days)'],
        ['id'=>2,'day'=>30, 'label'=>'In Arrears (over 30 days)'],
        ['id'=>3,'day'=>60, 'label'=>'In Arrears (over 60 days)'],
        ['id'=>4,'day'=>90, 'label'=>'In Arrears (over 90 days)'],
        ['id'=>5,'day'=>180, 'label'=>'In Arrears (over 180 days)'],
        ['id'=>6, 'day'=>190,'label'=>'Non-performing (Over 180 days)'],
    ];


    public function render()
    {

        $this->loanSummary();
        $this->loanDistribution();

        $this->loanStatusData=$this->loanStatusList();

        return view('livewire.reports.loan-portifolio-report');
    }


    public function loanStatusList(){

        $count_total=0;
        $principle_total=0;
        $values=$this->loan_status;
        foreach( $values as &$data){

            $loan_schedule= loans_schedules::query()->where('days_in_arrears','>=',$data['day'])
            ->where('completion_status','!=','CLOSED');

            $data['count']=$loan_schedule->count();
            $count_total+= $data['count'];

            $loan_id=loans_schedules::query()->where('days_in_arrears','>=',$data['day'])->pluck('loan_id')->toArray();

             $amount=loans_schedules::query()->whereIn('loan_id', $loan_id)
             ->where('completion_status','!=','CLOSED');
            $data['principle'] =$amount->sum('principle') - ($amount->sum('payment') ? abs( $amount->sum('payment')   -$amount->sum('interest')) :0 ) ;

            // $amount->sum('principle');

            $principle_total+= $data['principle'] ;
        }

        $this->total_count=$count_total;
        $this->total_principle=$principle_total;

       // dd($values);
        return  $values;
    }



    function loanDistribution(){

        $products=$this->productList();
        $count=0;
        $amount=0;
        $amount2=0;
        foreach( $products as $data){

            $loan_ids=LoansModel::where('status','ACTIVE')->where('loan_sub_product',$data->sub_product_id)->pluck('loan_id')->toArray();
            $loan= loans_schedules::query()->whereIn('loan_id',$loan_ids);
            $data['loan_no']=LoansModel::where('status','ACTIVE')
                              ->where('loan_sub_product',$data->sub_product_id)->count();

                    $loanData =   LoansModel::query()->where('status','ACTIVE')
                              ->where('loan_sub_product',$data->sub_product_id);

            $data['amount_disbursed']= $loanData->sum('principle') - $this->calculateCharges($loanData->pluck('id')->toArray());

            $data['out_standing_amount']=  $loan->sum('principle') - ($loan->sum('payment') ? abs( $loan->sum('payment')   -$loan->sum('interest')) :0 ) ;

            $count+=$data->loan_no;
            $amount+=$data->amount_disbursed;
            $amount2+= $data->out_standing_amount;

        }


        $this->count=$count;
        $this->amount=$amount;
        $this->amount2=$amount2;


        $this->loan_product=$products;
    }


    public function productList(){
        return Loan_sub_products::get();
    }



    //summary

    function loanSummary(){
        $this->loan_disbursement=$this->loanDisbursed();

        $this->total_active_loan=$this->activeLoan();
        $this->out_standing_amountx=$this->outStandingAmount();
        $this->total_repaid_amount=$this->repaidLoan();
        $this->loan_average_size=$this->averageLoanSize();
    }

    function averageLoanSize(){

        $total_loan= LoansModel::where('status','ACTIVE')->sum('principle');
        $loan_no=$this->total_active_loan ? :1 ;

        return ($total_loan/$loan_no);
    }

    function repaidLoan(){
        return loans_schedules::query()->whereIn('loan_id',$this->loanIds())->sum('payment');
    }

    function loanIds(){
        return LoansModel::pluck('loan_id')->toArray();
    }
    function outStandingAmount(){

        $query=loans_schedules::query()->whereIn('loan_id',$this->loanIds());
         return   $query->sum('principle') - ($query->sum('payment') ? $query->sum('payment') -  $query->sum('interest') : 0);
    }
    function activeLoan(){
        return LoansModel::where('status','ACTIVE')->count();
    }
    function loanDisbursed(){
        $query=LoansModel::query()->where('status','!=','REJECTED');
         $charges= $this->calculateCharges( $query->pluck('id')->toArray());
        return  $query->sum('principle') - $charges;

        // minus chargers

    }

    function calculateCharges($loan_ids) {

        $total_amount = 0; // Initialize total amount

        foreach($loan_ids as $id) {

            $principle = DB::table('loans')->where('id', $id)->value('principle');

            $charge_ids = DB::table('loan_has_charges')->where('loan_id', $id)->pluck('charge_id')->toArray();

            $charges = DB::table('charges')->whereIn('id', $charge_ids)->get();

            $loan_amount = 0; // Initialize loan amount for each loan

            foreach($charges as $charge) {

                if ($charge->percentage_charge_amount === null) {
                    // Use flat charge if percentage is null
                    $loan_amount += $charge->flat_charge_amount;
                } else {
                    // Calculate percentage charge based on principle
                    $loan_amount += ($charge->percentage_charge_amount * $principle) / 100;
                }
            }

            // Add the loan's calculated charges to the total amount
            $total_amount += $loan_amount;
        }

        return $total_amount;
    }
}
