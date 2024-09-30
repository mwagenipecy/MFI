<?php

namespace App\Http\Livewire\Loans;

use App\Models\MembersModel;
use Livewire\Component;



use App\Models\Clients;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\AccountsModel;
use App\Models\LoansModel;
use Livewire\WithFileUploads;


class GuarantorInfo extends Component
{
  use WithFileUploads;

    public $photo;

    public $collateral_type;
    public $collateral_description;
    public $collateral_location;
    public $loan;
    public $collateral_value;
    public $member;
    public $member_number;
    public $results;
    public $relationship = '';
    public $item = 100;
    public $product_number;




    public $fileUploads = [];
    public $collateral_category;
    public $description;
    public $CollateralID;
    public $ClientID;
    public $LoanID;
    public $type_of_owner;
    public $collateral_owner_full_name;
    public $collateral_owner_nida;
    public $collateral_owner_contact_number;
    public $collateral_owner_residential_address;
    public $collateral_owner_spouse_full_name;
    public $collateral_owner_spouse_nida;
    public $collateral_owner_spouse_contact_number;
    public $collateral_owner_spouse_residential_address;
    public $company_registered_name;
    public $business_licence_number;
    public $TIN;
    public $director_nida;
    public $director_contact;
    public $director_address;
    public $business_address;
    public $date_of_valuation;
   

   public $sub_tab_id=1;




