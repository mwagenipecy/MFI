<?php

namespace App\Http\Livewire\Members;

use App\Models\MembersModel;
use App\Models\Employee;
use App\Models\LoansModel;
use App\Models\PendingRegistration;
use App\Models\TeamUser;
use App\Models\User;
use App\Mail\LoanProgress;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\approvals;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;


class Members extends Component
{
    use WithFileUploads;

    public $tab_id = '1';
    public $title = 'Members list';
    public $selected;
    public $activeMembersCount;
    public $inactiveMembersCount;
    public $showCreateNewMember;
    public $membershipNumber;
    public $parentMember;
    public $showDeleteMember;
    public $memberSelected;
    public $showEditMember;
    public $pendingMember;
    public $MembersList;
    public $pendingMembername;
    public $member;
    public $showAddMember;
    public $nationarity;
    public $boda_number;
    public $member_number;
    public $tawi;
    public $next_of_kin_relationship;


    public $email;
    public $Member_status;
    public $permission = 'BLOCKED';
    public $password;

    public $photo;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $branch;
    public $registering_officer;
    public $supervising_officer;
    public $approving_officer;
    public $membership_type;
    public $incorporation_number;
    public $phone_number;
    public $mobile_phone_number;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $membership_number;
    public $registration_date;
    public $ward;
    public $iteration;
    public $address;
    public $notes;
    public $current_team_id;
    public $profile_photo_path;
    public $branch_id;
    public $business_name;
    public $name;
    public $loan_officer;

    public $confirmingUserDeletion = false;
    public $branches;


    public $sub_product_number_shares ='1199';
    public $sub_product_number_savings='1279';
    public $sub_product_number_deposits='1321';
    public $place_of_birth;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $tin_number;
    public $nida_number;
    public $member_status;
    public $ref_number;
    public $shares_ref_number;
    public $member_exit_document;
    public $personal_identification;
    public $local_government_letter;
    public $motorcycle_card;
    public $motorcycle_contract;
    public $is_owner;

    // vie members modal
    public $viewMemberDetails=false;
    public $loanStatus;


    public $account_number;
    public $institution_id;



    public $created_at;
    public $updated_at;

    public $end_membership_description;
    public $amount;
    public $national_id;
    public $member_id;
    public $customer_code;
    public $present_surname;
    public $birth_surname;
    public $number_of_spouse;
    public $number_of_children;
    public $classification_of_individual;

