<?php

namespace App\Http\Livewire\Reports;

use App\Models\Loan_sub_products;
use App\Models\loans_schedules;
use App\Models\LoansModel;
use Livewire\Component;

class LoanPortifolioReport extends Component
{

    public $loan_disbursement;
    public $total_active_loan;
    public $out_standing_amount;
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
            $data['principle'] =$amount->sum('principle');

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
            $data['loan_no']=LoansModel::where('status','ACTIVE')->where('loan_sub_product',$data->sub_product_id)->count();
            $data['amount_disbursed']=LoansModel::where('status','ACTIVE')->where('loan_sub_product',$data->sub_product_id)->sum('principle');
            $data['out_standing_amount']= $loan->sum('installment') - $loan->sum('payment') ;

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
        $this->out_standing_amount=$this->outStandingAmount();
        $this->total_repaid_amount=$this->repaidLoan();
        $this->loan_average_size=$this->averageLoanSize();
    }

    function averageLoanSize(){

        $total_loan= $this->loan_disbursement;
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
        return $query->sum('installment')- $query->sum('payment');
    }
    function activeLoan(){
        return LoansModel::where('status','ACTIVE')->count();
    }
    function loanDisbursed(){
        return LoansModel::where('status','!=','REJECTED')->sum('principle');
    }
}
