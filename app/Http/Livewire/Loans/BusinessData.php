<?php

namespace App\Http\Livewire\Loans;

use Livewire\Component;


use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
use App\Models\Clients;
use App\Models\AccountsModel;
use App\Models\Branches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\loan_images;
use App\Models\LoansModel;

class BusinessData extends Component
{


    use WithFileUploads;

    public $photo;
    public $business_category;
    public $business_type;
    public $business_licence_number;
    public $business_tin_number;
    public $business_inventory;
    public $cash_at_hand;
    public $daily_sales;
    public $loan;
    public $business_name;

    public $cost_of_goods_sold;
    public $operating_expenses;
    public $monthly_taxes;
    public $other_expenses;
    public $business_age;


    public function formatedNumber($amount)
    {$amaunt= (int)$amount;

        return number_format($amount);
    }
    function updatedDailySales($amount)
    {$amaunt= (int)$amount;
        $this->amount= number_format($amaunt);

    }
    function updatedCashAtHand($amaunt)
    {$amaunt= (int)$amaunt;
        $this->cash_at_hand= number_format($amaunt);

    }
    function updatedBusinessInventory($amaunt)
    {$amaunt= (int)$amaunt;
        $this->business_inventory= number_format($amaunt);

    }
 function updatedCostOfGoodsSold($amaunt)
    {$amaunt= (int)$amaunt;
        $this->cost_of_goods_sold= number_format($amaunt);

    }
    function updatedOperatingExpenses($amaunt)
    {$amaunt= (int)$amaunt;
        $this->operating_expenses= number_format($amaunt);

    }  function updatedMonthlyTaxes($amaunt)
    {$amaunt= (int)$amaunt;
        $this->monthly_taxes= number_format($amaunt);

    }
    function updatedOtherExpenses($amaunt)
    {$amaunt= (int)$amaunt;
        $this->other_expenses= number_format($amaunt);

    }

    function removeNumberFormat($amount)
    {
        return (float) str_replace(',', '', $amount);
    }

    public function boot()
    {
        $this->loan = LoansModel::where('id',Session::get('currentloanID'))->get();
        foreach ($this->loan as $theloan){
            $this->business_name = $theloan->business_name;
            $this->business_category=$theloan->business_category;
            $this->business_type=$theloan->business_type;
            $this->business_licence_number=$theloan->business_licence_number;
            $this->business_tin_number=$theloan->business_tin_number;
            $this->business_inventory=$this->formatedNumber($theloan->business_inventory);
            $this->cash_at_hand= $this->formatedNumber($theloan->cash_at_hand);
            $this->daily_sales= $this->formatedNumber($theloan->daily_sales);

            $this->cost_of_goods_sold=$this->formatedNumber($theloan->cost_of_goods_sold);

            $this->operating_expenses= $this->formatedNumber($theloan->operating_expenses);
            $this->monthly_taxes=$this->formatedNumber( $theloan->monthly_taxes);
            $this->other_expenses= $this->formatedNumber($theloan->other_expenses);

            $this->business_age=$theloan->business_age;
        }


    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',// 1MB Max
        ]);
    }


    public function render()
    {

        $this->cash_at_hand=$this->removeNumberFormat($this->cash_at_hand);
        $this->daily_sales=$this->removeNumberFormat($this->daily_sales);
        $this->cost_of_goods_sold=$this->removeNumberFormat($this->cost_of_goods_sold);
        $this->operating_expenses=$this->removeNumberFormat($this->operating_expenses);
        $this->monthly_taxes=$this->removeNumberFormat($this->monthly_taxes);
        $this->business_age=$this->removeNumberFormat($this->business_age);
        $this->other_expenses=$this->removeNumberFormat($this->other_expenses);
        
        LoansModel::where('id',Session::get('currentloanID'))->update([
            'business_name'=>$this->business_name,
            'business_category'=>$this->business_category,
            'business_type'=>$this->business_type,
            'business_licence_number'=>$this->business_licence_number,
            'business_tin_number'=>$this->business_tin_number,
            'business_inventory'=>$this->business_inventory,
            'cash_at_hand'=>$this->cash_at_hand,
            'daily_sales'=>$this->daily_sales,

            'cost_of_goods_sold'=>$this->cost_of_goods_sold,
            'operating_expenses'=>$this->operating_expenses,
            'monthly_taxes'=>$this->monthly_taxes,
            'business_age'=>$this->business_age,
            'other_expenses'=>$this->other_expenses

        ]);

        return view('livewire.loans.business-data');
    }

    public function close($loanimageID){
        loan_images::find($loanimageID)->delete();
    }

    public function saveImage(){



        $loan_id = LoansModel::where('id', Session::get('currentloanID'))->value('loan_id');
        //$imageUrl = $this->photo->store('avatars', 'public');
        $filename = time().'_'.$this->photo->getClientOriginalName();

        // Store the file in the 'public' disk under the 'Saccoss-request' directory
        $this->photo->storeAs('storage', $filename, 'public');

        // Save the file path
        $imageUrl = '/app/public/storage/'.$filename;



//        $loan_id = LoansModel::where('id',Session::get('currentloanID'))->value('loan_id');
//        //$imageUrl = $this->photo->store('avatars', 'public');
//        $path = $this->photo->store('photos', 'local');
//        $path = str_replace("photos/", "", $path);
//        $imageUrl = 'storage/' . $path;



        loan_images::create([
            'loan_id' => $loan_id,
            'category' => 'business',
            'url' => $imageUrl,

        ]);
        $this->photo = null;
    }
}
