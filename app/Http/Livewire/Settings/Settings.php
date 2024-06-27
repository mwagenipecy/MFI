<?php

namespace App\Http\Livewire\Settings;


use App\Http\Traits\MailSender;
use App\Models\approvals;
use App\Models\departmentsList;
use App\Models\User;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeRegisterMail;
class Settings extends Component
{
    public $activeUsers;
    public $inActiveUsers;
    public $selected;
    public $tab_id;

    public $selected_id;

    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockUser' => 'blockUserModal',
        'editUser' => 'editUserModal'
        ];

    public $user_sub_menus;

    public $showCreateNewUser = false;


    //////////////////////////////////////////////// USR///////////////////////////////

    public $showDeleteUser = false;

    use MailSender;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $department;
    public $departmentList;
    public $menusArray;
    /**
     * @var string[]|null
     */
    public $menuItems;
    public $sub_menus;
    /**
     * @var true
     */
    public bool $showRoles = false;
    public $newuser;
    public $phone_number;


    protected $rules = [
        'newuser' => 'required|min:1',
        'department' => 'required|min:1'

    ];
    public $departmentName;


///////////////////////////////////////////BLOCK USER/////////////////////////////////////////////////


    public $userSelected;
    public $nodesList;
    public string $NODE_NAME;
    public string $userName;
    public $usersList;
    public $permission = 'BLOCKED';


    ////////////////////////////////////////ROLES SET//////////////////////////////////////////////////


    public $team;

    public $accounts;

    public $user;

    public $pendingUsers;

    public $photo;
    public $branch_id;
    public $Employment_type = 'Permanent';
    public $first_name;
    public $middle_name;
    public $last_name;
    public $street;
    public $address;
    public $notes;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $place_of_birth;
    public $tin_number;
    public $nida_number;
    public $gross_salary;

    public $taxes;
    public $benefits;
    public $contributions;
    public $branches;
    public $job_title;

    public $removeEmployeeRegistrationForm;



    public $pendinguser;

    public $userrole;

    public $department_name;
    public bool $showEditUser = false;


    public function showUsersList(): void
    {

        $this->tab_id = 6;
    }

    public function boot(): void
    {
        $this->nodesList = User::get();
        $this->userName = '';
        $this->tab_id = 6;
        $this->user_sub_menus = UserSubMenu::where('menu_id',8)->where('user_id', Auth::user()->id)->get();
        $this->password = "12345";
    }

    public function setView($page): void
    {
        $this->tab_id = $page;
    }


    public function createNewUser()
    {


        $this->showCreateNewUser = true;
    }

    public function blockUserModal($id)
    {
        $this->userSelected = $id;
        $this->showDeleteUser = true;
    }

    public function editUserModal($id)
    {

        $this->pendinguser = $id;
        $this->selected_id=$id;
        $this->department = User::where('id',$id)->value('department');
        $this->showEditUser = true;
    }

        public function closeModal(){
            $this->showCreateNewUser = false;
            $this->showDeleteUser = false;
            $this->showEditUser = false;
        }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->activeUsers = User::where('status', 'ACTIVE')->get()->count();
        $this->inActiveUsers = User::where('status', 'PENDING')->orWhere('status', 'DELETED')->orWhere('status', 'INACTIVE')->orWhere('status', 'BLOCKED')->get()->count();
        $this->user_sub_menus = UserSubMenu::where('menu_id',8)->where('user_id', Auth::user()->id)->get();
        $this->departmentList = departmentsList::get();
        $this->usersList = User::get();
        $this->pendingUsers = User::get();
        return view('livewire.settings.settings');
    }





    public function createUser(): void
    {




        $imageUrl='';

//        $this->validate([
//            'first_name'=> 'required|min:3',
//            'last_name'=> 'required|min:3',
//            'Employment_type'=> 'required|min:3',
//            'phone_number'=> 'required',
//                    'string',
//                    'regex:/^(\+255|0)[1-9]\d{8}$/',
//                    'unique:users,phone_number',
//            'date_of_birth'=> 'required|min:3',
//            'gender'=> 'required',
//            'marital_status'=> 'required|min:3',
//            'place_of_birth'=> 'required|min:3',
//            'street'=> 'required|min:3',
//            'address' => 'required|min:3',
////                'notes' => 'required|min:3',
//            'email' => 'required|string|email|max:255|unique:users,email',
//            'next_of_kin_name'=> 'required|min:3',
//            'next_of_kin_phone'=> 'required|min:3',
//            'tin_number'=> 'required|min:3',
//            'nida_number' => 'required|min:3',
//            'branch_id' => 'required',
//            'gross_salary' => 'required|numeric',
//
//        ]);



        if($this->photo){
            $imageUrl = $this->photo->store('avatars', 'public');
        }

        $last_member= Employee::latest()->first();
        if($last_member){
            $last_member_id = $last_member->id;
            $last_member_id = $last_member_id  + 1;
            $newMemberId = $this->branch_id.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }else{
            $last_member_id = 0;
            $last_member_id = $last_member_id  + 1;
            $newMemberId = $this->branch_id.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }


        $id =  Employee::create([
            'first_name'=> $this->first_name,
            'middle_name'=> $this->middle_name,
            'last_name'=> $this->last_name,
            'branch'=> $this->branch_id,
            'email'=> $this->email,
            'phone'=> $this->phone_number,
            'job_title'=> $this->job_title,
            'department'=> $this->department,
            'salary'=> $this->gross_salary,
            'contribution'=>$this->contributions,
            'taxes'=>$this->taxes,
            'benefits'=>$this->benefits,
            'Employment_type'=> $this->Employment_type,
            'date_of_birth'=> $this->date_of_birth,
            'gender'=> $this->gender,
            'marital_status'=> $this->marital_status,
            'employee_number'=> $newMemberId,
            'employee_status'=>'PENDING',
            'street'=> $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'profile_photo_path' => $imageUrl,
            'registering_officer' => auth()->user()->id,
            'place_of_birth' => $this->place_of_birth,
            'next_of_kin_name'=> $this->next_of_kin_name,
            'next_of_kin_phone'=> $this->next_of_kin_phone,
            'tin_number'=> $this->tin_number,
            'nida_number' => $this->nida_number,
            'institution_id'=>auth()->user()->institution_id,

        ])->id;


        // instance to create leave of employee

        // create user login data

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = substr(str_shuffle($characters), 0, 10);


        User::create([
            'email'=>$this->email,
            'password'=>Hash::make($password),   // password is 1234567890
            'department'=>$this->department,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'name'=>$this->first_name,
            'employeeId'=>$id,
            'branch'=>$this->branch_id,
            'institution_id'=>auth()->user()->institution_id,
        ]);



        // send email notification



        $employeeId=auth()->user()->employeeId;
        $user_email=$this->email;
        $name=$this->first_name;


        Mail::to($this->email)->send(new EmployeeRegisterMail($employeeId,$user_email,$name,$password));


        $this->resetData();


        // success session

        sleep(2);

      $this->resetData();


        session()->flash('message', 'A new Employee has been successfully created!');
        session()->flash('alert-class', 'alert-success');
        session()->flash('success', 'User created successfully.');


        //sleep(3);




    }

    public function resetData()
    {

        $this->first_name = null;

        $this->middle_name = null;


        $this->last_name = null;

        $this->email = null;
        $this->department=null;

        $this->phone_number = null;

        $this->branch_id = null;

        $this->gross_salary = null;



        $this->Employment_type = null;
        $this->date_of_birth = null;
        $this->gender = null;
        $this->marital_status = null;

        $this->street = null;
        $this->address = null;
        $this->notes = null;

        $this->place_of_birth = null;
        $this->next_of_kin_name = null;
        $this->next_of_kin_phone = null;
        $this->tin_number = null;
        $this->nida_number = null;

        $this->photo = null;

    }





    public function delete(): void
    {
        $user = User::where('id',$this->userSelected)->first();
        $action = '';
        if ($user) {

            if($this->permission == 'BLOCKED'){
                $action = 'blockUser';
            }
            if($this->permission == 'ACTIVE'){
                $action = 'activateUser';
            }
            if($this->permission == 'DELETED'){
                $action = 'deleteUser';
            }

            $update_value = approvals::updateOrCreate(
                [
                    'process_id' => $this->userSelected,
                    'user_id' => Auth::user()->id

                ],
                [
                    'institution' => '',
                    'process_name' => $action,
                    'process_description' => $this->permission.' user - '.$user->name,
                    'approval_process_description' => '',
                    'process_code' => '29',
                    'process_id' => $this->userSelected,
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

            $this->closeModal();
            $this->render();


        } else {
            // Handle case where record was not found
            // Add your logic here
            Session::flash('message', 'Node error');
            Session::flash('alert-class', 'alert-warning');
        }

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



    public function saveRole(): void
    {

        $imageUrl='';




        $this->validate(['email'=>'required']);

        $id =  Employee::where('id',$this->selected_id)->update([
            'first_name'=> $this->first_name,
            'middle_name'=> $this->middle_name,
            'last_name'=> $this->last_name,
            'branch'=> $this->branch_id,
            'email'=> $this->email,
            'phone'=> $this->phone_number,
            'job_title'=> $this->job_title,
            'department'=> $this->department,
            'salary'=> $this->gross_salary,
            'contribution'=>$this->contributions,
            'taxes'=>$this->taxes,
            'benefits'=>$this->benefits,
            'Employment_type'=> $this->Employment_type,
            'date_of_birth'=> $this->date_of_birth,
            'gender'=> $this->gender,
            'marital_status'=> $this->marital_status,
            'street'=> $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'profile_photo_path' => $imageUrl,
            'registering_officer' => auth()->user()->id,
            'place_of_birth' => $this->place_of_birth,
            'next_of_kin_name'=> $this->next_of_kin_name,
            'next_of_kin_phone'=> $this->next_of_kin_phone,
            'tin_number'=> $this->tin_number,
            'nida_number' => $this->nida_number,
            'institution_id'=>auth()->user()->institution_id,

        ])->id;


        User::where('employeeId',$this->selected_id)->update([
            'email'=>$this->email,
            'department'=>$this->department,
            'name'=>$this->first_name,
            'branch'=>$this->branch_id,
            'institution_id'=>auth()->user()->institution_id,
        ]);





        $this->resetData();


        $this->pendinguser = null;
        $this->department = null;
        $this->userrole = null;

        session()->flash('message', 'Role changed');
        session()->flash('alert-class', 'alert-success');

        $this->closeModal();
        $this->render();


    }


}
