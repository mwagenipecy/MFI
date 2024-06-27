<?php

namespace App\Http\Livewire\Accounting;

use App\Models\Members;
use App\Models\LoansModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LoansDisbursement extends Component
{

    protected $listeners = ['currentloanID' => '$refresh',
        'viewMemberDetails'=>'memberDetails',

        'selectPartner'=>'selectPartner'
    ];
    public  $viewMemberDetail=false;
    public $member;
    public $loan_id;
    public $selectedId;
    public $partner_accounts;
    public $partner_account;

    public $showPartnerList=false;


    function selectPartner($id)
    {

        $this->selectedId=$id;
        $this->showPartnerList=true;
    }

    function approvalAndDisburse()
    {
//        $this->validate([
//           'partner_account'=>'required|numeric|exists:accounts,id',
//        ]);

        $this->emit( 'approvalAndDisburse', $this->selectedId);

    }

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
        $this->partner_accounts=DB::table('accounts')->where('category_code',1000)->get();
        $this->loan_id = Session::get('currentloanID');
        $this->member = LoansModel::where('loan_id',Session::get('currentloanID'))->get();


        return view('livewire.accounting.loans-disbursement');
    }

    public  function showModal(){

        return true;
    }
}