    public $name, $dob, $nationality, $address, $phone, $email, $id_number, $employment_status;
    public $employer_details, $income, $assets, $liabilities, $credit_score, $guaranteeType, $loan_id;
    public $image;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'nationality' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'id_number' => 'required|string|max:20',
//        'employment_status' => 'required|string|max:50',
  //      'employer_details' => 'nullable|string|max:255',
        'income' => 'required|numeric|min:0',
    //    'assets' => 'nullable|numeric|min:0',
      //  'liabilities' => 'nullable|numeric|min:0',
     //   'credit_score' => 'required|numeric|between:300,850',
        'guaranteeType' => 'required|string|max:50',
     //   'loan_id' => 'required|exists:loans,id', // assuming loan ID exists in the loans table
        'image' => 'nullable|image|max:1024', // Limit file size to 1MB
    ];

    // Method to save the form data
    public function save()
    {
        // Validate form inputs
        $validatedData = $this->validate();
       $validatedData['loan_id']=session('currentloanID');
        // Store image if uploaded
        if ($this->image) {
            $imagePath = $this->image->store('guarantor_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Save the data into the database
        DB::table('guarantors')->insert($validatedData);

        // Reset form fields
        $this->reset();

        // Send a success message to the user
        session()->flash('message', 'Guarantor saved successfully.');
    }







    function menuItemClicked($id){

    $this->sub_tab_id=$id;
    }



       public function boot()
    {
        $this->CollateralID = $this->generateRandomId();



        $this->ClientID=DB::table('loans')->where('id',session('currentloanID'))->value('client_number');

    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function closeDropdown($id)
    {
        //dd($id);
        $this->user = $id;
        $this->LoanID =  $id;
        $member_number = DB::table('loans')->where('loan_id',$this->user)->value('member_number');
        $this->ClientID = $member_number;
        $this->clientName = DB::table('members')->where('member_number',$member_number)->value('first_name').' '.
            DB::table('members')->where('member_number',$member_number)->value('middle_name').' '.
            DB::table('members')->where('member_number',$member_number)->value('last_name')
        ;
        $this->isOpen = false;
    }

    public function generateRandomId() {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLetters = $letters[rand(0, 25)] . $letters[rand(0, 25)]; // Two random capital letters
        $randomDigits = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Six random digits
        return $randomLetters . $randomDigits;
    }



    public function saveCollateral()
    {
        try{

         //  $this->validate();

        $collateral = new CollateralModel();
        $collateral->collateral_category = $this->collateral_category;
        $collateral->collateral_type = $this->collateral_type;
        $collateral->description = $this->description;
        $collateral->collateral_id = $this->CollateralID;
        $collateral->main_collateral_type=session('main_collateral_type');
        $collateral->member_number = $this->ClientID;
        $collateral->account_id= "00";
        $collateral->client_id=$this->ClientID;
        $collateral->loan_id = $this->LoanID;
        $collateral->type_of_owner = $this->type_of_owner;
        $collateral->relationship = $this->relationship;
        $collateral->collateral_owner_full_name = $this->collateral_owner_full_name;
        $collateral->collateral_owner_nida = $this->collateral_owner_nida;
        $collateral->collateral_owner_contact_number = $this->collateral_owner_contact_number;
        $collateral->collateral_owner_residential_address = $this->collateral_owner_residential_address;
        $collateral->collateral_owner_spouse_full_name = $this->collateral_owner_spouse_full_name;
        $collateral->collateral_owner_spouse_nida = $this->collateral_owner_spouse_nida;
        $collateral->collateral_owner_spouse_contact_number = $this->collateral_owner_spouse_contact_number;
        $collateral->collateral_owner_spouse_residential_address = $this->collateral_owner_spouse_residential_address;
        $collateral->company_registered_name = $this->company_registered_name;
        $collateral->business_licence_number = $this->business_licence_number;
        $collateral->tin = $this->TIN;
        $collateral->director_nida = $this->director_nida;
        $collateral->director_contact = $this->director_contact;
        $collateral->director_address = $this->director_address;
        $collateral->business_address = $this->business_address;
        $collateral->collateral_value = $this->collateral_value;
        $collateral->date_of_valuation = $this->date_of_valuation;
        $collateral->valuation_method_used = $this->valuation_method_used;
        $collateral->name_of_valuer = $this->name_of_valuer;
        $collateral->policy_number = $this->policy_number;
        $collateral->company_name = $this->company_name;
        $collateral->coverage_details = $this->coverage_details;
        $collateral->expiration_date = $this->expiration_date;
        $collateral->disbursement_date = $this->disbursement_date;
        $collateral->tenure = $this->tenure;
        $collateral->interest = $this->interest;
        $collateral->loan_amount = $this->loan_amount;
        $collateral->physical_condition = $this->physical_condition;
        $collateral->approval_status = "PENDING";
        $collateral->region = $this->region;
        $collateral->district = $this->district;
        $collateral->ward = $this->ward;
        $collateral->postal_code = $this->postal_code;
        $collateral->address = $this->address;
        $collateral->building_number = $this->building_number;
        $collateral->current_status = 'un_perfected';

        $collateral->save();




        foreach ($this->fileUploads as $documentId => $file) {
            // If $file is an array (multiple files uploaded), loop through each file
            if (is_array($file)) {
                foreach ($file as $uploadedFile) {
                    $path = '';
                    if ($uploadedFile) {
                        $path = $uploadedFile->store('images', 'public');
                    }
                    // Insert the file path into the database
                    $Dates = null;
                    if(isset($this->ExpireDates[$documentId])){
                        $Dates = $this->ExpireDates[$documentId];
                    }
                    DB::table('document_records')->insert([
                        'document_id' => $documentId,
                        'file_path' => $path,
                        'expiration_date' => $Dates,
                        'collateral_id' => $this->CollateralID,
                    ]);
                }
            } else {
                // If $file is not an array, it should be a single UploadedFile instance
                $path = '';
                if ($file) {
                    $path = $file->store('images', 'public');
                }
                // Insert the file path into the database
                $Dates = null;
                if(isset($this->ExpireDates[$documentId])){
                    $Dates = $this->ExpireDates[$documentId];
                }
                DB::table('document_records')->insert([
                    'document_id' => $documentId,
                    'file_path' => $path,
                    'expiration_date' => $Dates,
                    'collateral_id' => $this->CollateralID,
                ]);
            }
        }



            session()->put('hasBusinessInformation',"YES");
        session()->flash('message_feedback', 'Collateral Record created successfully.');

        Log::info('An error occurred: '  );

        $this->reset(); // Clear form fields after successful save


    }catch(\Exception $e){
        session()->flash('message_feedback_fail', 'something went wrong on saving physical collaterals');

        Log::error('An error occurred: ' . $e->getMessage());

    }


    }



    public function render()
    {

	            $this->LoanID=session('currentloanID');
	    

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