    public $country_of_birth;
    public $fate_status;
    public $social_status;
    public $residency;
    public $citizenship;
    public $nationality;
    public $employment;
    public $employer_name;
    public $education;
    public $income_available;
    public $monthly_expenses;
    public $negative_status_of_individual;
    public $tax_identification_number;
    public $passport_number;
    public $passport_issuer_country;
    public $driving_license_number;
    public $voters_id;
    public $foreign_unique_id;
    public $custom_id_number_1;
    public $custom_id_number_2;
    public $main_address;
    public $number_of_building;
    public $postal_code;
    public $region;
    public $district;
    public $country;
    public $viewpaid = false;
    public $viewnotpaid = false;
    public $allMembers = true;
    public $mobile_phone;
    public $fixed_line;
    public $web_page;
    public $trade_name;
    public $legal_form;
    public $establishment_date;
    public $registration_country;
    public $industry_sector;
    public $registration_number;
    public $variables;
    public $middle_names;
    public $viewMemberLoanData=false;




    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockMember' => 'blockMemberModal',
        'editMember' => 'editMemberModal',
        'viewMemberDetails'=>'viewMemberDetails',
        'viewMemberLoans'=>'viewMemberLoan'
    ];

    protected $rules = [
        'account_number' => 'nullable|integer',
        'institution_id' => 'nullable|string|max:255',
        'first_name' => 'nullable|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'branch' => 'nullable|string|max:255',
        'registering_officer' => 'nullable|string|max:255',
        'loan_officer' => 'nullable|string|max:255',
        'approving_officer' => 'nullable|string|max:255',
        'membership_type' => 'nullable|string|max:255',
        'incorporation_number' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:255',
        'mobile_phone_number' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:255',
        'place_of_birth' => 'nullable|string|max:255',
        'marital_status' => 'nullable|string|max:255',

        'registration_date' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'notes' => 'nullable|string|max:255',
        'current_team_id' => 'nullable|integer',
        'profile_photo_path' => 'nullable|string|max:255',
        'branch_id' => 'nullable|string|max:255',
        'member_status' => 'required|string|max:255',
        'next_of_kin_name' => 'nullable|string|max:255',
        'next_of_kin_phone' => 'nullable|string|max:255',
        'tin_number' => 'nullable|string|max:255',
        'nida_number' => 'nullable|string|max:255',
        'ref_number' => 'nullable|string|max:255',
        'shares_ref_number' => 'nullable|string|max:255',
        'nationarity' => 'nullable|string|max:30',
        'member_exit_document' => 'nullable|string|max:200',
        'end_membership_description' => 'nullable|text',
        'amount' => 'nullable|numeric',
        'national_id' => 'nullable|string|max:30',
        'member_id' => 'nullable|integer',
        'customer_code' => 'nullable|string|max:255',
        'present_surname' => 'nullable|string|max:255',
        'birth_surname' => 'nullable|string|max:255',
        'number_of_spouse' => 'nullable|integer',
        'number_of_children' => 'nullable|integer',
        'classification_of_individual' => 'nullable|string|max:255',
        'gender' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'country_of_birth' => 'nullable|string|max:255',
        'fate_status' => 'nullable|string|max:255',
        'social_status' => 'nullable|string|max:255',
        'residency' => 'nullable|string|max:255',
        'citizenship' => 'nullable|string|max:255',
        'nationality' => 'nullable|string|max:255',
        'employment' => 'nullable|string|max:255',
        'employer_name' => 'nullable|string|max:255',
        'education' => 'nullable|string|max:255',
        'business_name' => 'nullable|string|max:255',
        'income_available' => 'nullable|string|max:255',
        'monthly_expenses' => 'nullable|string|max:255',
        'negative_status_of_individual' => 'nullable|string|max:255',
        'tax_identification_number' => 'nullable|string|max:255',
        'passport_number' => 'nullable|string|max:255',
        'passport_issuer_country' => 'nullable|string|max:255',
        'driving_license_number' => 'nullable|string|max:255',
        'voters_id' => 'nullable|string|max:255',
        'foreign_unique_id' => 'nullable|string|max:255',
        'custom_id_number_1' => 'nullable|string|max:255',
        'custom_id_number_2' => 'nullable|string|max:255',
        'main_address' => 'nullable|string|max:255',
        'ward' => 'nullable|string|max:255',
        'number_of_building' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:255',
        'region' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'mobile_phone' => 'nullable|string|max:255',
        'fixed_line' => 'nullable|string|max:255',
        'web_page' => 'nullable|string|max:255',
        'trade_name' => 'nullable|string|max:255',
        'legal_form' => 'nullable|string|max:255',
        'establishment_date' => 'nullable|date',
        'registration_country' => 'nullable|string|max:255',
        'industry_sector' => 'nullable|string|max:255',
        'registration_number' => 'nullable|string|max:255',
        'boda_number' => 'nullable|string|max:255',
        'tawi' => 'nullable|string|max:255',
        'next_of_kin_relationship' => 'nullable|string|max:255',
        'member_number' => 'nullable|string|max:255',
        'personal_identification' => 'nullable|file|mimes:pdf,doc,docx',
        'local_government_letter' => 'nullable|file|mimes:pdf,doc,docx',
        'is_owner' => 'nullable|string|in:yes,no',
        'motorcycle_card' => 'nullable|file|mimes:pdf,doc,docx',
        'motorcycle_contract' => 'nullable|file|mimes:pdf,doc,docx',

    ];

    public function viewPaidMembers(){
        $this->viewpaid = true;
        $this->viewnotpaid =false;
        $this->allMembers =false;

    }

    public function viewNotPaidMembers(){
        $this->viewnotpaid =true;
        $this->viewpaid = false;
        $this->allMembers = false;
    }

    public function viewAllMembers(){
        $this->allMembers = true;
        $this->viewnotpaid =false;
        $this->viewpaid = false;
    }



    public function viewMemberLoan($member_number){

        $this->viewMemberDetails=true;
        $this->viewMemberLoanData=true;
        session()->put('viewMemberLoan',$member_number);
    }

    public function closeLoanData(){
        $this->viewMemberDetails=false;
        $this->viewMemberLoanData=false;
    }


    public function viewMemberDetails(){

//        dd(session()->get('memberToViewId'));
        $id=session()->get('memberToViewId');
        session()->put('viewMemberId',$id);
        $member_number=DB::table('members')->where('id',$id)->value('member_number');
        $this->loanStatus=DB::table('loans')->where('member_number',$member_number)->get();

        $this->viewMemberDetails=true;
    }




    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|mimes:png,jpg,jpeg|max:1024', // 1MB Max
        ]);

        $filename = time() . '_' . $this->photo->getClientOriginalName(); // Corrected method name

//        $this->photo->storeAs('memberPhotos', $filename, 'public');
//        $this->profile_photo_path = 'memberPhotos/' . $filename;
        $this->profile_photo_path = $this->photo->store('memberPhotos', 'public');
