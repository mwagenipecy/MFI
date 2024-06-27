<?php

namespace App\Http\Livewire\ProfileSetting;


use App\Models\LeaderShipModel;

use App\Models\LoansModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LeaderShip extends Component
{
    public $register_new_saccos_leader=false;
    public $full_name;
    public $position;
    public $endDate;
    public $approval_option;
    public $leaderDescriptions;
    public $image;



    protected $rules=[
        'full_name'=>'required',
        'position'=>'required',
//        'leaderShip.startDate'=>'required',
        'endDate'=>'required',
            'approval_option'=>'required',
        'leaderDescriptions'=>'required',
//        'image'=>'required|mimes:png,jpg'
    ];


    public function resetLeaderData(){
        $this->full_name=null;
        $this->endDate=null;
        $this->leaderDescriptions=null;
        $this->approval_option=null;

    }

    public function newLeaderModal(){
        if($this->register_new_saccos_leader==false){
            $this->register_new_saccos_leader=true;


        }
    }



    public function save(){
        $this->validate();

        LeaderShipModel::create([
            'full_name'=> strtoupper($this->full_name),
            'position'=>strtoupper($this->position),
             'endDate'=>$this->endDate,
            'institution_id'=>auth()->user()->institution_id,
            'approval_option'=>$this->approval_option,
//            'image'=>$this->image?:null,
        ]);

        session()->flash('message','successfully');
        $this->resetLeaderData();


    }







    public function render()
    {
        return view('livewire.profile-setting.leader-ship');
    }
}
