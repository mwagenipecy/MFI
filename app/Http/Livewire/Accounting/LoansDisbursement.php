<?php

namespace App\Http\Livewire\Accounting;

use App\Models\ClientsModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LoansDisbursement extends Component
{

    protected $listeners = ['currentloanID' => '$refresh',
                             'viewMemberDetails'=>'memberDetails',
                    ];
     public  $viewMemberDetail=false;
     public $member;
     public $member_number;




    public function close(){
        $this->viewMemberDetail=false;
        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
    }


    public function memberDetails(){
        $this->viewMemberDetail=True;
    }



    public function render()
    {
        $this->member_number = Session::get('currentloanMember');
        $this->member = ClientsModel::where('client_number', Session::get('currentloanMember'))->get();

        return view('livewire.accounting.loans-disbursement');
    }

    public  function showModal(){

       return true;
    }
}