//        dd($this->profile_photo_path);
    }


    public function showAddMemberModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showAddMember = true;
    }


    public function updatedMember()
    {
        $memberData = MembersModel::where('id', $this->member)->get();
        foreach ($memberData as $member) {
            $this->id = $member->id;
            $this->account_number = $member->account_number;
            $this->institution_id = $member->institution_id;
            $this->first_name = $member->first_name;
            $this->middle_name = $member->middle_name;
            $this->last_name = $member->last_name;
            $this->branch = $member->branch;
            $this->registering_officer = $member->registering_officer;
            $this->loan_officer = $member->loan_officer;
            $this->approving_officer = $member->approving_officer;
            $this->membership_type = $member->membership_type;
            $this->incorporation_number = $member->incorporation_number;
            $this->phone_number = $member->phone_number;
            $this->mobile_phone_number = $member->mobile_phone_number;
            $this->email = $member->email;
            $this->place_of_birth = $member->place_of_birth;
            $this->marital_status = $member->marital_status;

            $this->registration_date = $member->registration_date;
            $this->address = $member->address;
            $this->notes = $member->notes;
            $this->current_team_id = $member->current_team_id;
            $this->profile_photo_path = $member->profile_photo_path;
            $this->branch_id = $member->branch_id;
            $this->member_status = $member->member_status;
            $this->next_of_kin_name = $member->next_of_kin_name;
            $this->next_of_kin_phone = $member->next_of_kin_phone;
            $this->tin_number = $member->tin_number;
            $this->nida_number = $member->nida_number;
            $this->ref_number = $member->ref_number;
            $this->shares_ref_number = $member->shares_ref_number;
            $this->created_at = $member->created_at;
            $this->updated_at = $member->updated_at;
            $this->nationarity = $member->nationarity;
            $this->member_exit_document = $member->member_exit_document;
            $this->end_membership_description = $member->end_membership_description;
            $this->amount = $member->amount;
            $this->national_id = $member->national_id;
            $this->member_id = $member->member_id;
            $this->customer_code = $member->customer_code;
            $this->present_surname = $member->present_surname;
            $this->birth_surname = $member->birth_surname;
            $this->number_of_spouse = $member->number_of_spouse;
            $this->number_of_children = $member->number_of_children;
            $this->classification_of_individual = $member->classification_of_individual;
            $this->gender = $member->gender;
            $this->date_of_birth = $member->date_of_birth;
            $this->country_of_birth = $member->country_of_birth;
            $this->fate_status = $member->fate_status;
            $this->social_status = $member->social_status;
            $this->residency = $member->residency;
            $this->citizenship = $member->citizenship;
            $this->nationality = $member->nationality;
            $this->employment = $member->employment;
            $this->employer_name = $member->employer_name;
            $this->education = $member->education;
            $this->business_name = $member->business_name;
            $this->income_available = $member->income_available;
            $this->monthly_expenses = $member->monthly_expenses;
            $this->negative_status_of_individual = $member->negative_status_of_individual;
            $this->tax_identification_number = $member->tax_identification_number;
            $this->passport_number = $member->passport_number;
            $this->passport_issuer_country = $member->passport_issuer_country;
            $this->driving_license_number = $member->driving_license_number;
            $this->voters_id = $member->voters_id;
            $this->foreign_unique_id = $member->foreign_unique_id;
            $this->custom_id_number_1 = $member->custom_id_number_1;
            $this->custom_id_number_2 = $member->custom_id_number_2;
            $this->main_address = $member->main_address;
            $this->ward = $member->ward;
            $this->number_of_building = $member->number_of_building;
            $this->postal_code = $member->postal_code;
            $this->region = $member->region;
            $this->district = $member->district;
            $this->country = $member->country;
            $this->mobile_phone = $member->mobile_phone;
            $this->fixed_line = $member->fixed_line;
            $this->web_page = $member->web_page;
            $this->trade_name = $member->trade_name;
            $this->legal_form = $member->legal_form;
            $this->establishment_date = $member->establishment_date;
            $this->registration_country = $member->registration_country;
            $this->industry_sector = $member->industry_sector;
            $this->registration_number = $member->registration_number;
            $this->boda_number = $member->boda_number;
            $this->tawi = $member->tawi;
            $this->member_number = $member->member_number;
            $this->next_of_kin_relationship = $member->next_of_kin_relationship;
        }
    }


    public function updateMember()
    {


        //$this->validate(['first_name'=>'required','middle_name'=>'required','last_name'=>'required','branch'=>'required','membership_type'=>'required','phone_number'=>'required','email'=>'required','date_of_birth'=>'required','gender'=>'required','marital_status'=>'required','ward'=>'required','address'=>'required','next_of_kin_name'=>'required','next_of_kin_phone'=>'required']);

        MembersModel::where('id', $this->member)->update([
            'updated_at' => now(),
            'account_number' => $this->account_number,
            'institution_id' => $this->institution_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'branch' => $this->branch,
            'registering_officer' => $this->registering_officer,
            'loan_officer' => $this->loan_officer,
            'approving_officer' => $this->approving_officer,
            'membership_type' => $this->membership_type,
            'incorporation_number' => $this->incorporation_number,
            'phone_number' => $this->phone_number,
            'mobile_phone_number' => $this->mobile_phone_number,
            'email' => $this->email,
            'place_of_birth' => $this->place_of_birth,
            'marital_status' => $this->marital_status,
            'registration_date' => $this->registration_date,
            'address' => $this->address,
            'notes' => $this->notes,
            'current_team_id' => $this->current_team_id,
            'profile_photo_path' => $this->profile_photo_path,
            'branch_id' => $this->branch_id,
            'next_of_kin_name' => $this->next_of_kin_name,
            'next_of_kin_phone' => $this->next_of_kin_phone,
            'next_of_kin_relationship' => $this->next_of_kin_relationship,
            'tin_number' => $this->tin_number,
            'nida_number' => $this->nida_number,
            'ref_number' => $this->ref_number,
            'shares_ref_number' => $this->shares_ref_number,
            'nationarity' => $this->nationarity,
            'member_exit_document' => $this->member_exit_document,
            'end_membership_description' => $this->end_membership_description,
            'amount' => $this->amount,
            'national_id' => $this->national_id,
            'customer_code' => $this->customer_code,
            'present_surname' => $this->present_surname,
            'birth_surname' => $this->birth_surname,
            'number_of_spouse' => $this->number_of_spouse,
            'number_of_children' => $this->number_of_children,
            'classification_of_individual' => $this->classification_of_individual,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'country_of_birth' => $this->country_of_birth,
            'fate_status' => $this->fate_status,
            'social_status' => $this->social_status,
            'residency' => $this->residency,
            'citizenship' => $this->citizenship,
            'nationality' => $this->nationality,
            'employment' => $this->employment,
            'employer_name' => $this->employer_name,
            'education' => $this->education,
            'business_name' => $this->business_name,
            'income_available' => $this->income_available,
            'monthly_expenses' => $this->monthly_expenses,
            'negative_status_of_individual' => $this->negative_status_of_individual,
            'tax_identification_number' => $this->tax_identification_number,
            'passport_number' => $this->passport_number,
            'passport_issuer_country' => $this->passport_issuer_country,
            'driving_license_number' => $this->driving_license_number,
            'voters_id' => $this->voters_id,
            'foreign_unique_id' => $this->foreign_unique_id,
            'custom_id_number_1' => $this->custom_id_number_1,
            'custom_id_number_2' => $this->custom_id_number_2,
            'main_address' => $this->main_address,
            'ward' => $this->ward,
            'number_of_building' => $this->number_of_building,
            'postal_code' => $this->postal_code,
            'region' => $this->region,
            'district' => $this->district,
            'country' => $this->country,
            'mobile_phone' => $this->mobile_phone,
            'fixed_line' => $this->fixed_line,
            'web_page' => $this->web_page,
            'trade_name' => $this->trade_name,
            'legal_form' => $this->legal_form,
            'establishment_date' => $this->establishment_date,
            'registration_country' => $this->registration_country,
            'industry_sector' => $this->industry_sector,
            'registration_number' => $this->registration_number,
            'boda_number' => $this->boda_number,
            'tawi' => $this->tawi,
            'member_number' => $this->member_number,
        ]);

//        dd(1);
        //$this->sendApproval($id,'has edited member information','12');
        //$this->sendApproval($id,Auth::user()->name.' has updated member information','12','updateMember');

        $this->resetData();

        Session::flash('message', ' successfully updated!');
        Session::flash('alert-class', 'alert-success');

        sleep(2);
        $this->showEditMember = false;

    }


    public function addMember()
    {
        // Define the validation rules based on membership type
//        if ($this->membership_type == "Individual") {
//            $this->validate([
//                'first_name'=> 'required|min:3',
//                'last_name'=> 'required|min:3',
//                'membership_type'=> 'required|min:3',
//                'phone_number'=>'required',
//                'personal_identification' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Example file validation rule
//                'local_government_letter' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Example file validation rule
//            ]);
//        } else {
//            $this->validate([
//                'membership_type'=> 'required|min:3',
//                'incorporation_number'=> 'required|min:3|unique:members',
//                'ward'=> 'required|min:3',
//                'address' => 'required|min:3',
//                'notes' => 'required|min:3',
//                'business_name' => 'required|min:3',
//                'branch' => 'required|min:1',
//                'phone_number'=>'required',
//                'personal_identification' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Example file validation rule
//                'local_government_letter' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Example file validation rule
//            ]);
//        }

//        try {
            // Handle file uploads
            $personal_identification_path = $this->personal_identification ? $this->personal_identification->store('attachments/personal_identifications', 'public') : null;
            $local_government_letter_path = $this->local_government_letter ? $this->local_government_letter->store('attachments/local_government_letters', 'public') : null;
            $motorcycle_card_path = ($this->is_owner === 'yes' && $this->motorcycle_card) ? $this->motorcycle_card->store('attachments/motorcycle_cards', 'public') : null;
            $motorcycle_contract_path = ($this->is_owner === 'no' && $this->motorcycle_contract) ? $this->motorcycle_contract->store('attachments/motorcycle_contracts', 'public') : null;

//            dd($personal_identification_path, $local_government_letter_path, $motorcycle_card_path, $motorcycle_contract_path);

        $last_member= \App\Models\MembersModel::latest()->first();
        if($last_member){
            $last_member_id = $last_member->id;
            $last_member_id = $last_member_id  + 1;
            //$newMemberId = Session::get('branchIdInView').str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }else{
            $last_member_id = 0;
            $last_member_id = $last_member_id  + 1;
            //$newMemberId = Session::get('branchIdInView').str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }
        $newMemberId = time();
        $this->account_number =  AccountsModel::create([
                'account_use' => 'external',
                'institution_number'=> '1001',
                'branch_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT),
                'member_number'=> $newMemberId,
                'product_number'=> '12',
                'sub_product_number'=> $this->sub_product_number_savings,
                'category_code'=> '1200',
                'major_category_code'=>'1000',
                'sub_category_code'=> '1210',
                'account_name'=> $this->first_name.' '.$this->middle_name.' '.$this->last_name,
                'account_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT).'121'.str_pad($last_member_id, 5, '0', STR_PAD_LEFT),

            ])->id;

        $account_number2=str_pad($this->branch, 2, '0', STR_PAD_LEFT).'122'.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);
        $idy =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=>'1000',
            'branch_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $newMemberId,
            'category_code'=> '2200',
            'product_number'=> '10000',
            'major_category_code'=>'2000',
            'sub_product_number'=> '10001',
            'sub_category_code'=> '2220',
            'account_name'=>$this->first_name.' '.$this->middle_name.' '.$this->last_name,
            'account_number'=> $account_number2,

        ])->id;



            // Create a new member
            $id = MembersModel::create([
                'account_number' => $this->account_number,
                'member_savings_account' => $idy,
                'institution_id' => $this->institution_id,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'branch' => $this->branch,
                'registering_officer' => $this->registering_officer,
                'loan_officer' => $this->loan_officer,
                'approving_officer' => $this->approving_officer,
                'membership_type' => $this->membership_type,
                'incorporation_number' => $this->incorporation_number,
                'phone_number' => $this->phone_number,
                'mobile_phone_number' => $this->mobile_phone_number,
                'email' => $this->email,
                'place_of_birth' => $this->place_of_birth,
                'marital_status' => $this->marital_status,

                'registration_date' => $this->registration_date,
                'address' => $this->address,
                'notes' => $this->notes,
                'current_team_id' => $this->current_team_id,
                'profile_photo_path' => $this->profile_photo_path,
                'branch_id' => $this->branch_id,
                'next_of_kin_name' => $this->next_of_kin_name,
                'next_of_kin_phone' => $this->next_of_kin_phone,
                'next_of_kin_relationship' => $this->next_of_kin_relationship,
                'tin_number' => $this->tin_number,
                'nida_number' => $this->nida_number,
                'ref_number' => $this->ref_number,
                'shares_ref_number' => $this->shares_ref_number,
                'nationarity' => $this->nationarity,
                'member_exit_document' => $this->member_exit_document,
                'end_membership_description' => $this->end_membership_description,
                'amount' => $this->amount,
                'national_id' => $this->national_id,
                'customer_code' => $this->customer_code,
                'present_surname' => $this->present_surname,
                'birth_surname' => $this->birth_surname,
                'number_of_spouse' => $this->number_of_spouse,
                'number_of_children' => $this->number_of_children,
                'classification_of_individual' => $this->classification_of_individual,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'country_of_birth' => $this->country_of_birth,
                'fate_status' => $this->fate_status,
                'social_status' => $this->social_status,
                'residency' => $this->residency,
                'citizenship' => $this->citizenship,
                'nationality' => $this->nationality,
                'employment' => $this->employment,
                'employer_name' => $this->employer_name,
                'education' => $this->education,
                'business_name' => $this->business_name,
                'income_available' => $this->income_available,
                'monthly_expenses' => $this->monthly_expenses,
                'negative_status_of_individual' => $this->negative_status_of_individual,
                'tax_identification_number' => $this->tax_identification_number,
                'passport_number' => $this->passport_number,
                'passport_issuer_country' => $this->passport_issuer_country,
                'driving_license_number' => $this->driving_license_number,
                'voters_id' => $this->voters_id,
                'foreign_unique_id' => $this->foreign_unique_id,
                'custom_id_number_1' => $this->custom_id_number_1,
                'custom_id_number_2' => $this->custom_id_number_2,
                'main_address' => $this->main_address,
                'ward' => $this->ward,
                'number_of_building' => $this->number_of_building,
                'postal_code' => $this->postal_code,
                'region' => $this->region,
                'district' => $this->district,
                'country' => $this->country,
                'mobile_phone' => $this->mobile_phone,
                'fixed_line' => $this->fixed_line,
                'web_page' => $this->web_page,
                'trade_name' => $this->trade_name,
                'legal_form' => $this->legal_form,
                'establishment_date' => $this->establishment_date,
                'registration_country' => $this->registration_country,
                'industry_sector' => $this->industry_sector,
                'registration_number' => $this->registration_number,
                'boda_number' => $this->boda_number,
                'tawi' => $this->tawi,
                'member_number' => $newMemberId,
                'business_member_id'=> $this->member_number,
                    'member_status' => 'PENDING',
                'personal_identification_path' => $personal_identification_path,
                'local_government_letter_path' => $local_government_letter_path,
                'motorcycle_card_path' => $motorcycle_card_path,
                'motorcycle_contract_path' => $motorcycle_contract_path,
            ])->id;



            // Send approval notification
            $this->sendApproval($id, Auth::user()->name . ' has registered a new member', '12', 'createMember');

            // Reset the form data
            $this->resetData();
            $this->photo=null;
            $this->showEditMember=false;
            $this->reset();


            // Flash success message
            session()->flash('message', 'A new user has been successfully created!');
            session()->flash('alert-class', 'alert-success');
