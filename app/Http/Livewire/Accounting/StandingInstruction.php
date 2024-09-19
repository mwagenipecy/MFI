<?php

namespace App\Http\Livewire\Accounting;

use App\Models\approvals;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Role;


class StandingInstruction extends Component
{
    public $tab_id=1;
public $new_stannding_order=false;
public $source_account_number;
public $destination_type;
public $amount;
public $destination_account_number;
public $action_date;
public $end_date;
public $description;
public $member_number;


protected $rules=[
   'amount'=>'required|numeric',
   'source_account_number'=>'required|string',
   'destination_account_number'=>'required|string',
    'end_date'=>'required|date',
    'action_date'=>'required|date',
];


public function menuItemClicked(){
    if($this->new_stannding_order==false){
        $this->new_stannding_order=true;
    }
}

public function save(){
  $this->validate();

   $id=DB::table('standing_instructions')->insertGetId([
      'amount'=>$this->amount,
      'destination_account_number'=>$this->destination_account_number,
      'source_account_number'=>$this->source_account_number,
      'action_date'=>$this->action_date,
      'status'=>"PENDING",
      'end_date'=>$this->end_date,
      'member_number'=>$this->member_number,
      'description'=>$this->description
  ]);


  $approval= new approvals();
  $approval->sendApproval($id,'createStandingOrder','has created standing order','new standing order','12','');

  session()->flash('message',"successfully saved");
  $this->emit('refresh');
  $this->reset();

}


    public function render()
    {
        return view('livewire.accounting.standing-instruction');
    }
}
