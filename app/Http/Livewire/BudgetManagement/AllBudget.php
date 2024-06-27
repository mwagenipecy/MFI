<?php

namespace App\Http\Livewire\BudgetManagement;

use App\Models\approvals;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AllBudget extends Component
{

    public $Buget;
    public $editModalStatus;
    public $selectedRow;
    public $january;
    public $february;
    public $march;
    public $april;
    public $may;
    public $june;
    public   $july;
    public $august;
    public $september;
    public $october;
    public $november;
    public $december;
    public $title;
    public $year;


    protected $listeners=['updateYear'=>'updateYear'];

    public function mount(){
       // $this->Buget=DB::table('main_budget')->where('year',$this->year)->get();

    }

    public function boot(){
        $this->year=Carbon::now()->year;
    }


    public function updateYear($year){
        $this->year=$year;
        $this->mount();
    }
    public function render()
    {
        $this->Buget=DB::table('main_budget')->where('year',$this->year)->get();
        $this->mount();
        return view('livewire.budget-management.all-budget');
    }

    public function enableEditModal($id){
        $this->mount();
        $this->editData($id);
         $this->selectedRow=$id;

         $this->title=DB::table('main_budget')->where('id',$this->selectedRow)->value('sub_category_name');
        $this->editModalStatus=true;
    }

    public function updateBudgetModel(){
        $main_budget_data=DB::table('main_budget')->where('id',$this->selectedRow)->first();
        // check if budget exist to the pending table
        if(DB::table('main_budget_pending')->where('budget_id',$this->selectedRow)->exists()){
            session()->flash('message_fail','Budget is pending');

        }

        else{

     $edit_package=[
         'january' =>$this->january,
         'january_init' =>$this->january,
         'february'=> $this->february,
         'february_init'=> $this->february,
         'march'=> $this->march,
         'march_init'=> $this->march,
         'april'=>$this->april,
         'april_init'=>$this->april,
         'may'=> $this->may,
         'may_init'=> $this->may,
         'june'=>$this->june,
         'june_init'=>$this->june,
         'july'=> $this->july,
         'july_init'=> $this->july,
         'august' =>$this->august,
         'august_init' =>$this->august,
         'september'=>$this->september,
         'september_init'=>$this->september,
         'october'=> $this->october,
         'october_init'=> $this->october,
           'november'=> $this->november,
           'november_init'=> $this->november,
           'december'=> $this->december,
           'december_init'=> $this->december,
           'budget_id'=>$this->selectedRow,
           'budget_id_init'=>$this->selectedRow,
            'year'=>Carbon::now()->year,
           'sub_category_code'=>$main_budget_data->sub_category_code,
           'sub_category_name'=>$main_budget_data->sub_category_name,
              ];


 $edit_package2=[
         'january_init' =>$this->january,
         'february_init'=> $this->february,
         'march_init'=> $this->march,
         'april_init'=>$this->april,
         'may_init'=> $this->may,
         'june_init'=>$this->june,
         'july_init'=> $this->july,
         'august_init' =>$this->august,
         'september_init'=>$this->september,
         'october_init'=> $this->october,
           'november_init'=> $this->november,
           'december_init'=> $this->december,
              ];

     $total=array_sum($edit_package2);
    $rawId= DB::table('main_budget_pending')->insertGetId($edit_package);

     DB::table('main_budget_pending')->where('id',$rawId)->update(['total'=>$total]);

            approvals::create([
                'institution' => '',
                'process_name' => 'updateBudget',
                'process_description' => auth()->user()->name.'update budget',
                'approval_process_description' => 'has updated budget',
                'process_code' => 102,
                'process_id' => $rawId.'budgetId',
                'approval_status' => '',
                'user_id'  => auth()->user()->id,
                'team_id'  => "",
                'edit_package'=>'',
//                'approver_id' => auth()->user()->id,

            ]);


        session()->flash('message','Awaiting Approval');
        $this->mount();

        sleep(3);
        $this->editModalStatus=false;
    }
    }


    public function resetData(){
        $this->january= null;
        $this->february=null;
        $this->march=null;
        $this->april=null;
        $this->may=null;
        $this->june=null;
        $this->july=null;
        $this->august=null;
        $this->september=null;
        $this->october=null;
        $this->november=null;
        $this->december=null;

    }

    public function cancelModal(){
        $this->mount();
        $this->editModalStatus=false;
    }

    public function editData($id){

        $get_buget_data=DB::table('main_budget')->where('id',$id)->where('year',Carbon::now()->year)->first();
          $this->january= $get_buget_data->january;
           $this->february=$get_buget_data->february;
           $this->march=$get_buget_data->march;
           $this->april=$get_buget_data->april;
           $this->may=$get_buget_data->may;
           $this->june=$get_buget_data->june;
           $this->july=$get_buget_data->july;
           $this->august=$get_buget_data->august;
           $this->september=$get_buget_data->september;
           $this->october=$get_buget_data->october;
           $this->november=$get_buget_data->november;
           $this->december=$get_buget_data->december;

    }
}