//        } catch (\Exception $e) {
//            // Handle any errors that occur during member creation
//            session()->flash('message', 'An error occurred while creating the user: ' . $e->getMessage());
//            session()->flash('alert-class', 'alert-danger');
//        }
    }


    public function sendApproval($id,$msg,$code,$processName){

        $user = auth()->user();


        approvals::create([
            'institution' => $id,
            'process_name' => $processName,
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => $id
        ]);

    }

    public function resetData()
    {
        $this->account_number = null;
        $this->institution_id = null;
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->branch = '';
        $this->registering_officer = '';
        $this->loan_officer = '';
        $this->approving_officer = '';
        $this->membership_type = '';
        $this->incorporation_number = '';
        $this->phone_number = '';
        $this->mobile_phone_number = '';
        $this->place_of_birth = '';
        $this->marital_status = '';
        $this->member_number = '';
        $this->registration_date = '';
        $this->address = '';
        $this->notes = '';
        $this->current_team_id = null;
        $this->profile_photo_path = '';
        $this->branch_id = '';
        $this->member_status = 'PENDING';
        $this->next_of_kin_name = '';
        $this->next_of_kin_phone = '';
        $this->next_of_kin_relationship = '';
        $this->tin_number = '';
        $this->nida_number = '';
        $this->ref_number = '';
        $this->shares_ref_number = '';
        $this->nationarity = '';
        $this->member_exit_document = '';
        $this->end_membership_description = '';
        $this->amount = null;
        $this->national_id = '';
        $this->customer_code = '';
        $this->present_surname = '';
        $this->birth_surname = '';
        $this->number_of_spouse = null;
        $this->number_of_children = null;
        $this->classification_of_individual = '';
        $this->gender = '';
        $this->date_of_birth = null;
        $this->country_of_birth = '';
        $this->fate_status = '';
        $this->social_status = '';
        $this->residency = '';
        $this->citizenship = '';
        $this->nationality = '';
        $this->employment = '';
        $this->employer_name = '';
        $this->education = '';
        $this->business_name = '';
        $this->income_available = '';
        $this->monthly_expenses = '';
        $this->negative_status_of_individual = '';
        $this->tax_identification_number = '';
        $this->passport_number = '';
        $this->passport_issuer_country = '';
        $this->driving_license_number = '';
        $this->voters_id = '';
        $this->foreign_unique_id = '';
        $this->custom_id_number_1 = '';
        $this->custom_id_number_2 = '';
        $this->main_address = '';
        $this->ward = '';
        $this->number_of_building = '';
        $this->postal_code = '';
        $this->region = '';
        $this->district = '';
        $this->country = '';
        $this->mobile_phone = '';
        $this->fixed_line = '';
        $this->email = '';
        $this->web_page = '';
        $this->trade_name = '';
        $this->legal_form = '';
        $this->establishment_date = null;
        $this->registration_country = '';
        $this->industry_sector = '';
        $this->registration_number = '';
        $this->boda_number = '';
        $this->tawi = '';
        $this->member_number = '';
    }


