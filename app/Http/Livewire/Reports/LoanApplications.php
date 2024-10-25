<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class LoanApplications extends Component

{

    public $status,$branch,$endDate,$startDate,$aging;


    public function render()
    {
        return view('livewire.reports.loan-applications');
    }


    function resetAll(){
        $this->emit('changeBranch',null);
        $this->emit('changeEndDate',null);
        $this->emit('changeStartDate',null);
      //  $this->emit('changeAging',null);
        $this->emit('changeStatus',null);

    }
    function updatedBranch($branch){
        $this->emit('changeBranch',$branch);
    }


    function updatedEndDate($endDate){
        $this->emit('changeEndDate',$endDate);
    }


    function updatedStartDate($startDate){
        $this->emit('changeStartDate',$startDate);
    }


    // function updatedAging($aging){
    //     $this->emit('changeAging',$aging);
    // }


    function updatedStatus($status){
        $this->emit('changeStatus',$status);
    }


}
