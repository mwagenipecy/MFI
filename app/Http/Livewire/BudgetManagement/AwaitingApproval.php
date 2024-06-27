<?php

namespace App\Http\Livewire\BudgetManagement;

use App\Models\approvals;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AwaitingApproval extends Component
{

    public $pending_budget;


    public function mount(){
        $this->pending_budget=DB::table('main_budget_pending')->where('year',Carbon::now()->year)->get();

    }

    public function declineBudget($id){
        DB::table('main_budget_pending')->where('id',$id)->delete();
       session()->flash('message','successfully');
        $this->mount();

    }

    public function approveBudget($id){
        $data=DB::table('main_budget_pending')->where('id',$id)->first();


        $new_data=[
            'january' =>$data->january,
            'january_init' =>$data->january,
            'february'=> $data->february,
            'february_init'=> $data->february,
            'march'=> $data->march,
            'march_init'=> $data->march,
            'april'=>$data->april,
            'april_init'=>$data->april,
            'may'=> $data->may,
            'may_init'=> $data->may,
            'june'=>$data->june,
            'june_init'=>$data->june,
            'july'=> $data->july,
            'july_init'=> $data->july,
            'august' =>$data->august,
            'august_init' =>$data->august,
            'september'=>$data->september,
            'september_init'=>$data->september,
            'october'=> $data->october,
            'october_init'=> $data->october,
            'november'=> $data->november,
            'november_init'=> $data->november,
            'december'=> $data->december,
            'december_init'=> $data->december,

        ];

        $total= array_sum($new_data);
        DB::table('main_budget')->where('id',$data->budget_id)->update($new_data);
        DB::table('main_budget')->where('id',$data->budget_id)->update(['total'=>$total]);

        session()->flash('message','successfully');

     //   'process_id' => $rawId.'budgetId',


        DB::table('approvals')->where('process_id',$id.'budgetId')->update([
            'approver_id' => auth()->user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved ',
        ]);

        DB::table('main_budget_pending')->where('id',$id)->delete();

        $this->mount();

            }

    public function render()
    {
        return view('livewire.budget-management.awaiting-approval');
    }


    public function approveAll(){
        // get all id from the pending table where status == pending,
        $pluckId=DB::table('main_budget_pending')->pluck('budget_id');

        foreach ($pluckId as $id){
          $data=   DB::table('main_budget_pending')->where('budget_id',$id)->first();
            $value=[
                'january' =>$data->january,
                'january_init' =>$data->january,
                'february'=> $data->february,
                'february_init'=> $data->february,
                'march'=> $data->march,
                'march_init'=> $data->march,
                'april'=>$data->april,
                'april_init'=>$data->april,
                'may'=> $data->may,
                'may_init'=> $data->may,
                'june'=>$data->june,
                'june_init'=>$data->june,
                'july'=> $data->july,
                'july_init'=> $data->july,
                'august' =>$data->august,
                'august_init' =>$data->august,
                'september'=>$data->september,
                'september_init'=>$data->september,
                'october'=> $data->october,
                'october_init'=> $data->october,
                'november'=> $data->november,
                'november_init'=> $data->november,
                'december'=> $data->december,
                'december_init'=> $data->december,

            ];
            DB::table('main_budget')->where('id',$id)->update($value);

            DB::table('approvals')->where('process_id',$data->id.'budgetId')->update([
                'approver_id' => auth()->user()->id,
                'process_status' => 'APPROVED',
                'approval_status' => 'APPROVED',
                'approval_process_description' => 'Approved ',
            ]);

            session()->flash('message',"successfully");
            DB::table('main_budget_pending')->where('budget_id',$id)->delete();

        }

        $this->mount();
    }
}