//    public function sendApproval($id,$msg,$code){
//
//        $user = auth()->user();
//
//
//        approvals::create([
//            'institution' => $id,
//            'process_name' => 'createMember',
//            'process_description' => $msg,
//            'approval_process_description' => 'has approved a transaction',
//            'process_code' => $code,
//            'process_id' => $id,
//            'process_status' => 'Pending',
//            'user_id'  => Auth::user()->id,
//            'team_id'  => $id
//        ]);
//
//    }


    public function submit()
    {

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        $this->validate();

        // Execution doesn't reach here if validation fails.

        $id =  MembersModel::create([
            'name' => $this->name,
            'region' => $this->region,
            'wilaya' => $this->wilaya,
            'membershipNumber' => $this->membershipNumber,
            'parentMember' => $this->parentMember,
            'institution_id' => $institution_id,
            'Member_status'  => 'Pending'
        ])->id;

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createMember',
            'process_description' => 'has created a new Member',
            'approval_process_description' => 'has approved a new Member',
            'process_code' => '01',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);



        $this->resetData();

        Session::flash('message', 'A new Member has been successfully created!');
        Session::flash('alert-class', 'alert-success');
    }


    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Members list';
        }
        if($tabId == '2'){
            $this->title = 'Enter new Member details';
        }
    }


    public function createNewMember()
    {


        $this->showCreateNewMember = true;
    }

    public function blockMemberModal($id)
    {

        $this->showDeleteMember = true;
        $this->memberSelected = $id;
    }

    public function editMemberModal($id)
    {

        $this->showEditMember = true;
        $this->pendingMember = $id;
        $this->member = $id;
        $this->pendingMembername = MembersModel::where('id',$id)->value('first_name');
        $this->updatedMember();

    }


    public function closeModal(){
        $this->showCreateNewMember = false;
        $this->showDeleteMember = false;
        $this->showEditMember = false;
    }

    public function confirmPassword(): void
    {
        // Check if password matches for logged-in user
        if (Hash::check($this->password, auth()->user()->password)) {
            //dd('password matches');
            $this->delete();
        } else {
            //dd('password does not match');
            Session::flash('message', 'This password does not match our records');
            Session::flash('alert-class', 'alert-warning');
        }
        $this->resetPassword();


    }

    public function resetPassword(): void
    {
        $this->password = null;
    }

    public function delete(): void
    {
        $user = MembersModel::where('id',$this->memberSelected)->first();





        $action = '';

        if ($user) {
            if($this->permission == 'BLOCKED'){
                $action = 'blockUser';
            }
            if($this->permission == 'ACTIVE'){
                $action = 'activateUser';
            }
            if($this->permission == 'DELETED'){
                // get file path
                $filename = time().'_'.$this->member_exit_document->getMemberOriginalName();

                // Store the file in the 'public' disk under the 'Saccoss-request' directory
                $this->member_exit_document->storeAs('member_exit_form', $filename, 'public');

                // Save the file path
                $file1Path = 'member_exit_form/' . $filename;
                DB::table('members')->where('id',$this->memberSelected)->update(['member_exit_document'=>$file1Path,'member_status'=>"EXIT MEMBER"]);

                $action = 'End membership';
            }

            $update_value = approvals::updateOrCreate(
                [
                    'process_id' => $this->memberSelected,
                    'user_id' => Auth::user()->id

                ],
                [
                    'institution' => '',
                    'process_name' => $action,
                    'process_description' => $this->permission.' user - '.$user->name,
                    'approval_process_description' => '',
                    'process_code' => '29',
                    'process_id' => $this->memberSelected,
                    'process_status' => $this->permission,
                    'approval_status' => 'PENDING',
                    'user_id'  => Auth::user()->id,
                    'team_id'  => '',
                    'edit_package'=> null
                ]
            );


            // Delete the record
            //$node->delete();
            // Add your logic here for successful deletion
            Session::flash('message', 'Awaiting approval');
            Session::flash('alert-class', 'alert-success');

//            $this->closeModal();
            $this->render();


        } else {
            // Handle case where record was not found
            // Add your logic here
            Session::flash('message', 'Node error');
            Session::flash('alert-class', 'alert-warning');
        }

    }

    public function render()
    {
        return view('livewire.members.members');

    }

    public function boot()
    {
        $this->branch = '1000';
        $this->variables = [
            // Individual & Company
//            [
//                'name' => 'customer_code',
//                'label' => 'Customer Code',
//                'type' => 'text',
//                'for' => 'both',
//            ],
            // Individual & Company
            [
                'name' => 'member_number',
                'label' => 'Member Number',
                'type' => 'text',
                'for' => 'both',
            ],
//            // Individual
//            [
//                'name' => 'present_surname',
//                'label' => 'Present Surname',
//                'type' => 'text',
//                'for' => 'individual',
//            ],
//            // Individual
//            [
//                'name' => 'birth_surname',
//                'label' => 'Birth Surname',
//                'type' => 'text',
//                'for' => 'individual',
//            ],
            // Individual
            [
                'name' => 'first_name',
                'label' => 'First Name',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'middle_name',
                'label' => 'Middle Names',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual

            [
                'name' => 'last_name',
                'label' => 'Last Name',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Both
            [
                'name' => 'phone_number',
                'label' => 'Phone Number',
                'type' => 'text',
                'for' => 'both',
            ],

            // Both
            [
                'name' => 'mobile_phone_number',
                'label' => 'Mobile Phone',
                'type' => 'text',
                'for' => 'both',
            ],

            // both
            [
                'name' => 'boda_number',
                'label' => 'Boda Number',
                'type' => 'text',
                'for' => 'both',
            ],

            // individual
            [
                'name' => 'tawi',
                'label' => 'Tawi',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Both
            [
                'name' => 'ward',
                'label' => 'ward',
                'type' => 'text',
                'for' => 'both',
            ],


            // Both
            [
                'name' => 'district',
                'label' => 'District',
                'type' => 'text',
                'for' => 'both',
            ],

            // Both
            [
                'name' => 'region',
                'label' => 'Region',
                'type' => 'text',
                'for' => 'both',
            ],

            // Individual
            [
                'name' => 'nationarity',
                'label' => 'Nationality',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Individual
            [
                'name' => 'next_of_kin_name',
                'label' => 'Next of kin name',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Individual
            [
                'name' => 'next_of_kin_phone',
                'label' => 'Next of kin phone',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Individual
            [
                'name' => 'next_of_kin_relationship',
                'label' => 'Next of kin relationship',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Individual
            [
                'name' => 'number_of_spouse',
                'label' => 'Number of Spouse',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'number_of_children',
                'label' => 'Number of Children',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'classification_of_individual',
                'label' => 'Classification of Individual',
                'type' => 'text',
                'for' => 'individual',
            ],
//            // Individual
//            [
//                'name' => 'gender',
//                'label' => 'Gender',
//                'type' => 'text',
//                'for' => 'individual',
//            ],
            // Individual
            [
                'name' => 'date_of_birth',
                'label' => 'Date of Birth',
                'type' => 'date',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'country_of_birth',
                'label' => 'Country of Birth',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual

            [
                'name' => 'fate_status',
                'label' => 'Fate Status',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'social_status',
                'label' => 'Social Status',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'residency',
                'label' => 'Residency',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'citizenship',
                'label' => 'Citizenship',
                'type' => 'text',
                'for' => 'individual',
            ],

            // Individual
            [
                'name' => 'employment',
                'label' => 'Employment',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'employer_name',
                'label' => 'Employer Name',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'education',
                'label' => 'Education',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'income_available',
                'label' => 'Income Available',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'monthly_expenses',
                'label' => 'Monthly Expenses',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Individual
            [
                'name' => 'negative_status_of_individual',
                'label' => 'Negative Status of Individual',
                'type' => 'text',
                'for' => 'individual',
            ],
            // Both
            [
                'name' => 'tax_identification_number',
                'label' => 'Tax Identification Number',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'national_id',
                'label' => 'National ID',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'passport_number',
                'label' => 'Passport Number',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'passport_issuer_country',
                'label' => 'Passport Issuer Country',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'driving_license_number',
                'label' => 'Driving License Number',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'voters_id',
                'label' => "Voters ID",
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'foreign_unique_id',
                'label' => 'Foreign Unique ID',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'custom_id_number_1',
                'label' => 'Custom ID Number 1',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'custom_id_number_2',
                'label' => 'Custom ID Number 2',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'main_address',
                'label' => 'Main Address',
                'type' => 'text',
                'for' => 'both',
            ],

            // Both
            [
                'name' => 'number_of_building',
                'label' => 'Number of Building',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'postal_code',
                'label' => 'Postal Code',
                'type' => 'text',
                'for' => 'both',
            ],

            // Both
            [
                'name' => 'country',
                'label' => 'Country',
                'type' => 'text',
                'for' => 'both',
            ],

            // Both
            [
                'name' => 'fixed_line',
                'label' => 'Fixed Line',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text',
                'for' => 'both',
            ],
            // Both
            [
                'name' => 'web_page',
                'label' => 'Web Page',
                'type' => 'text',
                'for' => 'both',
            ],
            // Company
            [
                'name' => 'trade_name',
                'label' => 'Trade Name',
                'type' => 'text',
                'for' => 'company',
            ],
            // Company
            [
                'name' => 'legal_form',
                'label' => 'Legal Form',
                'type' => 'text',
                'for' => 'company',
            ],
            // Company
            [
                'name' => 'establishment_date',
                'label' => 'Establishment Date',
                'type' => 'date',
                'for' => 'company',
            ],
            // Company
            [
                'name' => 'registration_country',
                'label' => 'Registration Country',
                'type' => 'text',
                'for' => 'company',
            ],
            // Company
            [
                'name' => 'industry_sector',
                'label' => 'Industry Sector',
                'type' => 'text',
                'for' => 'company',
            ],
            // Company
            [
                'name' => 'registration_number',
                'label' => 'Registration Number',
                'type' => 'text',
                'for' => 'company',
            ],
        ];

    }


}
