<?php

namespace App\Http\Livewire\ProfileSetting;

use App\Models\approvals;
use App\Models\institutions;
use App\Models\Partner;
use App\Models\InstitutionsList;
use App\Models\TeamUser;
use http\Client\Curl\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Schema;


class OrganizationSetting extends Component
{

    use WithFileUploads;
    public $registration_fees;
    public $allocated_shares;
    public $profit_account;
    public $institution_name;
    public $region;
    public $wilaya;
    public $partner_name;
    public $mirror_account;
    public $partner_email;
    public $settings_status;
    public $min_shares;
    public $value_per_share;
    public $email;
    public $phone_number;
    public $revenue_account;
    public $repayment_frequency;
    public $notes;
    public $amount;
    public $operation_account;
    public $startDate;
    public $budget_approval_letter;
    public $openOne = false;
    public $partners;

    public institutions $institution;



    protected $rules= ['institution.profit_account'=>'required',
                         'institution.region'=>'required',
                         'institution.wilaya'=>'required',
                         'institution.amount'=>'required',
                         'institution.revenue_account'=>'required',
                         'institution.name'=>'required|string',
                         'institution.operation_account'=>'required',
                         'institution.manager_email'=>'required',
//                         'institution.repayment_frequency'=>'required',
                         'institution.phone_number'=>'required',
//                         'institution.settings_status'=>'nullable',
                         'institution.startDate'=>'nullable',
//                          'institution.notes'=>'nullable'

                         ];

    public function institutionSetting(){

//        dd($this->all());
        $this->validate();
        $this->institution->save();

        approvals::create([
            'institution' =>1,
            'process_name' => "editOrganizationSetting",
            'process_description' =>'organization settings has  edited',
            'approval_process_description' => "edit organization settings",
            'process_code' => '102',
            'process_id' => 1,
            'process_status' => 'Pending',
            'user_id'  => auth()->user()->id,
            'team_id'  => "",
            'edit_package'=>json_encode($this->all()),
        ]);

        session()->flash('message','Awaiting for approval');


    }


    public function render()
    {

        $this->partners=Partner::get();
        return view('livewire.profile-setting.organization-setting');
    }

    function registerPartner()
    {
        $this->validate([
           'partner_name'=>'required',
            'mirror_account'=>'required|unique:accounts',
            'partner_email'=>'required|email',

        ]);

        DB::beginTransaction();

        try{

       $partner_id=  Partner::create([
            'partner_name'=>$this->partner_name,
            'mirror_account'=>$this->mirror_account,
            'partner_email'=>$this->partner_email,
        ])->id;

        if (Schema::hasTable('organization_partners')) {
            $sub_category_id=DB::table('organization_partners')->max('id');
            $sub_category_code=DB::table('organization_partners')->where('id',$sub_category_id)->value('sub_category_code');
            $sub_category_code=(int)$sub_category_code+1;
        } else {
            Schema::create('organization_partners', function ($table) {
                $table->id();
                $table->string('category_code')->nullable();
                $table->string('sub_category_code')->nullable();
                $table->string('sub_category_name')->nullable();
                $table->timestamps();
            });

            $sub_category_code=1801;
            $sub_category_id=1;
        }

        DB::table('organization_partners')->insert([
          'category_code'=>1800,
            'sub_category_code'=>$sub_category_code,
            'sub_category_name'=>$this->partner_name,
        ]);


        // create account for partner
        $account_number= str_pad($partner_id, 2, 0, STR_PAD_LEFT) . '' . str_pad($sub_category_id, 2, 0, STR_PAD_LEFT) . '0000' . $sub_category_code;

        //insert data to account table
     $id=   DB::table('accounts')->insertGetId([
            'account_number'=>$account_number,
            'mirror_account'=>$this->mirror_account,
            'branch_number'=>auth()->user()->branch,
            'client_number'=>0000,
            'account_use'=>'internal',
            'sub_product_number'=>$sub_category_code,
            'major_category_code'=>1000,
            'category_code'=>1800,
            'account_name'=>strtoupper($this->partner_name),
            'balance'=>0,
            'account_status'=>'ACTIVE',

        ]);

         Partner::where('id',$partner_id)->update(['account_number'=>$id]);

        session()->flash('message','successfully created, account number'.$account_number);

         DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
            session()->flash('message_fail','oohps something went wrong'.$e->getMessage());
            return $e->getMessage();
        }
        finally {
            $this->flashFunctionData();

        }
    }

    function flashFunctionData()
    {
        $this->partner_name=null;
        $this->mirror_account=null;
        $this->partner_email=null;
    }
    public function mount(){


        $this->institution= institutions::findOrFail(1) ;

        $startDate = Carbon::parse($this->institution->startDate);

        // Calculate the end of the financial year (one year later)
        $endOfFinancialYearFormatted = $startDate->copy()->addYear()->endOfMonth();

        $this->startDate=$endOfFinancialYearFormatted;

    }


    public function store()
    {
        //dd($this->budget_approval_letter);
        $this->validate([
            'budget_approval_letter' => 'nullable|mimes:pdf|max:1024', // 1MB Max
        ]);

        $path = $this->budget_approval_letter->store('uploads'); // Store the file in the "uploads" directory

        // Insert the file information into the institution_files table
        DB::table('institution_files')->insert([
            'institution_id' => "", // Assuming you have an institution ID in your Livewire component
            'file_name' => $this->budget_approval_letter->getClientOriginalName(), // Original file name
            'description' => "", // Description of the file (assuming you have a description property in your Livewire component)
            'file_path' => $path, // Stored file path
            'file_id' => "1", // Assuming you have a file ID in your Livewire component
            'upload_date' => now(), // Current timestamp
        ]);

        $this->reset('budget_approval_letter');


    }

    public function openCloseOne()
    {
        if($this->openOne)
        {
            $this->openOne = false;
        }else{
            $this->openOne = true;
        }
    }

}
