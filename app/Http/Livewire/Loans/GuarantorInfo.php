<?php

namespace App\Http\Livewire\Loans;

use App\Models\MembersModel;
use Livewire\Component;



use App\Models\Clients;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\AccountsModel;
use App\Models\LoansModel;

class GuarantorInfo extends Component
{

    public $member;
    public $member_number;
    public $results;
    public $relationship = '';
    public $item = 100;
    public $product_number;





    public function render()
    {


        if($this->member_number){
            $this->member =      MembersModel::where('member_number', $this->member_number)->get();

        }
        else{
            $this->member = MembersModel::where('member_number', trim(LoansModel::where('id',Session::get('currentloanID'))->value('guarantor')))->get();

        }


//        }

        return view('livewire.loans.guarantor-info');

    }



    public function set()
    {
        if(DB::table('members')->where('member_number',$this->member_number)->exists()){


            LoansModel::where('id', Session::get('currentloanID'))->update([
                'guarantor' => $this->member_number,
                'relationship'=>$this->relationship
            ]);

            session()->flash('message','successfully');
        }
        else{
            session()->flash('alert-class','client number does not exists');
        }


    }

}
